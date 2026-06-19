<?php
include 'DBConn.php';
session_start();

//Using the logged in user id and the passed item id to add the item to the cart
$user_id = $_SESSION['user_id'];
if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];

    // Check if the item is already in the cart for this user
    $check_sql = "SELECT * FROM tbl_cart_item WHERE cartID = (SELECT id FROM tbl_cart WHERE userID = '$user_id') AND item_id = '$item_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Item already in cart, you can choose to update quantity or notify the user
        $_SESSION['message'] = "Item already in Cart";
    } else {
        // Item not in cart, insert it
        $insert_sql = "INSERT INTO tbl_cart (user_id, item_id) VALUES ('$user_id', '$item_id')";
        if (mysqli_query($conn, $insert_sql)) {
            $_SESSION['message'] = "Item added successfully!";
        
        } else {
            $_SESSION['message'] = "Failed to Add Item!";
        }
    }

    header("location: item_page.php?item_id=<?php echo $item_id");
    exit();

} else {
    echo "No item specified.";
}
?>