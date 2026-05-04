<?php
include 'DBConn.php';
session_start();
?>
<html lang="en">
    <head>
        <title>Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/dashboard_style.css">
        <link rel="icon" href="../images/pastimes_favicon.png" type="images/x-icon">
    </head>
    <body>
        <header class="navbar">
            <div class="navbar-left">
            </div>

            <div class="navbar-center">
                <a href="index.php">Pastimes</a>
            </div>

            <div class="navbar-right">
                <a href="admin_login.php">Logout</a>
            </div>
        </header>

        <div class="container">
            <h1>Welcome to the Admin Dashboard</h1>
            <!-- Admin dashboard content goes here -->
            <div class="task-container">

                <div class="task">
                    <a href="Create_Claims.html">
                        <img src="../images/Pastimes_favicon.png" alt="ReviewUsers">
                    </a>
                </div>

                <div class="task">
                    <a href="Claim_View_Lecturer.html">
                        <img src="../images/Pastimes_favicon.png" alt="ManageUsers">
                    </a>
                </div>

                <div class="task">
                    <a href="Supporting_Documents_Upload.html">
                        <img src="../images/Pastimes_favicon.png" alt="">
                    </a>
                </div>

            </div>
        </div>
    </body>