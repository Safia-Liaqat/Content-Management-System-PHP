<?php
include "header.php";
  


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <title>Document</title>
</head>
<body>
<div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
               <?php
               include "config.php";
              
               $limit=3;
             
               if(isset($_GET['page']))
               {
                $page=$_GET['page'];
               }
               else{
                   $page=1;
               }
               
               $offset=($page-1)*$limit;
               $sql="SELECT * FROM user ORDER BY user_id DESC  LIMIT {$offset},{$limit}";
               $result=mysqli_query($conn,$sql);
               if(mysqli_num_rows($result)>0)
               {

               
               ?>

                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                       <?php
                       while($rows=mysqli_fetch_assoc($result))
                       {
                       ?>
                          <tr>
                              <td class='id'><?php echo $rows['user_id'] ;?></td>
                              
                              <td><?php echo $rows['first_name']." ". $rows['last_name'] ;?></td>
                              <td><?php echo $rows['username'] ;?></td>
                              <td>
                                  <?php if( $rows['role']==0)
                              {
                                  echo "Normal";
                              } 
                              else{
                                  echo "Admin ";
                              }
                              ?>
                            
                            
                            </td>
                              <td class='edit'><a href='updateuser.php?id=<?php echo $rows["user_id"];?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='deleteuser.php?id=<?php echo $rows["user_id"];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
               }
               ?>
                      </tbody>
                  </table>
                 <?php
              } 
            
              ?> 
            
               
             <?php
             include "config.php";
             $sql1 = "SELECT * FROM user";
             $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");
             if(mysqli_num_rows($result1)>0)
             {
                 $totalrecords=mysqli_num_rows($result1);
                 $limit=3;
                 $totalpages=ceil($totalrecords/$limit);
                 echo '<ul class="pagination admin-pagination" >';
                 if($page>1)
                 {
                    echo  '<li><a href="users.php?page='.($page -1 ).'">Previous</a></li>';
                 }
                
                 for($i=1;$i<=$totalpages;$i++)
                 { 
                     if($i==$page)
                     {
                         $active="active";
                     }
                     else{
                        $active="";
                     }
                     echo ' <li class="'.$active.'" ><a href="users.php?page='.$i.' ">'.$i.'</a></li>';
                 }
                 if($page<$totalpages)
                 {
                    echo  '<li><a href="users.php?page='.($page + 1).'">Next</a></li>';
                 }
                 echo '</ul>';
             } 
             ?>
               

                
               
                
                  
               <!--     <li class="" .$active.'"><a href=""></a></li> -->
                
                  
                

                  
                
              </div>
          </div>
      </div>
  </div>
    
</body>
</html>
  