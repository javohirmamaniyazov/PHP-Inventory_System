<?php
include('header.php');
include('../user/connection.php');
?>

<style>
    .row-fluid .span12 {
        padding: 20px;
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .row-fluid h3 {
        color: #333;
    }

    .dashboard-info {
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 20px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .dashboard-count {
        font-size: 24px;
        font-weight: bold;
        color: #337ab7;
    }

    .search-form-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .search-form .form-group {
        margin-right: 20px;
        margin-bottom: 0;
    }

    .search-form button {
        margin-top: 0;
    }

    .search-form label {
        font-weight: bold;
        margin-right: 10px;
    }

    .search-form .form-control {
        width: 200px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
        font-size: 14px;
    }

    .search-form .btn-primary {
        background-color: #337ab7;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .search-form .btn-primary:hover {
        background-color: #235a96;
    }

    .search-form-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search-form .form-group {
        margin-right: 10px;
        margin-bottom: 0;
    }

    .search-form button {
        margin-top: 10px;
    }
</style>

<!-- The rest of your HTML code -->

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-user"></i>
                Products</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <h3 class="text-center">Warehouse Dashboard</h3>
                <div class="well">
                    <div class="row-fluid">
                        <div class="span4 text-center">
                            <h4>Products</h4>
                            <div class="dashboard-info">
                                <p>Total Products</p>
                                <p class="dashboard-count">
                                    <?php echo getTotalProducts($link); ?>
                                </p>
                            </div>
                        </div>
                        <div class="span4 text-center">
                            <h4>Categories</h4>
                            <div class="dashboard-info">
                                <p>Total Categories</p>
                                <p class="dashboard-count">
                                    <?php echo getTotalCategories($link); ?>
                                </p>
                            </div>
                        </div>
                        <div class="span4 text-center">
                            <h4>Users</h4>
                            <div class="dashboard-info">
                                <p>Total Users</p>
                                <p class="dashboard-count">
                                    <?php echo getTotalUsers($link); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <?php
    include('footer.php');
    ?>

    <?php
    function getTotalProducts($link)
    {
        // Perform a database query to count total products and return the count
        $result = mysqli_query($link, 'SELECT COUNT(*) AS total FROM products');
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }

    function getTotalCategories($link)
    {
        // Perform a database query to count total categories and return the count
        $result = mysqli_query($link, 'SELECT COUNT(*) AS total FROM categories');
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }

    function getTotalUsers($link)
    {
        // Perform a database query to count total users and return the count
        $result = mysqli_query($link, 'SELECT COUNT(*) AS total FROM users');
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    ?>