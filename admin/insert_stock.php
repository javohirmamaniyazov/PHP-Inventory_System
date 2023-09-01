<?php
include('header.php');
include('../user/connection.php');

if (isset($_POST['submit1'])) {
    $owner_id = 1; 

    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $existing_stock_query = mysqli_query($link, "SELECT * FROM stock WHERE owner_id = '$owner_id' AND product_id = '$product_id'");
    
    if (mysqli_num_rows($existing_stock_query) > 0) {
        $error = "A stock item with the same product name already exists.";
    } else {
        mysqli_query($link, "INSERT INTO stock (owner_id, product_id, quantity, price) VALUES ('$owner_id', '$product_id', '$quantity', '$price')") or die(mysqli_error($link));

        header('Location: stock_master.php');
        exit;
    }
}
?>

<div id="content">
    <div id="breadcrumb"><a href="dashboard.php"   class="tip-bottom"><i class="icon-home"></i>
            Dashboard</a></div>

    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span12">
                <!-- Create Stock Form -->
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Create Stock</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" name="stockForm" method="post" class="form-horizontal"
                            enctype="multipart/form-data">
                            <!-- Product Selector -->
                            <div class="control-group">
                                <label class="control-label">Select Product:</label>
                                <div class="controls">
                                    <select class="span11" name="product_id" required>
                                        <option>Select</option>
                                        <?php
                                        $result = mysqli_query($link, 'SELECT id, product FROM products');
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='{$row['id']}'>{$row['product']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Quantity -->
                            <div class="control-group">
                                <label class="control-label">Quantity:</label>
                                <div class="controls">
                                    <input type="number" name="quantity" class="span11" placeholder="Enter Quantity"
                                        required>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="control-group">
                                <label class="control-label">Price:</label>
                                <div class="controls">
                                    <input type="text" name="price" class="span11" placeholder="Enter Price" required>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-actions">
                                <button type="submit" name="submit1" class="btn btn-success">Create Stock</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>