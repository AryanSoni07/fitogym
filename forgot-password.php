<?php
session_start();
require 'PHPMailer/PHPMailerAutoload.php';
include_once("partials/_dbconnect.php");
$flag=null;
$success=null;
$email_error=null;
$otp_error=null;
$password_error=null;
if(isset($_POST['email']))
{
    $email=$_POST['email'];
    $sql="SELECT * FROM `user_tbl` WHERE `Email`='$email'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $num=mysqli_num_rows($result);
    if($num==1)
    {
        $_SESSION['uid']=$row['UID'];
        $name=$row['Name'];
        $subject="OTP Verification";
        $otp=rand(100000, 999999);
        $_SESSION["Otp"] = $otp;
        $message="The OTP to verify your account is : <br><h1>".$otp."</h1><br> This OTP is valid only for 5 minutes.";
        $message2="The OTP to verify your account is : ".$otp;

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'fitogym7@gmail.com';                 // SMTP username
        $mail->Password = 'irplagzpcqdwlzvn';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('fitogym7@gmail.com', 'Fit-O-Gym');
        $mail->addAddress($email, $name);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = $message2;

        if(!$mail->send()) {
            $flag=0;
            echo "Message could not be sent. ".$mail->ErrorInfo;
        } else {
            $flag=1;
        }
    }
    else{
        $email_error="This Email is not Registered";
    }
}
elseif(isset($_POST['otp']))
{
    $otp=$_POST['otp'];
    if(isset($_SESSION['Otp']))
    {
        if($otp==$_SESSION['Otp'])
        {
            $flag=2;
        }
        else{
            $flag=1;
            $otp_error="Incorrect OTP. Please Retry.";
        }
    }
    else{
        $otp_error="This OTP is Expired";
    }
}
elseif(isset($_POST['password']))
{
    $uid = $_SESSION['uid'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE `user_tbl` SET `Password`='$hash' WHERE `UID`=$uid";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $flag=2;
                $success= "Success";
            }
            else{
                echo 'Error: '.mysqli_error($conn);
            }
        } else {
            $flag=2;
            $password_error="Password and Confirm Password do not match";
        }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Google Font -->
    <!-- Css Styles -->
    <?php include_once ("partials/style-links.php"); ?>
    <style>
        .eye {
            position: absolute;
            left: 322px;
            top: -24px;
        }

        #hide1 {
            display: none;
        }

        #hide2 {
            display: block;
        }

        .error {
            display: block;
            height: 0%;
            left: 1%;
            margin-left: -25%;
            margin-top: -6%;
            color: red;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <!-- Header Section Begin -->
    <?php include_once ("partials/header.php"); ?>
    <!-- Header End -->
        <?php

            if($success)
            {
                echo "<div class='alert alert-success' role='alert'>
                ".$success."!Go to <a href='login.php'>Login Page</a> to login.
                </div>";
            }

        ?>
        <?php
            if($flag==1)
            {
                // <Enter OTP Form 
                echo "<center>
                    <div class='login-container'>
                        <br>
                        <center>
                            <h3>Enter OTP</h3>
                        </center>
                        <div class='form-section'>'
                            <form action='' method='POST'>
                                <div class='login-box'>
                                    <div class='box'>
                                        <i class='fa fa-key'></i>
                                        <input type='text' class='ele' placeholder='Enter Your OTP' name='otp' id='otp' required>
                                    </div>
                                    <div>
                                    </div>
                                    <div class='error'>
                                    <i class='fa fa-circle-exclamation'></i>
                                    $otp_error
                                    </div>
                                    
                                    <div class='button-container'>
                                        <button class='btn btn-lg btn-dark loginbtn' type='submit' name='submit'>Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <center>";
            }
            elseif($flag==2)
            {

                //Enter New Password password form
                echo "<center>
                    <div class='login-container'>
                        <br>
                        <center>
                            <h3>Enter New Password</h3>
                        </center>
                        <div class='form-section'>
                            <form action='' method='POST'>
                                <div class='login-box'>
                                    <div class='box'>
                                        <i class='fa fa-lock'></i>
                                        <input type='password' class='ele' placeholder='Enter New Password' name='password'
                                            id='password' required>
                                    </div>
                                    <div class='box'>
                                        <i class='fa fa-lock'></i>
                                        <input type='password' class='ele' placeholder='Enter Confirm Password'
                                            name='cpassword' id='cpassword' required>
                                    </div>
                                    <div class='error'>
                                    <i class='fa fa-circle-exclamation'></i>
                                    $password_error
                                    </div>
                                    <div class='button-container'>
                                        <button class='btn btn-lg btn-dark loginbtn' type='submit' name='submit'>Change
                                            Password</button>
                                    </div>
                                </div>
                            </form>
                        </div'
                    </div>

                </center>";
            }
            else
            {
                //enter email form 
                echo "<center>
                    <div class='login-container'>
                        <br>
                        <center>
                            <h3>Enter Your Email</h3>
                        </center>
                        <div class='form-section'>


                            <form action='' method='POST'>
                                <div class='login-box'>
                                    <div class='box'>
                                        <i class='fa fa-envelope'></i>
                                        <input type='email' class='ele' placeholder='youremail@email.com' name='email'
                                            id='email' required>
                                    </div>
                                    <div class='error'>
                                    <i class='fa fa-circle-exclamation'></i>
                                    $email_error
                                    </div>
                                    <div class='button-container'>
                                            <button class='btn btn-lg btn-dark loginbtn' type='submit' name='submit'>Send
                                                OTP</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </center>";
            }
                
        ?>
                <!-- Footer Section Begin -->
                <?php include_once ("partials/footer.php"); ?>
                <!-- Footer Section End -->

                <!-- Js Plugins -->
                <?php include_once ("partials/js-links.php"); ?>
            
        
</body>

</html>