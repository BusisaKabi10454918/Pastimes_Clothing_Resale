<?php
session_start();
include 'DBConn.php';
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pastimes - Home</title>
  <link rel="stylesheet" href="./css/index-style.css">
  <link rel="icon" href="./images/pastimes_favicon.png" type="image/x-icon">
</head>
<body>

  <!-- Navigation -->
  <header class="navbar">
        <div class="navbar-left">
          <div class="icon-container">
            <img id="menu-icon" src="./images/menu_icon.png" alt="Menu Icon" onclick="">
          </div>
        </div>
        <div class="navbar-center">
            <a href="index.php">Pastimes</a>
        </div>
        <div class="navbar-right">
            <div class="icon-container">
              <img id="cart-icon" src="./images/cart_icon.png" alt="Cart Icon" onclick="window.location.href='cart_view.php'">
            </div>
              <div class="icon-container">
                <img id="profile-icon" src="./images/user_icon.png" alt="Profile Icon" onclick="window.location.href='profile.php'">
              </div>
        </div>
    </header>
    <div class="navigation-menu">
        <div class="navigation-item"><a href="login.php">Logout</a></div>
        <div class="navigation-item"><a href="index.php">Home</a></div>
    </div>

  <main>

    <img class="home-banner" src="./images/pastimes.png" alt="Home Banner">

    <?php
      if (!isset($_SESSION['user_id'])) {
        die("No user logged in.");
      }
      $user_id = $_SESSION['user_id'];
      $sql = "SELECT ci.* FROM tbl_cart_item ci 
              JOIN tbl_cart c ON ci.cartID = c.id 
              WHERE c.userID = $user_id";

      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
    ?>

      <div class="cart-item">
        <div class="item-thumb">
          <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
      </div>

      <div class="item-name"><?php echo htmlspecialchars($row['name']); ?></div>

      <div class="button-row">

        <form method="post" action="remove_item.php">

            <input type="hidden" name="cart_item_id" value="<?php echo $row['cart_item_id']; ?>">

            <button class="remove_item" type="submit">

                <img src="./images/remove_button.png" alt="Remove">

            </button>

        </form>
    </div>
</div>