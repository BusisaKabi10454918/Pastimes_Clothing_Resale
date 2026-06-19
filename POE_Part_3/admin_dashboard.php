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
            </div>

            <div class="navbar-center">
                <a href="index.php">Pastimes</a>
            </div>

            <div class="navbar-right">
                <a class="logout-button" href="admin_login.php"><img src="./images/exit_icon.png"></a>
            </div>
        </header>

        <div class="container">
            <h1>Welcome to the Admin Dashboard</h1>
            <!-- Admin dashboard content goes here -->
            <div class="task-container">

                <div class="task">
                    <a href="ReviewPendingUsers.php">
                        <img src="./images/review_new_sellers_icon.png" alt="ReviewUsers">
                        <h1>Review Pending Users</h1>
                    </a>
                </div>

                <div class="task">
                    <a href="ManageUsers.php">
                        <img src="./images/user_management_icon.png" alt="ManageUsers">
                        <h1>Manage Users</h1>
                    </a>
                </div>

                <div class="task">
                    <a href="EditApproveListings.php">
                        <img src="./images/edit_approve _listings_icon.png" alt="editListings">
                        <h1>Edit/Approve Listings</h1>
                    </a>
                </div>

                <div class="task">
                    <a href="MessageSellers.php">
                        <img src="./images/message_sellers_icon.png" alt="messageSellers">
                        <h1>Message Sellers</h1>
                    </a>
                </div>

            </div>
        </div>
    </body>