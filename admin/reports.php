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
        <div id="breadcrumb"><a href="dashboard.php" class="tip-bottom"><i class="icon-home"></i>
                Dashboard</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <h3 class="text-center">Reports of Products</h3>
                <div class="well search-form-container">
                    <form action="" method="POST" class="form-inline search-form">
                        <div style="display: flex;">
                            <div class="form-group" style="margin-right: 40px;">
                                <label for="searchDate">Select Date:</label>
                                <input type="date" name="searchDate" id="searchDate" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="searchCategory">Select Category:</label>
                                <select name="searchCategory" id="searchCategory" class="form-control"
                                    style="height: 35px;">
                                    <option value="">All Categories</option>
                                    <?php
                                    $result = mysqli_query($link, 'select * from categories');
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" name="search" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>



        <?php
        // Initialize variables for search criteria
        $searchDate = isset($_POST['searchDate']) ? mysqli_escape_string($link, $_POST['searchDate']) : '';
        $searchCategory = isset($_POST['searchCategory']) ? mysqli_escape_string($link, $_POST['searchCategory']) : '';

        // Construct the WHERE clause based on user input
        $whereClause = '';

        if (!empty($searchDate) && !empty($searchCategory)) {
            $whereClause = "WHERE (p.expiration_date >= '$searchDate' OR p.expiration_date IS NULL) AND c.category = '$searchCategory'";
        } elseif (!empty($searchDate)) {
            $whereClause = "WHERE p.expiration_date >= '$searchDate' OR p.expiration_date IS NULL";
        } elseif (!empty($searchCategory)) {
            $whereClause = "WHERE c.category = '$searchCategory'";
        }

        // Search query
        $sql = "SELECT p.product, c.category, p.unit, p.size, p.expiration_date, s.price, s.quantity
        FROM products p
        INNER JOIN categories c ON p.category = c.category
        LEFT JOIN stock s ON p.id = s.product_id
        $whereClause";

        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            ?>
            <div class="well">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Expiration</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['product'] . "</td>";
                            echo "<td>" . $row['category'] . "</td>";
                            echo "<td>" . $row['unit'] . "</td>";
                            echo "<td>" . $row['size'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . $row['expiration_date'] . "</td>";
                            echo "<td>" . $row['price'] . "</td>";
                            echo "</tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
            <?php

        } else {
            echo "<p class='text-center'>No results found.</p>";
        }
        ?>

    </div>