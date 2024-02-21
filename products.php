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

    <style>
    .card-deck {
      display: flex;
      flex-wrap: wrap;
      align-items: stretch;
    }

    .card {
      flex: 1 0 auto;
    }
    </style>
  </head>
  <body>
  <!-- Page Preloder -->
    <!-- Header Section Begin -->
    <?php include_once ("partials/header.php"); ?>
    <!-- Header End -->
  <!-- Search Bar Begin -->
  
  <div class="topnav">

  <div class="search-container">
    <form action="products.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>
<section class="breadcrumb-area set-bg" data-setbg="images/contact/contact-bg.jpg">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-content">
                    <h2>Fit-O-Products</h2>
                    <h4>Finds all kinds of gym and health essentials right here!</h4>
                    </div>
                </div>
            </div>
</section>
    <!-- Search Bar End -->
        <section id="pricing-products">
            
            <div class="row card-deck">
                    <?php
                        $sql="SELECT * FROM `product_details_tbl`";
                        if(isset($_GET['search']))
                        {
                          $search=$_GET['search'];
                          if($search=="")
                          {
                            $sql="SELECT * FROM `product_details_tbl`";
                          }
                          else{
                            $sql="SELECT * FROM `product_details_tbl` WHERE MATCH(`Product_Name`, `Product_Description`) against ('$search')";
                          }
                        }
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_assoc($result))
                        {
                          $cid=$row['Category_ID'];  
                          $sql2="SELECT * FROM `category_tbl` WHERE Category_ID='$cid'";
                          $result2=mysqli_query($conn,$sql2);
                          $row2=mysqli_fetch_assoc($result2);
                          // echo $row2['Category_Name'];
                            echo "<div class='price-col col-lg-4 col-md-6'>
                            <div class='card h-100'>
                            <div class='card'>
                            <a href='product-details.php?pid=".$row['Product_ID']."'>
                            <div class='card-body'>
                            <img src='".$row['Product_Image']."' alt=".$row['Product_Name']."width='180px' height='200px'>
                                <br>
                                <strong>Fit-Products</strong>
                                <br>
                                <div>".$row['Product_Name']."</div>
                                <strong><div>₹".$row['Product_Price']."</div></strong>
                            </div>
                            </a>
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
