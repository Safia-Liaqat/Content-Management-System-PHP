<?php
include "config.php";
$catid=$_GET['catid'];
$postid=$_GET['id'];
$sql="DELETE from post WHERE post_id={$postid};";
$sql.="UPDATE category SET post=post-1 WHERE category_id={$catid};";
if(mysqli_multi_query($conn,$sql))
{
 header("location:post.php");
}else{
echo "query failed";
}
?>