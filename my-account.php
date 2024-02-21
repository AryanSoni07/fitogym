<?php

session_start();

include_once ("partials/_dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FIT-O-GYM</title>
    <!-- Google Font -->
    <!-- Css Styles -->
    <?php include_once ("partials/style-links.php"); ?>
    <style>
    * {
        box-sizing: border-box;
    }

    /* Float four columns side by side */
    .column {
        float: left;
        width: 100%;
        padding: 10px 80px;
    }

    /* Remove extra left and right margins, due to padding */
    .row {
        margin: 0 -5px;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive columns */
    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }
    }

    /* Style the counter cards */
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        padding-top: 16px;
        padding-bottom: 16px;
        padding-left: 30px;
        padding-right: 30px;
        text-align: left;
        background-color: #ffffff;
    }

    .card-container {
        display: grid;
        align-items: center;
        grid-template-columns: 1fr 1fr 1fr;
        column-gap: 5px;
    }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <!-- Header Section Begin -->
    <?php include_once ("partials/header.php"); ?>
    <!-- Header End -->
    <?php include_once ("partials/acc-header.php"); ?>

    <?php
    $uid=$_SESSION['UID'];
    $sql="SELECT * FROM `order_tbl` WHERE `UID`=$uid AND Order_Type='Product' ORDER BY `Order_ID` DESC";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num>0)
    {?>
    <section class="my-orders">
        <center>

            <h3>Repeat Purchases</h3>
            <center>


                <div class="row">
                    <?php
            $uid=$_SESSION['UID'];
            $sql="SELECT * FROM `order_tbl` WHERE `UID`=$uid AND Order_Type='Product'";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($result))
            {
              $oid=$row['Order_ID'];
              $sql2="SELECT * FROM `product_order_tbl` WHERE `Order_ID`=$oid";
              $result2=mysqli_query($conn,$sql2);
              while($row2=mysqli_fetch_assoc($result2))
              {
                $poid=$row2['Product_Order_ID'];
                $sql3="SELECT * FROM `order_details_tbl` WHERE `Product_Order_ID`=$poid";
                $result3=mysqli_query($conn,$sql3);
                while($row3=mysqli_fetch_assoc($result3))
                {
                  $productid=$row3['Product_ID'];
                  $sql4="SELECT * FROM `product_details_tbl` WHERE `Product_ID`='$productid'";
                  $result4=mysqli_query($conn,$sql4);
                  $row4=mysqli_fetch_assoc($result4);
                  $catid=$row4['Category_ID'];
                  $sql5="SELECT * FROM `category_tbl` WHERE `Category_ID`='$catid'";
                  $result5=mysqli_query($conn,$sql5);
                  $row5=mysqli_fetch_assoc($result5);
                  echo "
                      <a href='product-details.php?pid=$productid'>
                        <div class='column'>
                          <div class='card'>
              
                            <div class='card-container'>
                                <div class='image'>
                                  <img src='".$row4['Product_Image']."' height='100px' width='100px'>
                                </div>
                                <div class='text'>
                                  <h5>".$row4['Product_Name']."</h5>
                                  <p>Category: ".$row5['Category_Name']."</p>
                                 
                                </div>
                              </div>
                            </div>
                        </div>
                      </a>";
                }
              }
            }
          ?>
                </div>

    </section>
    <?php
    }
    else{
      echo "
      <section class='my-orders'>
        <center>
              <h3>Suggested Products</h3>
        </center> 
            <div class='row'>";
                $sql="SELECT * FROM `product_details_tbl`";
                $result=mysqli_query($conn,$sql);
                for ($i=0; $i <= 2; $i++) { 
                  $row=mysqli_fetch_assoc($result);
                echo "
                <a href='product-details.php?pid=".$row['Product_ID']."'>
                <div class='column'>
                  <div class='card'>
                    <div class='card-container'>
                      <div class='image'>
                        <img src='".$row['Product_Image']."' height='150px' width='150px'>
                      </div>
                      <div class='text'>
                        <h5>".$row['Product_Name']."</h5>
                        <p>Price: ₹".$row['Product_Price']."</p>
                      </div>
                    </div>
                  </div>
                </div>
                </a>";
                }    
            echo"
            </div>
      </section>";
    
  }?>

    <!-- Footer Section Begin -->
    <?php include_once ("partials/footer.php"); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include_once ("partials/js-links.php"); ?>

</body>

</html>