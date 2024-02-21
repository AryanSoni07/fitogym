<?php
session_start();
$productadd=null;
include_once ("partials/_dbconnect.php");
if(!isset($_SESSION['cart']))
{
  $_SESSION['cart']=array();
}
function addToCart($pid,$qty)
{
  if(isset($_SESSION['cart'][$pid]))
  {
    $_SESSION['cart'][$pid]=$qty;
  }
  else
  {
    $_SESSION['cart'][$pid]=$qty;
  }
}
if(isset($_POST['qty']))
{

  $pid=$_POST['pid'];
  $qty=$_POST['qty'];
  addToCart($pid,$qty);
  $productadd=true;
}
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
    h2{
      padding-top:2%;
      text-decoration : underline;
    }
  </style>
  </head>
  <body>
    <!-- Page Preloder -->
    <!-- Header Section Begin -->
    <?php include_once ("partials/header.php"); ?>
    <!-- Header End -->
<?php
    if($productadd==true)
    {
        echo "<div class='alert alert-success' role='alert'>
        The product is added to cart Successfully!
      </div>"; 
    }
    ?>
    <div class='product-details'>
    <?php
                        $PID=$_GET['pid'];
                        $sql="SELECT * FROM `product_details_tbl` WHERE `Product_ID`='$PID'";
                        $result=mysqli_query($conn,$sql);
                        $row=mysqli_fetch_assoc($result);

                        $catid=$row['Category_ID'];
                            echo"
                            <div class='row'>
                            <!--make a parent div to enclose two divs inside it -->
                            <div class='col-lg-6'>
                                <img class='title-img' src='".$row['Product_Image']."' alt='product-details' height='380' width='400'>
                            </div>
                            <div class='col-lg-6'>
                              <h2>".$row['Product_Name']."</h2><br>
                              <h3>₹".$row['Product_Price']."</h3><br>
                              <form method='post'>
                              <input type='hidden' name='pid' value='".$row['Product_ID']."'>
                              <label for='qty'>Quantity : </label>
                              <select name='qty'>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                              </select>
                              <br>";
                              if(isset($_SESSION['UID']))
                              {
                                if(isset($_SESSION['cart'][$PID]))
                              {
                                echo "<br><a class='btn btn-warning' href='cart.php'>Go To Cart</a><br><br>";
                              }
                              else{

                                echo"<br><input type='submit' class='btn btn-dark' value='Add To Cart'><br><br>
                                </form>";
                              }
                              }
                              else
                              {
                                echo "<a class='btn btn-dark' href='login.php'>Add To Cart</a>";
                              }
                              echo"
                              <br>
                              <h3>Product Description</h3><br>";
                              $string=$row['Product_Description'];
                              $Lines=explode('.',$string);
                              echo "<ul>";
                              for ($i=0; $i < count($Lines)-1; $i++) {
                                echo "<li>".$Lines[$i]."</li>";
                              }
                            echo "</ul></div>
                          </div>
                            ";
    ?> 
    </div>
    <section id="pricing-products">
      <div>

        <h2>Similar Products</h2>
      
            <div class="row card-deck">
                    <?php
                        
                        $sql="SELECT * FROM `product_details_tbl` WHERE `Category_ID`='$catid'";
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
            </div>
        </section>

    <!-- Footer Section Begin -->
    <?php include_once ("partials/footer.php"); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include_once ("partials/js-links.php"); ?>
    
  </body>
</html>
