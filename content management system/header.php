
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO 
            <img src="newssite.png"> -->
            <div class=" col-md-offset-4 col-md-4">
          
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <?php
        include "config.php";
        if(isset($_GET['cid']))
        {
            $catid=$_GET['cid'];
        }
        $sql="SELECT * from category Where post > 0;";
        $result=mysqli_query($conn,$sql) or die("query failed");
        $active="";
         if(mysqli_num_rows($result)>0)
         {
        ?>
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    <li><a href="index.php">Home</a><li>
                <?php
            while($rows=mysqli_fetch_assoc($result))
            {
                if(isset($_GET['cid']))
                {
                    if($rows['category_id']==$catid)
                    {
                        $active="active";
                    }
                    else{
                        $active="";
                    }
                }
              
            ?>
                  <li><a class="<?php '{$active}'; ?>" href='category.php?cid=<?php echo $rows['category_id']; ?>'><?php echo $rows['category_name']; ?>  </a></li>
                 
                  <?php
         }
        }
  
        ?>
                </ul>
            </div>
        </div>
     
    </div>
   
</div>
<!-- /Menu Bar -->
