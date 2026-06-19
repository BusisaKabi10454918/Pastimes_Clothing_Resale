<?php
include 'DBConn.php';
session_start();
?>
<html lang="en">
    <head>
        <title>Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/dashboard_style.css">
        <link rel="icon" href="./images/pastimes_favicon.png" type="images/x-icon">
    </head>
    <body>
        <header class="navbar">
            <div class="navbar-left">
                <a class="return-button" href="admin_dashboard.php"><img src="./images/return_icon.png"></a>
            </div>

            <div class="navbar-center">
                <a href="index.php">Pastimes</a>
            </div>

            <div class="navbar-right">
                <a class="logout-button" href="admin_login.php"><img src="./images/exit_icon.png"></a>
            </div>
        </header>

        <div class="pending-Users-container">
            <div>
                
            </div>
        </div>
    </body>
</html>
