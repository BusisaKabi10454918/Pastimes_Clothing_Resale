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

    <div class="content-section">

      <div class="category-list">
        <div class="category-item"><p>Men's Tops</p></div>
        <div class="category-item"><p>Women's Tops</p></div>
        <div class="category-item"><p>Men's Bottoms</p></div>
        <div class="category-item"><p>Women's Bottoms</p></div>
        <div class="category-item"><p>Unisex Tops</p></div>
        <div class="category-item"><p>Unisex Bottoms</p></div>
        <div class="category-item"><p>Accessories</p></div>
        <div class="category-item"><p>Men's Footwear</p></div>
        <div class="category-item"><p>Women's Footwear</p></div>
        <div class="category-item"><p>Unisex Footwear</p></div>
      </div>

      <div class="catalog">
        <?php 
          $sql = "SELECT * FROM tbl_item";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<a href="item_page.php?item_id=' . $row['id'] . '" class="item">';
              echo '<img class="item-thumb" src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
              echo '<div class="item-info">';
              echo '<span class="item-name">' . htmlspecialchars($row['name']) . '</span>';
              echo '<span class="item-price">R' . number_format($row['price'], 2) . '</span>';
              echo '</div>';
              echo '</a>';
            }
          }
        ?>
      </div>
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