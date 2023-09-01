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
        <div id="breadcrumb"><a href="dashboard.php"   class="tip-bottom"><i class="icon-home"></i>
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
        if (isset($_POST['search'])) {
            $searchDate = $_POST['searchDate'];
            $searchCategory = $_POST['searchCategory'];

            $sql = "SELECT p.product, c.category, p.unit, p.size, p.quantity, p.expiration_date
            FROM products p
            INNER JOIN categories c ON p.category = c.category
            WHERE (p.expiration_date >= '$searchDate' OR p.expiration_date IS NULL)
            " . ($searchCategory ? "AND p.category = '$searchCategory'" : "");

            $result = mysqli_query($link, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<h3 class='text-center'>Search Results</h3>";
                echo "<div class='well'>";
                echo "<table class='table table-bordered'>";
                echo "<thead>";
                echo "<tr><th>Product</th><th>Category</th><th>Unit</th><th>Size</th><th>Quantity</th><th>Expiration Date</th></tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['product'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['unit'] . "</td>";
                    echo "<td>" . $row['size'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['expiration_date'] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found.</p>";
            }
        }
        ?>
    </div>