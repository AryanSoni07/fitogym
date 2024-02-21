<?php 

include('partials/_dbconnect.php');
session_start();
date_default_timezone_set("Asia/Calcutta");
$paymentid=$_POST['payment_id'];
$amount=$_POST['pay_amount'];
$ordertype=$_POST['type'];

$area=$_POST['area'];
$region=$_POST['region'];
$city=$_POST['city'];
$state=$_POST['state'];
$pincode=$_POST['pincode'];

$phone=$_POST['phone'];
// order table
$uid=$_SESSION['UID'];
$sql="INSERT INTO `order_tbl`(`UID`, `Order_Type`, `Order_Date`, `Order_Time`, `Order_Price`) VALUES ($uid,'$ordertype',current_timestamp(),current_timestamp(),$amount)";
$result=mysqli_query($conn,$sql);

// product order table
$ordersql="SELECT * FROM order_tbl ORDER BY Order_ID DESC";
$result=mysqli_query($conn,$ordersql);
$row=mysqli_fetch_assoc($result);

$oid=$row['Order_ID'];

$sql2="INSERT INTO `product_order_tbl`(`Order_ID`, `Area_Street`, `Region`, `City`, `State`, `Pincode`, `Phone`) VALUES ($oid,'$area','$region','$city', '$state', '$pincode','$phone')";
$result2=mysqli_query($conn,$sql2); 

//order details table
$ordersql="SELECT * FROM product_order_tbl ORDER BY Product_Order_ID DESC";
$result=mysqli_query($conn,$ordersql);
$row=mysqli_fetch_assoc($result);
$poid=$row['Product_Order_ID'];
foreach($_SESSION['cart'] as $pid => $quantity)
{
    $qty=$quantity;
    $sqlp="SELECT * FROM `product_details_tbl` WHERE Product_ID='$pid'";
    $resultp=mysqli_query($conn,$sqlp);
    $rows=mysqli_fetch_assoc($resultp);
    $price=$rows['Product_Price'];
    $tamt=$qty*$price;
    
    $sql4="INSERT INTO `order_details_tbl`(`Product_Order_ID`, `Product_ID`, `Quantity`, `Price`, `Total_Amount`) VALUES ($poid,'$pid',$qty,$price,$tamt)";
    $result4=mysqli_query($conn,$sql4);
}


// payment table 


$sql3="INSERT INTO `payment_details_tbl`(`Transaction_ID`, `Order_ID`, `Type`, `Amount`, `Payment_Date`, `Payment_Time`) VALUES ('$paymentid',$oid,'$ordertype','$amount',current_timestamp(),current_timestamp())";
$result3=mysqli_query($conn,$sql3);
unset($_SESSION['cart']);
if($result3)
{
	echo 'done';
	$_SESSION['paymentid']=$paymentid;
}
else 
{
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>
