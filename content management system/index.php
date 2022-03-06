<?php
  include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                    <?php
               include "config.php";      
             
             
             if(isset($_GET['page']))
             {
              $page=$_GET['page'];
             }
             else{
                 $page=1;
             }
             $limit = 3;
             $offset = ($page - 1) * $limit;

              $sql =" SELECT * FROM post left JOIN category on post.category=category.category_id LEFT JOIN user 
              on post.author=user.user_id 
              ORDER BY post.post_id DESC LIMIT {$offset},{$limit}
              ;";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0)
              {
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
                                              <a href='category.php?cid=<?php echo $rows['category'];  ?>'><?php  echo $rows['category_name']; ?></a>
                                          </span>
                                          <span>
                                              <i class="fa fa-user" aria-hidden="true"></i>
                                              <a href='author.php?autid=<?php  echo $rows['author']; ?>'><?php  echo $rows['username']; ?></a>
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
             $sql1 = "SELECT * FROM post ;";
             $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");
             if(mysqli_num_rows($result1)>0)
             {
                 $totalrecords=mysqli_num_rows($result1);
                 $limit=3;
                 $totalpages=ceil($totalrecords/$limit);
                 echo '<ul class="pagination admin-pagination" >';
                 if($page>1)
                 {
                    echo  '<li><a href="index.php?page='.($page -1 ).'">Previous</a></li>';
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
                     echo ' <li class="'.$active.'" ><a href="index.php?page='.$i.' ">'.$i.'</a></li>';
                 }
                 if($page<$totalpages)
                 {
                    echo  '<li><a href="index.php?page='.($page + 1).'">Next</a></li>';
                 }
                 echo '</ul>';
             } 
             ?>
                    </div><!-- /post-container -->
            
                </div>
                <?php  include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php // include 'footer.php'; ?>
