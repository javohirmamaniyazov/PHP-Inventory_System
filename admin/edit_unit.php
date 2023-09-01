<?php
    include('header.php');
    include '../user/connection.php';

    
    
    $id = $_GET['id'];

    $unit = "";
    $result = mysqli_query($link, "select * from units where id='$id'");
    while($row=mysqli_fetch_array($result)){
        $unit = $row['unit'];
    }
?>
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                Home</a></div>
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
                    Unit Updated Successfully
                </div>
                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Edit Unit</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" name="form1" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Unit Name</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Unit name" value="<?php echo $unit ?>" name="unitname" />
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
        mysqli_query($link, "update units set unit='$_POST[unitname]' where id=$id");
        ?>
        <script type="text/javascript">
            window.location = 'insert_unit.php';
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