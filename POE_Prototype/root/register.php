<?php
include 'DBConn.php';


function checkNumbersAndCharacters(string $string): bool {
    //If there is a number or special character in the string, return false
    if (!preg_match("/^[a-zA-Z\s]+$/", $string)) {
        return false;
    }
    return true;
}

function verifyCode(string $input) {
    // Read the stored hash from the hidden file
    $storedHash = file_get_contents(__DIR__ . "/.admin_code");

    // Compare the entered code with the stored hash
    return password_verify($input, $storedHash);
}
?>

<html lang="en">
    <head>
        <title>Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/admin_login_style.css">
        <link rel="icon" href="../images/pastimes_favicon.png" type="images/x-icon">
        <script src="../js/verifyAdminCode.js"></script>
    </head>
    <body>
        <header class="navbar">
            <div class="navbar-left">
            </div>

            <div class="navbar-center">
                <a href="index.php">Pastimes</a>
            </div>

            <div class="navbar-right">
            </div>
        </header>

        <div id="errorPopup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="document.getElementById('errorPopup').style.display='none'">&times;</span>
                    <p>Incorrect username or password.</p>
                </div>
        </div>

        <div class="container">
            <h1>Register</h1>

            <form action="" method="POST">
                <input type="text" name="fname"  placeholder="Enter First Name" required>
                <input type="text" name="lname" placeholder="Enter Last Name" required>
                <input type="email" name="email" placeholder="Enter Email" required>
                <input type="text" name="username"  placeholder="Enter Username" required>
                <input type="password" name="password" placeholder="Enter Password" required>

                <label for="is_admin">Register as Admin:</label>
                <input type="password" name="admin_code" value="admin_code" placeholder="Enter Admin Code (if applicable)">

                <button type="submit" name="submit" value="submit">Register</button>
            </form>

            <p>Already have an account? <a href="login.php">Login here</a></p>

            <br>
        </div>
</html>
<?php
if(isset($_POST['submit'])){
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $admin_code = $_POST['admin_code'];

    if (!checkNumbersAndCharacters($first_name) || !checkNumbersAndCharacters($last_name)) {
        echo "<script>
            document.getElementById('errorPopup').style.display = 'block';
        </script>";
    }else{
        if(empty($admin_code)){
            echo "password encrypted";
            $password = password_hash($password, PASSWORD_DEFAULT);
            $entry = "INSERT INTO tbl_user (fname, lname, email, username, password) VALUES (?, ?, ?, ?, ?)";

            echo "entry attempt logged";
            $query = $conn->prepare($entry);
            $query->bind_param("sssss", $first_name, $last_name, $email, $username, $password);

            if ($query->execute() === TRUE) {
                echo "New record created successfully";
                header("Location: login.php");
            } else {
                die("Error: " . $entry . "<br>" . $conn->error);
                echo "<script>
                    alert('Error: entry failed to execute');
                </script>";
            }
        }else{
            if(verifyCode($admin_code)){
                echo "<script>
                    alert('Admin code verified. Registering as admin.');
                </script>";
                $password = password_hash($password, PASSWORD_DEFAULT);
                $entry = "INSERT INTO tbl_user (fname, lname, email, username, password, userStatus) VALUES (?, ?, ?, ?, ?, 'approved')";

                $query = $conn->prepare($entry);
                $query->bind_param("sssss", $first_name, $last_name, $email, $username, $password);

                $queryNewID = $conn->query("SELECT id FROM tbl_user WHERE username = '$username'");
                $row = $queryNewID->fetch_assoc();
                $user_id = $row['id'];

                $adminEntry = "INSERT INTO tbl_admin (userID) VALUES (?)";
                $adminInsert = $conn->prepare($adminEntry);
                $adminInsert->bind_param("s", $user_id);

                if ($query->execute() === TRUE) {
                    if($adminInsert->execute() === TRUE){
                        echo "<script>
                            alert('Admin record created successfully');
                        </script>";
                        header("Location: login.php");
                    }
                } else {
                    die("Error: " . $entry . "<br>" . $conn->error);
                    echo "<script>
                        alert('Error: entry failed to execute');
                    </script>";
                }
            }else{
                echo "<script>
                    alert('Invalid admin code.');
                </script>";
                exit;
            }
        }
    }
}