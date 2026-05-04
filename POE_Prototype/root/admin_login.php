<?php
include 'DBConn.php';
?>

<html lang="en">
<head>
    <title>Login</title>
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

    <div id="confirmationCode" class="popup-code">
        <div class="popup-content">
            <p>Please enter your confirmation code.</p>
            <input type="password" id="codeInput" placeholder="Enter Confirmation Code">
            <button onclick="verifyAdminCode()">Submit</button>
        </div>
    </div>

    <div class="container">
        <h1>Login</h1>
        <form action="admin_dashboard.php" method="POST">
            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
        <br>
    </div>
</body>
</html>
<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password are correct
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND userStatus='approved'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login successful, redirect to dashboard
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Login failed, show error message
        echo "<script>document.getElementById('errorPopup').style.display='block';</script>";
    }
}