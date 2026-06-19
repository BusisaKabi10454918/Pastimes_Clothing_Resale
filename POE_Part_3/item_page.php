<?php
session_start();
include 'DBConn.php';


if (isset($_GET['item_id'])) {
    $item_id = intval($_GET['item_id']);

    $stmt = $conn->prepare("SELECT * FROM tbl_item WHERE id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
        $item_name = $item['name'];
        $item_price = $item['price'];
        $item_description = $item['description'];
        $item_image = $item['image'];
    } else {
        echo "Item not found.";
        exit();
    }
} else {
    echo "No item specified.";
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $item_name; ?></title>
    <link rel="stylesheet" href="./css/admin_login_style.css">
    <link rel="icon" href="./images/pastimes_favicon.png" type="image/x-icon">
</head>
<body>
    <header class="navbar">
        <div class="navbar-left">
            <img id="menu-icon" src="./images/menu_icon.png" alt="Menu Icon" onclick="">
        </div>
        <div class="navbar-center">
            <a href="index.php">Pastimes</a>
        </div>
        <div class="navbar-right">
            <img id="cart-icon" src="./images/cart_icon.png" alt="Cart Icon" onclick="window.location.href='cart_view.php'">
            <img id="profile-icon" src="./images/user_icon.png" alt="Profile Icon" onclick="window.location.href='profile.php'">
        </div>
    </header>
    <div class="navigation-menu">
        <div class="navigation-item"><a href="login.php">Logout</a></div>
        <div class="navigation-item"><a href="index.php">Home</a></div>
    </div>

    <main>
        <div class="item-container">
            <img class="item-image" src="<?php echo $item_image; ?>" alt="<?php echo $item_name; ?>">
            <div class="item-details">
                <h1 class="item-name"><?php echo $item_name; ?></h1>
                <p class="item-price">R<?php echo $item_price; ?></p>
                <p class="item-description"><?php echo $item_description; ?></p>
            </div>

            <form action="cart_view.php" method="post">
                <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
            </form>
            <button class="back-btn" onclick="window.location.href='index.php'">Back to Catalog</button>
        </div>
    </main>
</body>
</html>

<script>
    document.getElementById("menu-icon").addEventListener("click", function(e) {
    e.preventDefault();
    var menu = document.querySelector(".navigation-menu");
    if (menu.style.display === "block") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
});
</script>

<?php
if (isset($_POST['item_id'])) {
    $item_id = intval($_POST['item_id']);

    //Check if the user already has an active cart
    $sql = "SELECT cart_id FROM tbl_cart WHERE user_id = ? AND status = 'active'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart = $result->fetch_assoc();

    if ($cart) {
        $cart_id = $cart['cart_id'];
    } else {
        //Create a new cart if none exists
        $sql = "INSERT INTO tbl_cart (user_id, status, created_at) VALUES (?, 'active', NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $cart_id = $conn->insert_id;
    }

    $_SESSION['cart_id'] = $cart_id;

    //Add the item to the cart_item table
    $sql = "SELECT * FROM tbl_cart_item WHERE cart_id = ? AND item_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cart_id, $item_id);
    $stmt->execute();
    $check = $stmt->get_result();

    if ($check->num_rows > 0) {
        // Check if this item is already in the cart
    $sql = "SELECT * FROM tbl_cart_item WHERE cart_id = ? AND item_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cart_id, $item_id);
    $stmt->execute();
    $check = $stmt->get_result();

    if ($check->num_rows > 0) {
        // Item already in cart don’t add again
        echo "This item is already in your cart. <a href='cart_view.php'>View Cart</a>";
    } else {
        // Item not in cart add it
        $sql = "INSERT INTO tbl_cart_item (cart_id, item_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $cart_id, $item_id);
        $stmt->execute();

        echo "Item added to cart! <a href='index.php'>Back to Catalog</a> | <a href='cart_view.php'>View Cart</a>";
    }
} else {
    echo "No item selected.";
}
}
?>