<?php include "header.php"; 

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="addpost.php">add post</a>
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
             //  $sql="SELECT * FROM post;";  
        
             if($_SESSION['role']==1)
             {
                $sql =" SELECT * FROM post left JOIN category on post.category=category.category_id LEFT JOIN user on post.author=user.user_id ORDER BY post_id DESC LIMIT {$offset},{$limit};";
           
             }
             elseif($_SESSION['role']==0)
             {
                $sql =" SELECT * FROM post left JOIN category on post.category=category.category_id LEFT JOIN user on post.author=user.user_id
                where post.author={$_SESSION['user_id']}
                 ORDER BY post_id DESC LIMIT {$offset},{$limit};";
           
             }
             $result=mysqli_query($conn,$sql);
               if(mysqli_num_rows($result)>0)
               {

               
               ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                      <?php
                       while($rows=mysqli_fetch_assoc($result))
                       {
                       ?>
                          <tr>
                              <td class='id'><?php echo $rows['post_id']; ?></td>
                              <td><?php echo $rows['title']; ?></td>
                              <td><?php echo $rows['category_name']; ?></td>
                              <td><?php echo $rows['post_date']; ?></td>
                              <td><?php echo $rows['username']; ?></td>
                              <td class='edit'><a href="updatepost.php?id=<?php echo $rows['post_id']; ?>"><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href="deletepost.php?id=<?php echo $rows['post_id']; ?>&catid=<?php echo $rows['category_id']; ?>"> <i class='fa fa-trash-o'></i></a></td>
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
             $sql1 = "SELECT * FROM post ";
             $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");
             if(mysqli_num_rows($result1)>0)
             {
                 $totalrecords=mysqli_num_rows($result1);
                 $limit=3;
                 $totalpages=ceil($totalrecords/$limit);
                 echo '<ul class="pagination admin-pagination" >';
                 if($page>1)
                 {
                    echo  '<li><a href="post.php?page='.($page -1 ).'">Previous</a></li>';
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
                     echo ' <li class="'.$active.'" ><a href="post.php?page='.$i.' ">'.$i.'</a></li>';
                 }
                 if($page<$totalpages)
                 {
                    echo  '<li><a href="post.php?page='.($page + 1).'">Next</a></li>';
                 }
                 echo '</ul>';
             } 
             ?>
              </div>
          </div>
      </div>
  </div>

