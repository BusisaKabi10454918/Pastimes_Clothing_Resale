<?php
include 'DBConn.php';
session_start();
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pastimes - Home</title>
  <link rel="stylesheet" href="../css/index-style.css">
</head>
<body>

  <!-- Navigation -->
  <header class="navbar">
    
        <div class="navbar-left">
            <!--<a href="https://www.flaticon.com/free-icons/open-menu" title="open menu icons">Open menu icons created by Pixel perfect - Flaticon</a>-->
            <img src="../images/menu_icon.png" alt="Menu">
        </div>

        <div class="navbar-center">
            <a href="index.php">Pastimes</a>
        </div>

        <div class="navbar-right">
            <!--<a href="https://www.flaticon.com/free-icons/smart-cart" title="smart cart icons">Smart cart icons created by Freepik - Flaticon</a>-->
            <a href="cart.php"><img src="../images/shopping-cart_icon.png" alt="Cart"></a>
            <!--<a href="https://www.flaticon.com/free-icons/user" title="user icons">User icons created by Freepik - Flaticon</a>-->
            <a href="profile.php"><img src="../images/user_icon.png" alt="User"></a>
        </div>
  </header>
  <main>
    <img class="home-banner" src="../images/Pastimes.png" alt="Home Banner">

    <div class="home-content">
        <aside class="catalog-left">
            <h3>Categories</h3>

            <ul class="catalog-list">
                <li><a href="#">Category 1</a></li>
                <li><a href="#">Category 2</a></li>
                <li><a href="#">Category 3</a></li>
                <li><a href="#">Category 4</a></li>
                <li><a href="#">Category 5</a></li>
                <li><a href="#">Category 6</a></li>
                <li><a href="#">Category 7</a></li>
                <li><a href="#">Category 8</a></li>
            </ul>
            
        </aside>

        <div class="catalog-right">
            <div class="item">
                <img src="../images/Pastimes_favicon.png" alt="Item 1">
                <h3>Item 1</h3>
                <p>R19.99</p>
            </div>

            <div class="item">
                <img src="../images/Pastimes_favicon.png" alt="Item 2">
                <h3>Item 2</h3>
                <p>R19.99</p>
            </div>

            <div class="item">
                <img src="../images/Pastimes_favicon.png" alt="Item 3">
                <h3>Item 3</h3>
                <p>R19.99</p>
            </div>

            <div class="item">
                <img src="../images/Pastimes_favicon.png" alt="Item 4">
                <h3>Item 4</h3>
                <p>R19.99</p>
            </div>

            <div class="item">
                <img src="../images/Pastimes_favicon.png" alt="Item 5">
                <h3>Item 5</h3>
                <p>R19.99</p>
            </div>

            <div class="item">
                <img src="../images/Pastimes_favicon.png" alt="Item 6">
                <h3>Item 6</h3>
                <p>R19.99</p>
            </div>

            <div class="item">
                <img src="../images/Pastimes_favicon.png" alt="Item 7">
                <h3>Item 7</h3>
                <p>R19.99</p>
            </div>

            <div class="item">
                <img src="../images/Pastimes_favicon.png" alt="Item 8">
                <h3>Item 8</h3>
                <p>R19.99</p>
            </div>
        </div>

    </div>
      
  </main>

</body>
</html>