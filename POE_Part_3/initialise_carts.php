<?php
include 'DBConn.php';

//First check if the table exists, if not create it, if it does, drop it and populate with the data from the file
$sql1 = "DROP TABLE IF EXISTS tbl_cart";
$conn->query($sql1);

$sql2 = "CREATE TABLE IF NOT EXISTS tbl_cart (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) NOT NULL UNIQUE,
    FOREIGN KEY (user_id) REFERENCES tbl_user(id)
)";

if ($conn->query($sql2) === TRUE) {
    echo "New record created successfully <br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//Query the current users in the database who aren't admins and create a cart for them
$sql3 = "INSERT INTO tbl_cart (user_id) SELECT id FROM tbl_user WHERE id NOT IN (SELECT userID FROM tbl_admin)";

$conn->query($sql3);

if ($conn->query($sql3) === TRUE) {
    echo "New record created successfully <br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>