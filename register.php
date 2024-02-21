<?php
include_once ("partials/_dbconnect.php");
$userRegistered=null;
$email_error=null;
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $area=$_POST['area'];
    $region=$_POST['region'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $pincode=$_POST['pincode'];

    $existUser="SELECT * FROM `user_tbl` WHERE `user_tbl`.`Email`='$email'";
    $result=mysqli_query($conn,$existUser);
    $numExist=mysqli_num_rows($result);
    
    if($numExist > 0)
    {
        $email_error= "This email is already registered";
    }
    else{
        $hash=password_hash($password,PASSWORD_DEFAULT);

        $sql="INSERT INTO `user_tbl`(`Name`, `User_Type`, `Gender`, `DOB`, `Email`, `Password`, `Phone`, `Area_Street`, `Region`, `City`, `Pincode`, `State`, `Image`, `Status`) VALUES ('$name','Client','$gender','$dob','$email','$hash','$phone','$area','$region','$city','$pincode','$state','','Active')";
        
        $result=mysqli_query($conn,$sql);
        if($result)
        {
            $userRegistered="true";
        }
        else{
            echo "Error in registering user : ".mysqli_error($conn);
        }
    }
}   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Google Font -->
    <!-- Css Styles -->
    <?php include_once ("partials/style-links.php"); ?>


    <style>
    .box input,
    select,
    textarea {
        width: 50%;
        height: 35px;
        margin: 10px;
        color: black;
        font-size: 15px;
        border-radius: 5px;
        border-width: 2px;
    }

    textarea {
        height: 50px;
    }

    .error {
        display: block;
        height: 0%;
        left: 1%;
        margin-left: -27%;
        margin-top: -1%;
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
    
        if($userRegistered=="true")
        {
            echo "<div class='alert alert-success' role='alert'>
            You are Registered Successfully! <a href='login.php'>Click here</a> to Login.
          </div>"; 
        }
    ?>
    <center>
        <form action="register.php" method="POST">

            <h2>Create Account</h2>

            <div class="register-div">
                <div class="box">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Your Name" required
                        onkeypress="validateName(event)">
                </div>

                <div class="box">
                    <label>Gender</label>
                    <select name="gender">
                        <option selected>--Select--</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="box">
                    <label for="dob">D.O.B</label>
                    <input type="date" name="dob" id="dob" required>
                </div>

                <div class="box">
                    <label for="phone">Phone</label>
                    <input type="text" pattern="[0-9]*" title="Please enter only digits" name="phone" id="phone"
                        placeholder="Enter Your Phone" maxlength="10" minlength="10" required>
                </div>

                <div class="box">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Your Email" required>
                </div>
                <div class="error">
                    <i class="fa fa-circle-exclamation"></i>
                    <?php echo $email_error; ?>
                </div>

                <div class="box">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" minlength="8" placeholder="Enter Your Password"
                        required>
                </div>

                <!-- <div class="box">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" cols="58" rows="2"
                        placeholder="Enter Your Address"></textarea>
                </div> -->

                <div class="box">
                    <label for="area">House No. / Street</label>
                    <input type="text" name="area" id="area" maxlength="50" placeholder="Enter House No. / Street">
                </div>
                <div class="box">
                    <label for="name">Landmark</label>
                    <input type="text" name="region" id="region" maxlength="20" placeholder="Enter Landmark (Region)"
                        required onkeypress="validateName(event)">
                </div>
                <div class="box">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" placeholder="Enter City" maxlength="20" required
                        onkeypress="validateName(event)">
                </div>
                <div class="box">
                    <label>State</label>
                    <select name="state">
                        <option selected>--Select--</option>
                        <?php
                        $sql="SELECT * FROM `state`";
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo "<option value='".$row['State']."'>".$row['State']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="box">
                    <label for="pincode">Pincode</label>
                    <input type="text" name="pincode" id="pincode" pattern="[0-9]*" title="Please enter only digits"
                        minlength="6" maxlength="6">
                </div>

                <div class="box mb-3" style="width : 100%;">
                    <div class="g-recaptcha" data-sitekey="6LcycXYpAAAAAFzoQT3oscgn9WsxIib-O5y_BUOY"></div>
                </div>

                <div class="button-container">
                    <button id="register" class="btn btn-lg btn-dark loginbtn" type="submit">Register</button>
                    <button class="btn btn-lg btn-outline-dark" type="reset">Cancel</button></a>
                </div>
            </div>

        </form>

        <div class="para">
            <p>Already a user?
                <a href="login.php">Sign In</a>
            </p>
        </div>
    </center>
    <!-- Footer Section Begin -->
    <?php include_once ("partials/footer.php"); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include_once ("partials/js-links.php"); ?>

    <script>
    function validateName(event) {
        const input = event.key;
        if (/\d/.test(input)) {
            event.preventDefault();
        }
    }
    </script>
    <script>
    $(document).on('click', '#register', function() {
        var response = grecaptcha.getResponse();
        if (response.length == 0) {
            alert("Please Verify You Are A Human!");
            return false;
        }
    });
    </script>
</body>

</html>