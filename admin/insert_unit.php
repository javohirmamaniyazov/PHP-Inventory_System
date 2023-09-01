<?php
include('header.php');
include '../user/connection.php';
?>

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
                    This unit already exist! Please Try Another
                </div>

                <div class="alert alert-success" id="success" style="display: none;">
                    Unit Added Successfully
                </div>
                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add New Unit</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" name="form1" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Unit Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" required placeholder="Unit Name" name="unitname" />
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
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = mysqli_query($link, 'select * from units');
                            while ($row = mysqli_fetch_array($res)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['id'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['unit'] ?>
                                    </td>
                                    <td>
                                        <a href="edit_unit.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i
                                                class="icon-pencil"></i> Edit</a>
                                        <a href="delete_unit.php?id=<?php echo $row['id'] ?>" class="btn btn-danger"><i
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

<?php
if (isset($_POST['submit1'])) {
    $count = 0;
    $result = mysqli_query($link, "select * from units where unit='$_POST[unitname]'");
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
        mysqli_query($link, "insert into units values(NULL, '$_POST[unitname]')");

        ?>
        <script type="text/javascript">
            document.getElementById("error").style.display = "none";
            document.getElementById("success").style.display = "block";
            setTimeout(function () {
                window.location.href = window.location.href;
            }, 3000);
        </script>
        <?php
    }

}
?>

<!--end-main-container-part-->

<?php
include 'footer.php';
?>