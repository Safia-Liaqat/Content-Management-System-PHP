<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
              <!-- post-container -->
              <div class="post-container">
                <?php
               include "config.php"; 
               $autid;     
               if(isset($_GET['autid']))
               {
                   $autid=$_GET['autid'];
               }    
             $autid=$_GET['autid'];
            
             if(isset($_GET['page']))
             {
              $page=$_GET['page'];
             }
             else{
                 $page=1;
             }

              $sql =" SELECT * FROM post left JOIN category on post.category=category.category_id LEFT JOIN user on post.author=user.user_id WHERE post.author={$autid} ";
              $result=mysqli_query($conn,$sql);
            //    $row1=mysqli_fetch_assoc($result);
              if(mysqli_num_rows($result)>0)
              {
             ?>
            <!--     <h2><?php
            // echo $row1['category_name'];  ?></h2>
         <hr style="height:4px;background:black;"> -->
                <?php
                while($rows=mysqli_fetch_assoc($result))
                {
                
             ?>
                  
                        <div class="post-content">
                   <div class="row">
                                <div class="col-md-4">
                              
                                  <a class="post-img" href="single.php?id=<?php echo $rows['post_id'];  ?>"><img src="admin/upload/<?php  echo $rows['post_img']; ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                  <div class="inner-content clearfix">
                                      <h3><a href='single.php?id=<?php echo $rows['post_id'];  ?>'</a><?php echo $rows['title']; ?></h3>
                                      <div class="post-information">
                                          <span>
                                              <i class="fa fa-tags" aria-hidden="true"></i>
                                              <a href=''><?php  echo $rows['category_name']; ?></a>
                                          </span>
                                          <span>
                                              <i class="fa fa-user" aria-hidden="true"></i>
                                              <a href=''><?php  echo $rows['username']; ?></a>
                                          </span>
                                          <span>
                                              <i class="fa fa-calendar" aria-hidden="true"></i>
                                              <?php  echo $rows['post_date']; ?>
                                          </span>
                                      </div>
                                      <p class="description">
                                       <?php echo substr( $rows['description'],0,30)."....."; ?>
                                      </p>
                                      <a class='read-more pull-right' href='single.php?id=<?php echo $rows['post_id'];  ?>'>read more</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <?php
                }
            }
            ?>
             <?php
             include "config.php";
             $autid=$_GET['autid'];
             $sql1 = "SELECT  * FROM user WHERE user_id={$autid}; ";
             $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");
             $row=mysqli_fetch_assoc($result);
             if(mysqli_num_rows($result1)>0)
             {
                 $totalrecords=$row['post'];
                 $limit=3;
                 $totalpages=ceil($totalrecords/$limit);
                 echo '<ul class="pagination admin-pagination" >';
                 if($page>1)
                 {
                    echo  '<li><a href="index.php?autid='.$autid.'&page='.($page -1 ).'">Previous</a></li>';
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
                     echo ' <li class="'.$active.'" ><a href="index.php?autid='.$autid.'&page='.$i.' ">'.$i.'</a></li>';
                 }
                 if($page<$totalpages)
                 {
                    echo  '<li><a href="index.php?autid='.$autid.'&page='.($page + 1).'">Next</a></li>';
                 }
                 echo '</ul>';
             } 
             ?>
             <?php
             include "config.php";
             $autid=$_GET['autid'];
             $sql1 = "SELECT  * FROM user WHERE user_id={$autid}; ";
             $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");
             $row=mysqli_fetch_assoc($result);

             if(mysqli_num_rows($result1)>0)
             {
                 $totalrecords=$row['post'];
                 $limit=3;
                 $totalpages=ceil($totalrecords/$limit);
                 echo '<ul class="pagination admin-pagination" >';
                 if($page>1)
                 {
                    echo  '<li><a href="index.php?autid='.$autid.'&page='.($page -1 ).'">Previous</a></li>';
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
                     echo ' <li class="'.$active.'" ><a href="index.php?autid='.$autid.'&page='.$i.' ">'.$i.'</a></li>';
                 }
                 if($page<$totalpages)
                 {
                    echo  '<li><a href="index.php?autid='.$autid.'&page='.($page + 1).'">Next</a></li>';
                 }
                 echo '</ul>';
             } 
             ?>
                </div>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php // include 'footer.php'; ?>
