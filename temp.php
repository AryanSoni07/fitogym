<?php
require("script.php");


//xpjv padt enwi hjch


// $to="aryanrealmadrid7@gmail.com";
// $subject="OTP to login";
// $message="Your one time password is : $otp";
// $headers="From : aryanrealmadrid@gmail.com";
// mail($to,$subject,$message,$headers);
// echo "OTP sent to your email!";
if(!empty($_POST['submit']))
{
    $email=$_POST['email'];
    $subject="OTP Verification";
    $otp=rand(100000, 999999);
    $message = "Your OTP to verify your account is : <br><h1>".$otp."</h1>";
    $response=sendMail($email,$subject,$message);
    echo $response;
}

?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <form action="" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <input type="submit" name="submit" value="Send OTP">
    </form>
    

</body>
</html>