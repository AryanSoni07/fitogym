<?php
session_start();
include_once ("partials/_dbconnect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fit-O-Gym | Gallery</title>
    <!-- Google Font -->
    <!-- Css Styles -->
    <?php include_once ("partials/style-links.php"); ?>

    <style>
    .card-deck {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
    }

    .card {
        flex: 1 0 auto;
    }


    /* testimonials section */
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <!-- Header Section Begin -->
    <?php include_once ("partials/header.php"); ?>
    <!-- Header End -->


    <section class="hero-slider">
        <div class="slide-items owl-carousel">
            <?php
                
 
        $sql="SELECT * FROM `feedback_tbl` WHERE View='Show'";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result))
        {
          echo "<div class='single-slide set-bg active' data-setbg='images/bg.jpg'>
          <h1>Gallery</h1>
          <h4>$row[Feedback_Description]</h4>
          </div>";
        }
?>
        </div>
    </section>



    <section id="gallery">
        <!-- <p></p> -->
        <div class="row">

            <div class="gal-col col-lg-4 col-md-6">
                <a target="_blank" href="images/gallery/gympic1.jpeg">
                    <img src="images/gallery/gympic1.jpeg" alt="">
                </a>
            </div>

            <div class="gal-col col-lg-4 col-md-6">
                <a target="_blank" href="images/gallery/gympic2.jpeg">
                    <img src="images/gallery/gympic2.jpeg" alt="">
                </a>
            </div>

            <div class="gal-col col-lg-4 col-md-6">
                <a target="_blank" href="images/gallery/gympic3.jpeg">
                    <img src="images/gallery/gympic3.jpeg" alt="">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="gal-col col-lg-4 col-md-6">
                <a target="_blank" href="images/gallery/gympic4.jpeg">
                    <img src="images/gallery/gympic4.jpeg" alt="">
                </a>
            </div>

            <div class="gal-col col-lg-4 col-md-6">
                <a target="_blank" href="images/gallery/gympic5.jpeg">
                    <img src="images/gallery/gympic5.jpeg" alt="">
                </a>
            </div>
            <div class="gal-col col-lg-4 col-md-6">
                <a target="_blank" href="images/gallery/gympic6.jpeg">
                    <img src="images/gallery/gympic6.jpeg" alt="">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="price-col col-lg-4 col-md-6">
                <a target="_blank" href="images/gallery/gympic7.jpeg">
                    <img src="images/gallery/gympic7.jpeg" alt="">
                </a>
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