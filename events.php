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

    <section class="breadcrumb-area set-bg" data-setbg="images/contact/contact-bg.jpg">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-content">
                    <h2>Events</h2>
                    <h4>Enjoy city's best fitness events only with us</h4>
                    </div>
                </div>
            </div>
    </section>
    <marquee><h5><i>EVENTS ARE OPEN TO ALL FOR FREE</i></h5></marquee>
        <section id="pricing-plans">
    
              <div class="row card-deck">
                    <?php
                        $sql="SELECT * FROM `event_tbl` WHERE View='Show' AND Event_Date>CURRENT_DATE()";
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo "<div class='price-col col-lg-4 col-md-6'>
                            <div class='card h-100'>
                            <div class='card'>
                            <div class='card-header'>
                            <h3>".$row['Event_Name']."</h3>
                            </div>
                            <div class='card-body'>
                              <h5 class='planh'>".$row['Event_Date']."</h5>
                              
                              <p>".$row['Event_Description']."</p>
                              <h6>Venue: ".$row['Venue']."</h6>
                            </div>
                            </div>
                            </div>
                            </div>";
                        }
                    ?> 
            </div>
          
            </div>
        
        </section>

      <!-- Footer Section Begin -->
      <?php include_once ("partials/footer.php"); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include_once ("partials/js-links.php"); ?>
    
  </body>
</html>
