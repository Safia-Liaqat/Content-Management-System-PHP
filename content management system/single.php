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
             $postid=$_GET['id'];
              $sql =" SELECT * FROM post left JOIN category on post.category=category.category_id 
              LEFT JOIN user on post.author=user.user_id
              WHERE post.post_id={$postid}
               ;";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0)
              {
                while($rows=mysqli_fetch_assoc($result))
                {
             ?>
                        <div class="post-content single-post">
                            <h3><?php echo $rows['title']; ?></h3>
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
                            <img class="single-feature-image" src="admin/upload/<?php  echo $rows['post_img']; ?>" alt=""/>
                            <p class="description">
                                <?php echo $rows['description']; ?>
                            </p>
                        </div>
                      
                    </div>
                    <!-- /post-container -->
                </div>
                <?php
                }
            }
                ?>
                <?php  include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php // include 'footer.php'; ?>
