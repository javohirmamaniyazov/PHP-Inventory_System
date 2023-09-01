<?php
include('header.php');
include('../user/connection.php');

session_start();
    if(!isset($_SESSION['admin'])) {
        ?>
        <script type="text/javascript">
            window.location="../index.php"
        </script>
        <?php
    }

$id = $_GET['id'];

    $category ="";
    $product ="";
    $unit = "";
    $size = "";
    $quantity = "";
    $expiration_date = "";
    $result = mysqli_query($link, "select * from products where id='$id'");
    while($row=mysqli_fetch_array($result)){
        $category = $row['category'];
        $product = $row['product'];
        $unit = $row['unit'];
        $size = $row['size'];
        $expiration_date = $row['expiration_date'];
        $quantity = $row['quantity'];
    }
?>

<!-- The rest of your HTML code -->

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-user"></i>
                Edit Product</a></div>
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
                    Product Updated Successfully
                </div>
                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Edit Product</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" name="categoryForm" method="post" class="form-horizontal"
                            enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Category Name :</label>
                                <div class="controls">
                                    <select class="span11" name="category">
                                        <option>Select</option>
                                        <?php
                                        $result = mysqli_query($link, 'select * from categories');
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option <?php if($row['category'] == $category){ echo 'selected'; } ?> >
                                            <?php
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
                                    <input type="text" name="product" class="span11" value="<?php echo $product ?>" placeholder="Enter Product Name" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Unit Name :</label>
                                <div class="controls">
                                    <select class="span11" name="unit">
                                        <option>Select</option>
                                        <?php
                                        $result = mysqli_query($link, 'select * from units');
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option <?php if($row['unit'] == $unit){ echo 'selected'; } ?> >
                                            <?php
                                            echo $row['unit'];
                                            echo "</option>";
                                        }
                                        ?>
                                    </select>

                                </div>

                                <div class="control-group">
                                    <label class="control-label">Product Size :</label>
                                    <div class="controls">
                                        <input type="text" name="size" class="span11" value="<?php echo $size ?>"
                                            placeholder="Enter Product Size" />
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                    <label class="control-label">Quantity :</label>
                                    <div class="controls">
                                        <input type="number" name="quantity" class="span11" required value="<?php echo $quantity; ?>"
                                            placeholder="Enter Quantity" />
                                    </div>
                                </div>

                            <div class="control-group">
                                    <label class="control-label">Expiration Date :</label>
                                    <div class="controls">
                                        <input type="date" name="expiration_date" class="span11" required  value="<?php echo $expiration_date ?>"
                                            placeholder="Select Expiration Date" />
                                    </div>
                                </div>

                            <div class="form-actions">
                                <button type="submit" name="submit1" class="btn btn-success">Save</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['submit1'])) {
    $count = 0;
    $result = mysqli_query($link, "select * from products where category='$_POST[category]' && product='$_POST[product]' && unit='$_POST[unit]' && size='$_POST[size]' && expiration_date='$_POST[expiration_date]' && quantity='$_POST[quantity]'") or die(mysqli_error($link));
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        ?>
        <script type="text/javascript">
            document.getElementById("success").style.display = "none";
            document.getElementById("error").style.display = "block";
            setTimeout(function () {
                window.location.href = window.location.href;
            }, 3000);
        </script>
        <?php
    } else {
        mysqli_query($link, "update products set category='$_POST[category]', product='$_POST[product]', unit='$_POST[unit]', size='$_POST[size]', expiration_date='$_POST[expiration_date]', quantity='$_POST[quantity]' where id='$id'") or die(mysqli_error($link));

        ?>
        <script type="text/javascript">
            document.getElementById("error").style.display = "none";
            document.getElementById("success").style.display = "block";
            setTimeout(function () {
                window.location='insert_product.php';
            }, 1000);
        </script>
        <?php
    }

}
?>


<!--end-main-container-part-->

<?php
include 'footer.php';
?>