<?php
include('header.php');
include('../user/connection.php');



if (isset($_POST['submit1'])) {
    $category = $_POST['category'];

    $imageUploadDir = 'images/';
    $imageFileName = $_FILES['image']['name'];
    $targetImagePath = $imageUploadDir . $imageFileName;
    $imageFileType = strtolower(pathinfo($targetImagePath, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check === false) {
        echo "File is not an image.";
    } else {
        // Check if a file with the same name already exists
        if (file_exists($targetImagePath)) {
            echo "Sorry, file already exists.";
        } else {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetImagePath)) {
                $insertQuery = "INSERT INTO categories (category, image) VALUES ('$category', '$imageFileName')";
                if (mysqli_query($link, $insertQuery)) {
                    echo "Category added successfully.";
                } else {
                    echo "Error inserting data into the database.";
                }
            } else {
                echo "Error uploading image.";
            }
        }
    }
}
?>

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
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span12">
                <div class="alert alert-danger" id="error" style="display: none;">
                    This Category already exist! Please Try Another
                </div>

                <div class="alert alert-success" id="success" style="display: none;">
                    Category Added Successfully
                </div>
                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add New Category</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" name="categoryForm" method="post" class="form-horizontal"
                            enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Category Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" required placeholder="Category Name"
                                        name="category" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Category Image :</label>
                                <div class="controls">
                                    <input type="file" name="image" accept="image/*" />
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
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = mysqli_query($link, 'select * from categories');
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
                                        <?php
                                        $imagePath = 'images/' . $row['image']; // Assuming images are in the 'images' folder
                                        ?>
                                        <img src="<?php echo $imagePath; ?>" alt="Category Image"
                                            style="width: 77px; height: 35px;">
                                    </td>
                                    <td>
                                        <a href="edit_category.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i
                                                class="icon-pencil"></i> Edit</a>
                                        <a href="delete_category.php?id=<?php echo $row['id'] ?>" class="btn btn-danger"><i
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

<!--end-main-container-part-->

<?php
include 'footer.php';
?>