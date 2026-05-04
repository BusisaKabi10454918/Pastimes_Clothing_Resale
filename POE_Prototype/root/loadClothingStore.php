<?php
include 'DBConn.php';

$inputFiles = [
    "../dataFiles/userData.txt",
    "../dataFiles/admin_inserts.txt",
    "../dataFiles/Item_inserts.txt",
    "../dataFiles/cart_inserts.txt",
    "../dataFiles/cart_item_inserts.txt",
    "../dataFiles/seller_inserts.txt",
];

//First check if the table exists, if not create it, if it does, drop it and populate with the data from the file
$DropUsers = "DROP TABLE IF EXISTS tbl_user";
$conn->query($DropUsers);

$userTable = "CREATE TABLE IF NOT EXISTS tbl_user (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(30) NOT NULL,
    lname VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    password VARCHAR(255)
)";

// Execute the query to create the user table
$conn->query($userTable);

foreach (file($inputFiles[0]) as $line) {
    $line = trim($line);
    $line = explode(";",$line);
    $fname = trim($line[0]);
    $lname = trim($line[1]);
    $username = trim($line[2]);
    $email = trim($line[3]);
    $password = trim($line[4]);
    $sql = "INSERT INTO tbl_user (fname, lname, username, email, password) VALUES ('$fname', '$lname', '$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "New user record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$DropAdmins = "DROP TABLE IF EXISTS tbl_admin";
$conn->query($DropAdmins);

$adminTable = "CREATE TABLE IF NOT EXISTS tbl_admin (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    userID INT(6) NOT NULL,
    FOREIGN KEY (userID) REFERENCES tbl_user(id)
)";

$conn->query($adminTable);

foreach (file($inputFiles[1]) as $line) {
    $line = trim($line);
    $sql = "INSERT INTO tbl_admin (userID) VALUES ('$line')";
    if ($conn->query($sql) === TRUE) {
        echo "New  admin record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$DropItems = "DROP TABLE IF EXISTS tbl_item";
$conn->query($DropItems);

$itemTable = "CREATE TABLE IF NOT EXISTS tbl_item (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255)
)";

$conn->query($itemTable);

foreach (file($inputFiles[2]) as $line) {
    $line = trim($line);
    $line = explode(",",$line);
    $name = trim($line[0]);
    $description = trim($line[1]);
    $price = trim($line[2]);
    $image = trim($line[3]);
    $sql = "INSERT INTO tbl_item (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
    if ($conn->query($sql) === TRUE) {
        echo "New item record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$DropCarts = "DROP TABLE IF EXISTS tbl_cart";
$conn->query($DropCarts);

$cartTable = "CREATE TABLE IF NOT EXISTS tbl_cart (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    userID INT(6) NOT NULL,
    itemID INT(6) NOT NULL,
    quantity INT(6) NOT NULL,
    FOREIGN KEY (userID) REFERENCES tbl_user(id)
)";

$conn->query($cartTable);

foreach (file($inputFiles[3]) as $line) {
    $line = trim($line);
    $line = explode(",",$line);
    $userID = trim($line[0]);
    $itemID = trim($line[1]);
    $quantity = trim($line[2]);
    $sql = "INSERT INTO tbl_cart (userID, itemID, quantity) VALUES ('$userID', '$itemID', '$quantity')";
    if ($conn->query($sql) === TRUE) {
        echo "New  cart record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$DropCartItems = "DROP TABLE IF EXISTS tbl_cart_item";
$conn->query($DropCartItems);

$cart_ItemTable = "CREATE TABLE IF NOT EXISTS tbl_cart_item (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    cartID INT(6) NOT NULL,
    itemID INT(6) NOT NULL,
    FOREIGN KEY (cartID) REFERENCES tbl_cart(id)
)";

$conn->query($cart_ItemTable);

foreach (file($inputFiles[4]) as $line) {
    $line = trim($line);
    $line = explode(",",$line);
    $cartID = trim($line[0]);
    $itemID = trim($line[1]);
    $sql = "INSERT INTO tbl_cart_item (cartID, itemID) VALUES ('$cartID', '$itemID')";
    if ($conn->query($sql) === TRUE) {
        echo "New  cart item record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$DropSellers = "DROP TABLE IF EXISTS tbl_seller";
$conn->query($DropSellers);


$sellerTable = "CREATE TABLE IF NOT EXISTS tbl_seller (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    userID INT(6) NOT NULL,
    FOREIGN KEY (userID) REFERENCES tbl_user(id)
)";

$conn->query($sellerTable);

foreach (file($inputFiles[5]) as $line) {
    $line = trim($line);
    $sql = "INSERT INTO tbl_seller (userID) VALUES ('$line')";
    if ($conn->query($sql) === TRUE) {
        echo "New  seller record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>