<?php
    include('header.php');
    include '../user/connection.php';

    $id = $_GET['id'];

    $username = "";
    $role = "";
    $password = "";
    $result = mysqli_query($link, "select * from users where id='$id'");
    while($row=mysqli_fetch_array($result)){
        $username = $row['username'];
        $role = $row['role'];
        $password = $row['password'];
    }
?>


<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
    <div id="breadcrumb"><a href="dashboard.php"   class="tip-bottom"><i class="icon-home"></i>
                Dashboard</a><a href="insert_user.php"   class="tip-bottom"><i class="icon-user"></i>
                Insert User</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span12">
                <div class="alert alert-danger" id="error" style="display: none;">
                    Something wen't wrong!
                </div>

                <div class="alert alert-success" id="success" style="display: none;">
                    User Updated Successfully
                </div>
                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Edit User</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" name="form1" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">User Name</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Username" value="<?php echo $username ?>" name="username" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Password</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter Password" value="<?php echo $password ?>"
                                        name="password" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Select Role</label>
                                <div class="controls">
                                    <select class="span11" name="role">
                                        <option <?php if($role == 'user'){ echo 'selected'; }?> >user</option>
                                        <option <?php if($role == 'admin'){ echo 'selected'; }?> >admin</option>
                                    </select>
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
    if(isset($_POST['submit1'])) {
        mysqli_query($link, "update users set username='$_POST[username]', role='$_POST[role]', password='$_POST[password]' where id=$id");
        ?>
        <script type="text/javascript">
            window.location = 'insert_user.php';
            setTimeout(function () {
                
            }, 10000);
            document.getElementById("success").style.display = "block";
            
        </script>
        <?php
    }
?>

<!--end-main-container-part-->

<?php
include 'footer.php';
?>