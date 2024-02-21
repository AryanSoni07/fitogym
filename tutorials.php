<?php
session_start();
include_once ("partials/_dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fit-O-Gym</title>
    <!-- Google Font -->
    <!-- Css Styles -->
    <?php include_once ("partials/style-links.php"); ?>

  </head>
  <body>
    <!-- Page Preloder -->
    <!-- Header Section Begin -->
    <?php include_once ("partials/header.php"); ?>
    <!-- Header End -->

      <!-- Search Bar Begin -->
  
  <div class="topnav">

<div class="search-container">
  <form action="tutorials.php">
    <input type="text" placeholder="Search.." name="search">
    <button type="submit"><i class="fa fa-search"></i></button>
  </form>
</div>
</div>
  <!-- Search Bar End -->
  
  <section class="breadcrumb-area set-bg" data-setbg="images/contact/contact-bg.jpg">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-content">
                    <h2>Health & Fitness Tutorials</h2>
                    <h4>FREE</h4>
                    <h4>Learn gym and fitness tips and techniques from our expert trainers from the ease of your homes.</h4>
                    </div>
                </div>
            </div>
    </section>
        <section id="tutorial">
              <div class="row card-deck">
                    <?php
                        
                        $sql="SELECT * FROM `tutorial_details_tbl`";
                        if(isset($_GET['search']))
                        {
                          $search=$_GET['search'];
                          if($search=="")
                          {
                            $sql="SELECT * FROM `tutorial_details_tbl`";
                          }
                          else{
                            $sql="SELECT * FROM `tutorial_details_tbl` WHERE MATCH(`Tutorial_Name`, `Description`) against ('$search')";
                          }
                        }
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_assoc($result))
                        {
                          $uid=$row['Trainer_ID'];
                          $sql2="SELECT * FROM `trainer_tbl` WHERE Trainer_ID=$uid";
                          $result2=mysqli_query($conn,$sql2);
                          $row2=mysqli_fetch_assoc($result2);
                          $uid=$row2['UID'];
                          $sql2="SELECT * FROM `user_tbl` WHERE UID=$uid";
                          $result2=mysqli_query($conn,$sql2);
                          $row2=mysqli_fetch_assoc($result2);

                            echo "<div class='price-col col-lg-4 col-md-6'>
                            <div class='card h-100'>
                            <div class='card'>
                            <a href='".$row['Tutorial_Link']."' target='_blank'>
                            <div class='card-header'>
                            <h4>".$row['Tutorial_Name']."</h4>
                            </div>
                            <div class='card-body'>
                            <img src='".$row['Tutorial_Image']."' height='150px' width='200px'>
                              <h5 class='planh'>-by ".$row2['Name']."</h5>
                              <p>".$row['Description']."</p>
                            </a>
                            </div>
                            </div>
                            </div>
                            </div>";
                        }
                    ?> 
            </div>
        </section>

      <!-- Footer Section Begin -->
      <?php include_once ("partials/footer.php"); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include_once ("partials/js-links.php"); ?>
    
  </body>
</html>
