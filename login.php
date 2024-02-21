<?php
session_start();
include_once ("partials/_dbconnect.php");
$email_error=null;
$password_error=null;
if(isset($_POST['user']))
{
    $user_type=$_POST['user'];
    if($user_type=='A')
    {
        $email=$_POST['email'];
        $pass=$_POST['password'];
        $sql="SELECT * FROM `user_tbl` WHERE `user_tbl`.`Email`='$email'";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);
        if($num==1)
        {
            while ($row=mysqli_fetch_assoc($result)) {
                if(password_verify($pass,$row['Password']))
                {
                    if($row['User_Type']=='Admin')
                    {
                        $_SESSION['UID']=$row['UID'];
                        $_SESSION['Name']=$row['Name'];
                        $_SESSION['Type']=$row['User_Type'];
                        header("refresh:2; url=admin/index.php");
                    }
                    else{
                        $password_error="Incorrect Password";   
                    }
                }
                else{
                    $password_error="Incorrect Password";
                }
            }
        }
        else{
            $email_error="This email is not registered";
        }
    }
    elseif($user_type=='T')
    {
        $email=$_POST['email'];
        $pass=$_POST['password'];
        $sql="SELECT * FROM `user_tbl` WHERE `user_tbl`.`Email`='$email'";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);
        if($num==1)
        {
            while ($row=mysqli_fetch_assoc($result)) {
                if(password_verify($pass,$row['Password']))
                {
                    if($row['User_Type']=='Trainer')
                    {
                        $_SESSION['UID']=$row['UID'];
                        $_SESSION['Type']=$row['User_Type'];
                        header("refresh:1; url=trainer/index.php");
                    }
                    else{
                        $password_error="Incorrect Password";
                    }
                }
                else{
                    $password_error="Incorrect Password";
                }
            }
        }
        else{
            $email_error="This email is not registered";
        }
    }
    elseif($user_type=='C')
    {
        $email=$_POST['email'];
        $pass=$_POST['password'];
        $sql="SELECT * FROM `user_tbl` WHERE `user_tbl`.`Email`='$email'";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);
        if($num==1)
        {
            while ($row=mysqli_fetch_assoc($result) and $row['User_Type']=='Client') {
                if(password_verify($pass,$row['Password']))
                {
                    $_SESSION['UID']=$row['UID'];
                    $string=$row['Name'];
                    $names=explode(' ',$string);
                    $fname=$names[0];
                    $_SESSION['Name']=$fname;
                    $_SESSION['Type']=$row['User_Type'];
                    header("location:index.php");
                }
                else{
                    $password_error="Incorrect Password";
                }
            }
        }
        else{
            $email_error="This email is not registered";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Google Font -->
    <!-- Css Styles -->
    <?php include_once ("partials/style-links.php"); ?>
    <style>
        .login-container{
            height : 450px;
        }
        .login-box{
            padding : 40px 40px;
        }
        .eye {
            position: absolute;
            left: 322px;
            top: -57px;
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
            margin-left: -42%;
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

    <center>
        <div class="login-container">
            <br>
            <center>
                <h3>Sign in</h3>
                <center>
                    <div class="form-section">
                        <form action="login.php" method="POST">
                            <div class="login-box">
                                <div class="box">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email" class="ele" placeholder="youremail@email.com" name="email"
                                        id="email" required>
                                </div>
                                <div class="error">
                                    <i class="fa fa-circle-exclamation"></i>
                                    <?php echo $email_error; ?>
                                </div>

                                <div class="box">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" class="ele" name="password" id="password"
                                        placeholder="Password" required>
                                    <span class="eye" onclick="myFunction()">
                                        <i id="hide1" class="fa fa-eye"></i>
                                        <i id="hide2" class="fa fa-eye-slash"></i>
                                    </span>
                                </div>
                                <div class="error">
                                    <i class="fa fa-circle-exclamation"></i>
                                    <?php echo $password_error; ?>
                                </div>

                                <div class="box">
                                    <i class="fa fa-user fa-1x"></i>
                                    <select class="ele" name="user" required>
                                        <!-- <option selected>--User Type--</option> -->
                                        <option selected disabled>--User Type--</option>
                                        <option value="A">Admin</option>
                                        <option value="C">Client</option>
                                        <option value="T">Trainer</option>
                                    </select>
                                </div>
                                <div class="box">
                                    <div class="g-recaptcha" data-sitekey="6LcycXYpAAAAAFzoQT3oscgn9WsxIib-O5y_BUOY"></div>
                                </div>

                                <div class="button-container">
                                    <button class="btn btn-lg btn-dark loginbtn" type="submit" id="login">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
        </div>
        <div class="para">
            <a href="forgot-password.php">Forgot Password</a>
            <a href="register.php">Create Account</a>
        </div>

        <!-- Footer Section Begin -->
        <?php include_once ("partials/footer.php"); ?>
        <!-- Footer Section End -->

        <!-- Js Plugins -->
        <?php include_once ("partials/js-links.php"); ?>
    </center>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("hide1");
            var z = document.getElementById("hide2");
            if (x.type == 'password') {
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
            }
            else {
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
            }
        }
    </script>
    <script>
        $(document).on('click','#login', function(){
            var response =grecaptcha.getResponse();
            if(response.length==0)
            {
                alert("Please Verify You Are A Human!");
                return false;
            }
        });
    </script>
</body>

</html>