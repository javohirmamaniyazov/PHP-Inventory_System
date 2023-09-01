<?php 
 include '../user/connection.php';

 $id = $_GET['id'];
 mysqli_query($link, "delete from stock where id='$id'");

?>

<script type="text/javascript">
    window.location="stock_master.php";
</script>