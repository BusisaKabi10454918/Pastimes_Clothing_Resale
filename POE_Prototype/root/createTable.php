<?php
include "DBConn.php";

//First check if the table exists, if not create it, if it does, drop it and populate with the data from the file
$sql1 = "DROP TABLE IF EXISTS tbl_user";
$conn->query($sql1  );


$sql2 = "CREATE TABLE IF NOT EXISTS tbl_user (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(30) NOT NULL,
    lname VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    password VARCHAR(50)
)";
$conn->query($sql2);

//First setup the file with out details
$inputFile = file("userdata.txt");

//Seperate each line into an array. Currently formatted "Firstname; Lastname; Username; Email; Password"
$inputFile = array_filter($inputFile);

foreach($inputFile as $line){
    $line = trim($line);
    $line = explode(";",$line);
    $fname = trim($line[0]);
    $lname = trim($line[1]);
    $username = trim($line[2]);
    $email = trim($line[3]);
    $password = trim($line[4]);
    $sql = "INSERT INTO tbl_user (fname, lname, username, email, password) VALUES ('$fname', '$lname', '$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>