<?php 

include('partials/_dbconnect.php');
session_start();
date_default_timezone_set("Asia/Calcutta");
$planid=$_POST['plan_id'];
$paymentid=$_POST['payment_id'];
$amount=$_POST['pay_amount'];
$ordertype=$_POST['type'];
$uid=$_SESSION['UID'];
// order table

$sql="INSERT INTO `order_tbl`(`UID`, `Order_Type`, `Order_Date`, `Order_Time`, `Order_Price`) VALUES ($uid,'$ordertype',current_timestamp(),current_timestamp(),$amount)";
$result=mysqli_query($conn,$sql);

// membership order table
$ordersql="SELECT * FROM order_tbl ORDER BY Order_ID DESC";
$result=mysqli_query($conn,$ordersql);
$row=mysqli_fetch_assoc($result);

$validity=$_POST['plan_validity'];
$oid=$row['Order_ID'];
$today=new DateTime();
$today->add(new DateInterval('P'.$validity.'M'));
$date=$today->format('Y-m-d');

$sql2="INSERT INTO `membership_order_tbl`(`Membership_Plan_ID`, `Order_ID`, `Expiry_Date`) VALUES ('$planid','$oid','$date')";
$result2=mysqli_query($conn,$sql2);

$mpoidsql="SELECT `Membership_Plan_Order_ID` FROM `membership_order_tbl` ORDER BY `Membership_Plan_Order_ID` DESC LIMIT 1";
$resultmpoid=mysqli_query($conn,$mpoidsql);
$row=mysqli_fetch_assoc($resultmpoid);
$mpoid=$row['Membership_Plan_Order_ID'];
//member table
$membersql="INSERT INTO `member_tbl`(`UID`, `Membership_Plan_Order_ID`) VALUES ($uid,$mpoid)";
$memberresqult=mysqli_query($conn,$membersql);

// payment table 


$sql3="INSERT INTO `payment_details_tbl`(`Transaction_ID`, `Order_ID`, `Type`, `Amount`, `Payment_Date`, `Payment_Time`) VALUES ('$paymentid',$oid,'$ordertype','$amount',current_timestamp(),current_timestamp())";
$result3=mysqli_query($conn,$sql3);

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
