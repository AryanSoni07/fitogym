<?php
session_start();
include_once ("partials/_dbconnect.php");
$email_error=null;
$password_error=null;
if($_SERVER['REQUEST_METHOD']=='POST')
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
                $sql="UPDATE `user_tbl` SET `Status`='Inactive' WHERE `Email`='$email'";
                $result=mysqli_query($conn,$sql);
                session_unset();
                session_destroy();
                header("refresh:1; url=index.php");
                
            }
            else{
                $password_error="Incorrect Password";
            }
        }
    }
    else{
        $email_error="Incorrect Email";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deactivate</title>
    <!-- Google Font -->
    <!-- Css Styles -->
    <?php include_once ("partials/style-links.php"); ?>
    <style>
        .eye {
            position: absolute;
            left: 322px;
            top: 5px;
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
                <h3>Deactivate Account</h3>
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
                                <div class="button-container">
                                    <button class="btn btn-lg btn-dark loginbtn" type="submit">Deactivate</button>
                                    <!-- <button class="btn btn-lg btn-outline-dark" type="reset">Cancel</button></a> -->
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
</body>

</html>