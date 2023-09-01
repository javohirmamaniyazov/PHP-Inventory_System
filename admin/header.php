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
</head>

<body>


    <div id="header">

        <h3 style="color: white;position: absolute">
            <a href="dashboard.html" style="color:white; margin-left: 30px; margin-top: 40px">Warehouse</a>
        </h3>
    </div>


    <!--top-Header-menu-->
    

    <!--sidebar-menu-->
    <div id="sidebar">
        <ul>
            <li class="active">
                <a href="dashboard.php"><i class="icon icon-home"></i><span>Dashboard</span></a>
            </li>

            <li class="">
                <a href="reports.php"><i class="icon icon-user"></i><span>Reports</span></a>
            </li>

            <li class="">
                <a href="insert_user.php"><i class="icon icon-user"></i><span>Users</span></a>
            </li>

            <li class="">
                <a href="insert_unit.php"><i class="icon icon-user"></i><span>Units</span></a>
            </li>

            <li class="">
                <a href="insert_category.php"><i class="icon icon-list"></i><span>Categories</span></a>
            </li>

            <li class="">
                <a href="insert_product.php"><i class="icon icon-list"></i><span>Products</span></a>
            </li>

            <li class="">
                <a href="stock_master.php"><i class="icon icon-list"></i><span>Stock Master</span></a>
            </li>

            <li class="submenu"><a href="#"><i class="icon icon-th-list"></i> <span>Forms</span> <span
                        class="label label-important">3</span></a>
                <ul>
                    <li><a href="form-common.html">Basic Form</a></li>
                    <li><a href="form-validation.html">Form with Validation</a></li>
                    <li><a href="form-wizard.html">Form with Wizard</a></li>
                </ul>
            </li>

        </ul>
    </div>
    <!--sidebar-menu-->
    <div id="search">

        <a href="../logout.php" style="color: white"><i class="icon icon-share-alt"></i><span>LogOut</span></a>
    </div>