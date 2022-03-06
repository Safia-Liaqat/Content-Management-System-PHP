<?php
 include "header.php";
 include "config.php";
 //if(empty($_FILES['new-image']['name'])){
  //$new_name = $_POST['old_image'];
//}
//else{
if(isset($_POST['submit']))
{
    $errors=array();
    $file_name = $_FILES['new-image']['name'];
    echo "***************";
    echo '<pre>';
    print_r($_FILES['new-image']);
    echo '</pre>';
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $fileToUpload=($_FILES['new-image']);
  //  $file_ext = end(explode('.',$file_name));


  $fileext=(explode('.',$file_name));
  $extension=strtolower(end($fileext));
  $extensions=array('png','jpg','jpeg');
  if(!in_array($fileext,$extensions)=== false)
  {
    $errors[]="only jgp, png and jpeg allowed";
    
  }
  
    if($file_size > 2097152){
      $errors[] = "File size must be 2mb or lower.";
    }
  
    if($file_size > 2097152){
      $errors[] = "File size must be 2mb or lower.";
    }
    $new_name = time(). "-".basename($file_name);
    $target = "upload/".$new_name;
    $image_name = $new_name;
    if(empty($errors) == true){
      move_uploaded_file($file_tmp,$target);
    }else{
      print_r($errors);
      die();
    }
    $postid=$_POST['post_id'];
    $title=$_POST['post_title'];
    $desc=$_POST['postdesc'];
    $category=$_POST['category'];
    $date=date('d M,Y');
    $author=$_SESSION['user_id'];
   $sql1=" UPDATE `post` SET
   `title`='$title',`description`=' $desc',`category`=$category,`post_date`=' $date',`author`={$author},`post_img`='$file_name' WHERE post_id={$postid};";
echo $sql1;
$result1=mysqli_query($conn,$sql1) or die ("query failed");
}



//}

?>

<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
  
        <!-- Form for show edit-->
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
        <?php
           include "config.php";
           $postid=$_GET['id'];
           $sql =" SELECT * FROM post left JOIN category on post.category=category.category_id
            LEFT JOIN user on post.author=user.user_id WHERE post.post_id={$postid} ";
              $result=mysqli_query($conn,$sql) or die("query   failed");
              if(mysqli_num_rows($result)>0) 
              {      
          
          ?>
              <?php
                      while($rows=mysqli_fetch_assoc($result))
                      {
                      
                      ?>
           
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="$<?php echo $rows{'post_id'} ?>" placeholder="">
            </div>
         
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $rows['title']?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                <?php echo $rows['description'];?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
               
                <?php
                              include "config.php";
                $sql1="SELECT * FROM category; ";
                $result1=mysqli_query($conn,$sql1);
                if(mysqli_num_rows($result1)>0)
                {
                    while($row=mysqli_fetch_assoc($result1))
                    {
                        if($row['category']==$row['category_id'])
                        {
                            $selected="selected";
                        }
                        else{
                            $selected="";
                        }
                        ?>
                      <option class="<?php{$selected} ?> " value='<?php echo $row['category_id'];?>'><?php echo $row['category_name'];?></option>";
                      <?php
                    
                }
            }
            ?>
               
                </select>
                <input type="hidden" name="old_category" value="">
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $rows['post_img']; ?>" height="150px">
                <input type="hidden" name="old_image" value="<?php echo $rows['post_img']; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" /> 
        </form>
        <!-- Form End -->
  <?php
                      }
                    }
                      ?>
      </div>
    </div>
  </div>
</div>

 