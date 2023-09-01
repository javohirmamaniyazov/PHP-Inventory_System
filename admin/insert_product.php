<?php
include('header.php');
include('../user/connection.php');
?>

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
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span12">
                <div class="alert alert-danger" id="error" style="display: none;">
                    This Product already exist! Please Try Another
                </div>

                <div class="alert alert-success" id="success" style="display: none;">
                    Product Added Successfully
                </div>
                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add New Product</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" name="categoryForm" method="post" class="form-horizontal"
                            enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Category Name :</label>
                                <div class="controls">
                                    <select class="span11" name="category" required>
                                        <option>Select</option>
                                        <?php
                                        $result = mysqli_query($link, 'select * from categories');
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option>";
                                            echo $row['category'];
                                            echo "</option>";
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Product Name :</label>
                                <div class="controls">
                                    <input type="text" name="product" required class="span11"
                                        placeholder="Enter Product Name" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Product Size :</label>
                                <div class="controls">
                                    <input type="text" name="size" id="sizeInput" class="span11" required
                                        placeholder="Enter Product Size" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Unit Name :</label>
                                <div class="controls">
                                    <select class="span11" name="unit" id="unitSelect" required>
                                        <option value="">Select</option>
                                        <?php
                                        $result = mysqli_query($link, 'select * from units');
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option>";
                                            echo $row['unit'];
                                            echo "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Expiration Date :</label>
                                <div class="controls">
                                    <input type="date" name="expiration_date" class="span11" required
                                        placeholder="Select Expiration Date" />
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="submit1" class="btn btn-success">Save</button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Product Name</th>
                                <th>Unit</th>
                                <th>Product Size</th>
                                <th>Expiration Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = mysqli_query($link, 'select * from products');
                            while ($row = mysqli_fetch_array($res)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['id'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['category'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['product'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['unit'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['size'] ?>
                                    </td>
                                    <td>
                                        <?php echo date('M j, Y', strtotime($row['expiration_date'])); ?>
                                    </td>
                                    <td>
                                        <a href="edit_product.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i
                                                class="icon-pencil"></i> Edit</a>
                                        <a href="delete_product.php?id=<?php echo $row['id'] ?>" class="btn btn-danger"><i
                                                class="icon-trash"></i> Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        const unitSelect = document.getElementById("unitSelect");
        const quantityInput = document.getElementById("quantityInput");
        const sizeInput = document.getElementById("sizeInput");

        unitSelect.addEventListener("change", function () {
            if (this.value !== "") {
                quantityInput.readOnly = true;
                quantityInput.value = "";
                sizeInput.readOnly = false;
            } else {
                quantityInput.readOnly = false;
                sizeInput.readOnly = false;
            }
        });

        quantityInput.addEventListener("input", function () {
            if (this.value !== "") {
                unitSelect.disabled = true;
                sizeInput.readOnly = true;
            } else {
                unitSelect.disabled = false;
                sizeInput.readOnly = false;
            }
        });
    });
</script> -->




<?php
if (isset($_POST['submit1'])) {
    $count = 0;
    $result = mysqli_query($link, "select * from products where category='$_POST[category]' && product='$_POST[product]' && unit='$_POST[unit]' && size='$_POST[size]' && expiration_date='$_POST[expiration_date]'") or die(mysqli_error($link));
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        ?>
        <script type="text/javascript">
            document.getElementById("success").style.display = "none";
            document.getElementById("error").style.display = "block";
            setTimeout(function () {
                window.location.href = window.location.href;
            }, 2000);
        </script>
        <?php
    } else {
        // mysqli_query($link, "insert into products values(NULL, '$_POST[category]', '$_POST[product]', '$_POST[unit]', '$_POST[size]', '$_POST[expiration_date]', '$_POST[quantity]')") or die(mysqli_error($link));
        mysqli_query($link, "INSERT INTO products (category, product, unit, size, expiration_date) VALUES ('$_POST[category]', '$_POST[product]', '$_POST[unit]', '$_POST[size]', '$_POST[expiration_date]')") or die(mysqli_error($link));


        ?>
        <script type="text/javascript">
            document.getElementById("error").style.display = "none";
            document.getElementById("success").style.display = "block";
            setTimeout(function () {
                window.location.href = window.location.href;
            }, 2000);
        </script>
        <?php
    }

}
?>


<!--end-main-container-part-->

<?php
include 'footer.php';
?>