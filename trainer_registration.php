<?php
session_start();
if(isset($_SESSION['UID']))
{
  // echo $_SESSION['UID'];
  // echo $_SESSION['Type'];
}
else{
  header("refresh:1; url=/fitogym/login.php");
}
include_once ("partials/_dbconnect.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $address=$_POST['address'];

    $existUser="SELECT * FROM `user_tbl` WHERE `user_tbl`.`Email`='$email'";
    $result=mysqli_query($conn,$existUser);
    $numExist=mysqli_num_rows($result);
    
    if($numExist > 0)
    {
        echo "This email is already registered";
    }
    else{
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO `user_tbl` (`User_Type`, `Name`, `Gender`, `DOB`, `Email`, `Password`, `Phone`, `Address`, `Status`) VALUES ('Client', '$name', '$gender', '$dob', '$email', '$hash', '$phone', '$address', 'Active')";
        
        $result=mysqli_query($conn,$sql);
        if($result)
        {
            echo "User Registered Successfully";
        }
        else{
            echo "Error in registering user";
        }
    }
}   
?>