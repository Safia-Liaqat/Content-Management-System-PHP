<?php
 include "config.php";
 $userid=$_GET['id'];
 $sql="DELETE FROM user WHERE user_id='{$userid}'";
 $result=mysqli_query($conn,$sql) or die ("query unsucessfull");
 header("location:users.php");
?>