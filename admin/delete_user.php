<?php 
 include '../user/connection.php';

 $id = $_GET['id'];
 mysqli_query($link, "delete from users where id='$id'");
?>

<script type="text/javascript">
    window.location="insert_user.php";
</script>