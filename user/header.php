<?php
include './connection.php';
session_start();
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Warehouse</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/fullcalendar.css" />
    <link rel="stylesheet" href="css/matrix-style.css" />
    <link rel="stylesheet" href="css/matrix-media.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>


    <div id="header">

        <h3 style="color: white;position: absolute">
            <a href="dashboard.html" style="color:white; margin-left: 30px; margin-top: 40px">Warehouse</a>
        </h3>
    </div>

    <div id="user-nav" class="navbar navbar-inverse">
        <ul class="nav">
            <li class="dropdown" id="profile-messages">
                <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i
                        class="icon icon-user"></i> <span class="text" style="font-size: 13px;"> Welcome <?php echo $username; ?></span></a>
            </li>
        </ul>
    </div>

    <!--sidebar-menu-->
    <div id="sidebar">
        <ul>
            <li class="" id="dashboard">
                <a href="dashboard.php"><i class="icon icon-home"></i><span>Dashboard</span></a>
            </li>

            <li class="" id="stock_master">
                <a href="stock_master.php"><i class="fa-solid fa-warehouse"></i><span>Stock Master</span></a>
            </li>

           

        </ul>
    </div>
    <!--sidebar-menu-->
    <div id="search">
        <a href="../logout.php" style="color: white"><i class="icon icon-share-alt"></i><span>LogOut</span></a>
    </div>

    <script>
        // JavaScript to set the active class based on the current page
        const currentUrl = window.location.href;
        const menuItems = document.querySelectorAll("#sidebar ul li");
        
        menuItems.forEach((menuItem) => {
            const link = menuItem.querySelector("a");
            if (link && currentUrl.includes(link.getAttribute("href"))) {
                menuItem.classList.add("active");
            }
        });
    </script>


    