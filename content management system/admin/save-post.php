<?php

    include "config.php";
 // if(isset($_FILES('fileToUpload')))
//  {
  if(isset($_POST['submit']))
  {
    $errors=array();
    $files=$_FILES['fileToUpload'];
    $filename=$files['name'];
    $filsize=$files['size'];
    $fileToUpload=($_FILES['fileToUpload']);
    $filetmp=$files['tmp_name'];
    $filetype=$_FILES['fileToUpload']['type'];  
    $fileext=(explode('.',$filename));
    $extension=strtolower(end($fileext));
    $extensions=array('png','jpg','jpeg');
    if(!in_array($fileext,$extensions)=== false)
    {
      $errors[]="only jgp, png and jpeg allowed";
      
    }
    if($filsize > 2097152)
    {
      $errors="File size should not be greater then 2MB";
    }
   if(empty($errors)==TRUE)
   {
    $destination='upload/'.$filename;
    move_uploaded_file($filetmp,$destination);
    $image=$destination;
   }
    else{
      print_r($errors);
      die();
    }
 
   
 // }
    $title=mysqli_real_escape_string($conn, $_POST['post_title']);
    $postdesc=mysqli_real_escape_string($conn,$_POST['postdesc']);
    $category=mysqli_real_escape_string($conn,$_POST['category']);
    $date=date('d M,Y');
    session_start();
    $author=$_SESSION['user_id'];
    $sql="INSERT INTO post(title,description,category,post_date,author,post_img) VALUES('{$title}','{$postdesc}',{$category},'{$date}',{$author},'{$filename}');";
    $sql .= "UPDATE category SET post=post+1 WHERE category_id={$category};";
  
    if(mysqli_multi_query($conn,$sql))
    {
      header("location:post.php");
    }
    else{
      echo "<div class='alert alert-danger'>query failed</div>";
    }
  }
?>


