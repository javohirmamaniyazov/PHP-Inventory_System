<?php
include('header.php');
include('../user/connection.php');

if (isset($_POST['submit'])) {
    $product_id = mysqli_escape_string($link, $_POST['product_id']);
    $quantity = mysqli_escape_string($link, $_POST['quantity']);
    $price = mysqli_escape_string($link, $_POST['price']);
    $owner_id = mysqli_escape_string($link, $_POST['owner_id']);

    // Check if a stock item with the same product name already exists
    $existing_stock_query = mysqli_query($link, "SELECT * FROM stock WHERE product_id = '$product_id'");
    
    if (mysqli_num_rows($existing_stock_query) > 0) {
        // Stock item already exists, display an error message
        $error = "A stock item with the same product name already exists.";
    } else {
        // Stock item doesn't exist, create a new one
        $insert_query = "INSERT INTO stock (product_id, quantity, price, owner_id) VALUES ('$product_id', '$quantity', '$price', '$owner_id')";
        if (mysqli_query($link, $insert_query)) {
            $message = "Stock item created successfully.";
        } else {
            $error = "Error creating stock item: " . mysqli_error($link);
        }
    }
}

?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="dashboard.php"   class="tip-bottom"><i class="icon-home"></i>
                Dashboard</a></div>
    </div>

    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span12">
                <!-- Create Stock Button -->
                <div class="text-right">
                    <a href="insert_stock.php" class="btn btn-primary"><i class="icon-plus"></i> Create Stock</a>
                </div>

                <!-- Stock Table -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Stock Owner</th>
                            <th>Product Name</th>
                            <th>Quantity of Parts</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    <tbody>
                        <?php
                        $res = mysqli_query($link, 'SELECT s.id, s.owner_id, s.product_id, s.quantity, s.price FROM stock s');
                        while ($row = mysqli_fetch_array($res)) {
                            // Retrieve owner's name based on owner_id
                            $owner_id = $row['owner_id'];
                            $owner_query = mysqli_query($link, "SELECT username FROM users WHERE id = '$owner_id'");
                            $owner_row = mysqli_fetch_array($owner_query);
                            $owner_name = $owner_row['username'];

                            // Retrieve product name based on product_id
                            $product_id = $row['product_id'];
                            $product_query = mysqli_query($link, "SELECT product FROM products WHERE id = '$product_id'");
                            $product_row = mysqli_fetch_array($product_query);
                            $product_name = $product_row['product'];
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['id']; ?>
                                </td>
                                <td>
                                    <?php echo $owner_name; ?>
                                </td>
                                <td>
                                    <?php echo $product_name; ?>
                                </td>
                                <td>
                                    <?php echo $row['quantity']; ?>
                                </td>
                                <td>
                                    <?php echo $row['price']; ?> $
                                </td>
                                <td>
                                    <a href="edit_stock.php?id=<?php echo $row['id']; ?>" class="btn btn-warning"><i
                                            class="icon-pencil"></i> Edit</a>
                                    <a href="delete_stock.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i
                                            class="icon-trash"></i> Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                if (isset($message)) {
                    echo "<div class='alert alert-success'>$message</div>";
                }
                if (isset($error)) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
include 'footer.php';
?>
