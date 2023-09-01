<?php 
 include '../user/connection.php';

 $id = $_GET['id'];
 mysqli_query($link, "delete from categories where id='$id'");
 session_start();
    if(!isset($_SESSION['admin'])) {
        ?>
        <script type="text/javascript">
            window.location="../index.php"
        </script>
        <?php
    }
?>

<script type="text/javascript">
    window.location="insert_category.php";
</script>