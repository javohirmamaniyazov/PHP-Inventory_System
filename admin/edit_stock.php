<?php
include('header.php');
include('../user/connection.php');

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $stock_id = $_GET['id'];

    // Retrieve the stock item details based on the provided ID
    $stock_query = mysqli_query($link, "SELECT * FROM stock WHERE id = '$stock_id'");
    $stock_row = mysqli_fetch_array($stock_query);

    if (!$stock_row) {
        // Handle the case where the stock item with the provided ID doesn't exist
        echo "Stock item not found.";
        exit;
    }

    // Check if the form is submitted to update the stock item
    if (isset($_POST['submit'])) {
        // Retrieve updated values from the form
        $newQuantity = $_POST['quantity'];
        $newPrice = $_POST['price'];

        // Update the stock item in the database
        mysqli_query($link, "UPDATE stock SET quantity = '$newQuantity', price = '$newPrice' WHERE id = '$stock_id'");

        // Redirect to the stock master page after successful update
        header('Location: stock_master.php');
        exit;
    }
} else {
    // Handle the case where no ID is provided in the URL
    echo "No stock item ID provided.";
    exit;
}
?>

<!-- The HTML form to edit the stock item -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="dashboard.php"   class="tip-bottom"><i class="icon-home"></i>
                Dashboard</a><a href="stock_master.php"   class="tip-bottom"><i class="fa-solid fa-warehouse"></i>
                Stock Master</a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Edit Stock Item</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Product Name:</label>
                                <div class="controls">
                                    <?php
                                    $result = mysqli_query($link, 'SELECT id, product FROM products');
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>

                                        <input type="text" value="<?php echo $row['product']; ?>" class="span11" readonly />
                                        <?php

                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Quantity:</label>
                                <div class="controls">
                                    <input type="text" name="quantity" value="<?php echo $stock_row['quantity']; ?>"
                                        class="span11" placeholder="Enter Quantity" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Price:</label>
                                <div class="controls">
                                    <input type="text" name="price" value="<?php echo $stock_row['price']; ?>"
                                        class="span11" placeholder="Enter Price" required />
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>