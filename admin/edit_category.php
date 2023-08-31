<?php
include('header.php');
include('../user/connection.php');

if (isset($_GET['id'])) {
    $categoryID = $_GET['id'];

    // Fetch category details from the database
    $categoryQuery = "SELECT * FROM categories WHERE id = $categoryID";
    $categoryResult = mysqli_query($link, $categoryQuery);
    $categoryData = mysqli_fetch_assoc($categoryResult);
}

if (isset($_POST['update'])) {
    $category = $_POST['category'];

    // Check if a new image was uploaded
    if (!empty($_FILES['image']['name'])) {
        $imageUploadDir = 'images/';
        $imageFileName = $_FILES['image']['name'];
        $targetImagePath = $imageUploadDir . $imageFileName;

        // Move the uploaded image to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetImagePath)) {
            // Update category details including the new image
            $updateQuery = "UPDATE categories SET category = '$category', image = '$imageFileName' WHERE id = $categoryID";
            if (mysqli_query($link, $updateQuery)) {
                echo "Category updated successfully.";
            } else {
                echo "Error updating category.";
            }
        } else {
            echo "Error uploading image.";
        }
    } else {
        // Update category details without changing the image
        $updateQuery = "UPDATE categories SET category = '$category' WHERE id = $categoryID";
        if (mysqli_query($link, $updateQuery)) {
            echo "Category updated successfully.";
        } else {
            echo "Error updating category.";
        }
    }
}
?>

<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-user"></i>
                Edit Category</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span12">
                <div class="alert alert-danger" id="error" style="display: none;">
                    This Category already exist! Please Try Another
                </div>

                <div class="alert alert-success" id="success" style="display: none;">
                    Category Updated Successfully
                </div>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Edit Category</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" name="editCategoryForm" method="post" class="form-horizontal"
                            enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Category Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" required placeholder="Category Name"
                                        name="category" value="<?php echo $categoryData['category']; ?>" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Category Image :</label>
                                <div class="controls">
                                    <input type="file" name="image" accept="image/*" />
                                    <?php
                                    $imagePath = 'images/' . $categoryData['image']; // Assuming images are in the 'images' folder
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" alt="Category Image"
                                        style="width: 90px; height: 40px;">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" name="update" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>