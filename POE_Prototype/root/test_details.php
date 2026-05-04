<?php
include 'DBConn.php';

$fname = 'John';
$lname = 'Doe';
$email = 'john.doe@example.com';
$username = 'johndoe';
$password = 'password123';

$testEntry = "INSERT INTO tbl_user (fname, lname, email, username, password) VALUES (?, ?, ?, ?, ?)";
$query = $conn->prepare($testEntry);
$query->bind_param("sssss", $fname, $lname, $email, $username, $password);

if ($query->execute() === TRUE) {
    echo "New record created successfully";
    header("Location: login.php");
} else {
    echo "<script>
    alert('Error: entry failed to execute');
    </script>";
}

?>