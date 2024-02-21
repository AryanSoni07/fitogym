<?php
session_start();
include_once ("partials/_dbconnect.php");
$tamt=0;
$uid=$_SESSION['UID'];
$sql="SELECT * FROM `user_tbl` WHERE `UID`=$uid";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$area=$row['Area_Street'];
$region=$row['Region'];
$city=$row['City'];
$state=$row['State'];
$pincode=$row['Pincode'];
$phone=$row['Phone'];

if(isset($_POST['state']))
{
    $area=$_POST['area'];
    $region=$_POST['region'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $pincode=$_POST['pincode'];
    $phone=$_POST['phone'];
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
if(isset($_GET['pid']))
{

  $pid=$_GET['pid'];
  $qty=1;
  addToCart($pid,$qty);
}
function removeFromCart($pid)
{
    if(isset($_SESSION['cart'][$pid]))
    {
        unset($_SESSION['cart'][$pid]);
    }
}
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['remove']))
{
    $pid=$_POST['pid'];
    removeFromCart($pid);
}
// echo count($_SESSION['cart']);
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
    .contain {
            padding-left: 53%;
        }

        span {
            margin-left: 25%;
        }

        /* button{
        margin-left: 40%;
    } */
    .table{
        width : 90%;
    }
    .table td{
        font-size:20px;
    }
    input{
        width : 90%;
        border : 0.5px solid black;
        border-radius : 4px;
    }
        th,
        td {
            text-align: center;
        }

        th{
            background: rgb(143,195,34);
	        background: linear-gradient(81deg, rgba(143,195,34,1) 0%, rgba(45,217,253,0.8801645658263305) 100%);
        }

        .cart-form td{
            text-align: left;
            vertical-align: top;
            padding:5px;
            height: 20px;
        }

        h5{
            padding: 10px;
            background: rgb(143,195,34);
	        background: linear-gradient(81deg, rgba(143,195,34,1) 0%, rgba(45,217,253,0.8801645658263305) 100%);
        }

        .product-details{
            padding-top: 5px;
        }

  </style>
</head>

<body>
    <!-- Page Preloder -->
    <!-- Header Section Begin -->
    <?php include_once ("partials/header.php"); ?>
    <!-- Header End -->

    <div class='product-details'>
        
    
    <?php
                    if(!empty($_SESSION['cart']))
                    {
                        echo"
                        <h5>Deliver my order at:</h5>
    <br>
    <form action='cart.php' method='post'>

    <table class='cart-form table'>
        <tr>
        <td>House No. / Street</td>
        <td><input type='text' name='area' id='name' value='$area' placeholder='Enter House No./ Street' maxlength='100' required></td>
        </tr>
        <tr>
        <td>Landmark</td>
        <td><input type='text' name='region' id='name' value='$region' placeholder='Enter Landmark (Region)' required></td>
        </tr>
        <tr>
        <td>City</td>
        <td><input type='text' name='city' id='name' value='$city'  placeholder='Enter City' required></td>
        </tr>
        <tr>
        <td>State</td>
        <td>";
        ?>
        <select name="state">
        <option selected value="<?php echo $state; ?>"><?php echo $state; ?></option>
        <?php
        $sql="SELECT * FROM `state`";
        $result=mysqli_query($conn,$sql);
        while($row5=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$row5['State']."'>".$row5['State']."</option>";
        }
        ?>
        <?php
    echo "</select></td>
        </tr>
        <br><br><br>
        <tr>
        <td>Pincode</td>
        <td><input type='text' name='pincode' id='name' value='$pincode' maxlength='6' minlength='6' placeholder='Enter Pincode' required></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><input type='text' name='phone' id='name' value='$phone' placeholder='Enter Your Phone' maxlength='10' minlength='10' required></td>
        </tr>
        <tr>
            <td><button type='submit' class='btn btn-lg btn-block btn-dark'>Save Address</a></td>
        </tr>
    </table>
    </form><br><br><br>";
                echo "<table>
            <tr style='background-color: grey;'>
                <th style='width: 8%;'>Product Image</th>
                <th style='width: 40%;'>Name</th>
                <th>Price(in ₹)</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>";
            
                foreach($_SESSION['cart'] as $pid => $qty)
                {
                    $sql="SELECT * FROM `product_details_tbl` WHERE `Product_ID`='$pid'";
                    $result=mysqli_query($conn,$sql);
                    $row=mysqli_fetch_assoc($result);
                    echo "<tr>
                    <td><img src='".$row['Product_Image']."' alt='".$row['Product_Name']."'></td>
                    <td>".$row['Product_Name']."<br>₹".$row['Product_Price']."<br><form method='post'>
                    <input type='hidden' name='pid' value='".$row['Product_ID']."'>
                    <input type='submit' name='remove' value='Remove'>
                    </form></td>
                        <td>".$row['Product_Price']."</td>
                        <td>$qty</td>";
                        $amt=$qty*$row['Product_Price'];
                        echo "<td>$amt</td>";
                        $tamt=$tamt + $amt;
                    echo "</tr>";
                }
            
        echo "</table>
        <hr style='width: 40%; margin-left: 55%;'>
        <div class='contain'>

            <span><b> Grand Total : ₹$tamt</b></span><br>
            <span><a href='javascript:void(0)' data-amount='$tamt' data-area='$area'  data-region='$region' data-city='$city' data-state='$state' data-pin='$pincode' data-phone='$phone' class='btn btn-sm  btn-dark buynow'>Place Your Order</a></span><br><br>
            
        </div>";
      }
      else{
        
        echo "<br><br><center><img src='images/cart.png' height='200px'><h2 style='color:grey;'>Your Cart Empty! <a href='products.php' class='btn btn-lg btn-warning '>Shop Now</a></h2><center>";
      }
          
      ?>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>

        $(".buynow").click(function () {

            var amount = $(this).attr('data-amount');
            var ordertype = "Product";
            var area = $(this).attr('data-area');
            var region = $(this).attr('data-region');
            var city = $(this).attr('data-city');
            var state = $(this).attr('data-state');
            var pincode = $(this).attr('data-pin');
            var phone = $(this).attr('data-phone');
            var options = {
                "key": "rzp_test_V6AeC40NyZIjJ4", // Enter the Key ID generated from the Dashboard
                "amount": amount * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "name": "Fit-O-Gym",
                "description": "Products",
                "image": "https://example.com/your_logo",
                "handler": function (response) {
                    var paymentid = response.razorpay_payment_id;

                    $.ajax({
                        url: "product-payment.php",
                        type: "POST",
                        data: { payment_id: paymentid, pay_amount: amount, type: ordertype, area: area, region: region, city: city, state: state, pincode: pincode, phone: phone },
                        success: function (finalresponse) {
                            if (finalresponse == 'done') {
                                window.location.href = "http://localhost/fitogym/client-order.php?success";
                            }
                            else {
                                alert('Please check console.log to find error');
                                console.log(finalresponse);
                            }
                        }
                    })

                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });
    </script>

    <!-- Footer Section Begin -->
    <?php include_once ("partials/footer.php"); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include_once ("partials/js-links.php"); ?>

</body>

</html>