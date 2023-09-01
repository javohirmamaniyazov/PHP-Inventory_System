<?php
include('header.php');
include '../user/connection.php';

?>
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-user"></i>
                Add New User</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span12">
                <div class="alert alert-danger" id="error" style="display: none;">
                    This user already exist! Please Try Another
                </div>

                <div class="alert alert-success" id="success" style="display: none;">
                    User Added Successfully
                </div>
                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add New User</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" name="form1" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">User Name :</label>
                                <div class="controls">
                                    <input type="text" class="span11" required placeholder="Username" name="username" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Password</label>
                                <div class="controls">
                                    <input type="password" required class="span11" placeholder="Enter Password"
                                        name="password" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Select Role</label>
                                <div class="controls">
                                    <select required class="span11" name="role">
                                        <option>user</option>
                                        <option>admin</option>
                                    </select>
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
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = mysqli_query($link, 'select * from users');
                            while ($row = mysqli_fetch_array($res)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['id'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['username'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['role'] ?>
                                    </td>
                                    <td>
                                        <a href="edit_user.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i
                                                class="icon-pencil"></i> Edit</a>
                                        <a href="delete_user.php?id=<?php echo $row['id'] ?>" class="btn btn-danger"><i
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
    $result = mysqli_query($link, "select * from users where username='$_POST[username]'");
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
        mysqli_query($link, "insert into users values(NULL, '$_POST[username]', '$_POST[password]', '$_POST[role]')");

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