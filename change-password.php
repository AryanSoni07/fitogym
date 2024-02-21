<?php
session_start();
$success=false;
$perror=null;
$cperror=null;
if(isset($_SESSION['UID']))
{
  // echo $_SESSION['UID'];
  // echo $_SESSION['Type'];
}
else{
  header("refresh:1; url=/fitogym/login.php");
}
include_once ("partials/_dbconnect.php");
if (isset($_POST['password'])) {
    $uid = $_SESSION['UID'];
    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $cpassword = $_POST['renewpassword'];
    $sql = "SELECT * FROM `user_tbl` WHERE `user_tbl`.`UID`=$uid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['Password'])) {
        if ($newpassword == $cpassword) {
            $hash = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql = "UPDATE `user_tbl` SET `Password`='$hash' WHERE `UID`=$uid";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $success=true;
            }
        } else {
            $cperror="*Password and Confirm Password do not match";
        }
    } else {
        $perror= "*Incorrect Password";
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

    .error1 {
        display: block;
        height: 0%;
        left: 1%;
        margin-left: -40%;
        margin-top: -6%;
        color: red;
    }
    .error2 {
        display: block;
        height: 0%;
        left: 1%;
        margin-left: -1%;
        margin-top: -6%;
        color: red;
    }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <!-- Header Section Begin -->
    <?php include_once ("partials/header.php");
    include_once ("partials/acc-header.php"); ?>
    <!-- Header End -->
    <?php
    if($success)
    {
        echo "<div class='alert alert-success' role='alert'>
        Password Updated Successfully!
      </div>";
    }

?>
    <center>
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
                            <input type='password' class='ele' placeholder='Enter Old Password' name='password' id='password' required>
                        </div>
                        <div class='error1'>
                           <?php echo $perror; ?>
                        </div>
                        <div class='box'>
                            <i class='fa fa-lock'></i>
                            <input type='password' class='ele' placeholder='Enter New Password' name='newpassword' id='newpassword' required>
                        </div>
                        <div class='box'>
                            <i class='fa fa-lock'></i>
                            <input type='password' class='ele' placeholder='Enter Confirm Password' name='renewpassword' id='renewpassword' required>
                        </div>
                        <div class='error2'>
                           <?php echo $cperror; ?>
                        </div>
                        <div class='button-container'>
                            <button class='btn btn-lg btn-dark loginbtn' type='submit' name='submit'>Change Password</button>
                        </div>
                    </div>
                </form>
                </div' </div>

    </center>
    <?php include_once ("partials/footer.php"); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include_once ("partials/js-links.php"); ?>

</body>

</html>