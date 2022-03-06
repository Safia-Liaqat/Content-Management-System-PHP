<?php

if(isset($_POST['submit']))
{
    include "config.php";
    $userid=$_GET['id'];
   // $stid=mysqli_real_escape_string($conn, $_POST['user_id']);
    $fname=mysqli_real_escape_string($conn, $_POST['f_name']);
    $lname=mysqli_real_escape_string($conn,$_POST['l_name']);
    $user=mysqli_real_escape_string($conn,$_POST['username']);
    $role=mysqli_real_escape_string($conn,$_POST['role']);
    $sql="UPDATE user SET `first_name`='{$fname}',`last_name`='{$lname}',`username`='{$user}',`role`='{$role } ' WHERE `user_id`='{$userid}'";
  //  $sql = "UPDATE user SET first_name = '{$fname}', last_name = '{$lname}', username = '{$user}', role = '{$role}' WHERE user_id = {$userid}";
    $result=mysqli_query($conn,$sql) or die ("query unsucessfull");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UpdateUser</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
</head>
<body>
<div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
           <?php
           include "config.php";
         //  if(isset($_GET()))
           $userid=$_GET['id'];
           $sql="SELECT * From user WHERE user_id='{$userid}'";
           $result=mysqli_query($conn,$sql);
           if(mysqli_num_rows($result)>0)
           {

           
           ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id" class="form-control" value="">
                      </div>
                      <?php
                      while($rows=mysqli_fetch_assoc($result))
                      {
                      
                      ?>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $rows['first_name'];?>" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $rows['last_name'];?>" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $rows['username'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $rows['role'];?>">
                          <?php
                              if($rows['role'] == 1){
                                echo "<option value='0'>normal User</option>
                                      <option value='1' selected>Admin</option>";
                              }else{
                                echo "<option value='0' selected>normal User</option>
                                      <option value='1'>Admin</option>";
                              }
                            ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                      }
                    }
                  ?>
                  <!-- /Form -->
               
              </div>
          </div>
      </div>
  </div>
</body>
</html>
