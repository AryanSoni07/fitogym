<?php

session_start();
$hidden=null;
include_once ("partials/_dbconnect.php");
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $uid=$_SESSION['UID'];
    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    
    $area=$_POST['area'];
    $region=$_POST['region'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $pincode=$_POST['pincode'];
    if(isset($_POST['height']))
    {

        $height=intval($_POST['height']);
        $weight=intval($_POST['weight']);
        $bmi=$weight/(($height/100)*($height/100));
        $sqlmember="SELECT * FROM `member_tbl` WHERE `UID`=$uid";
        $resultmember=mysqli_query($conn,$sqlmember);
        $num=mysqli_num_rows($resultmember);
        if($num>0)
        {
            $sql3="UPDATE `member_tbl` SET `Height`=$height,`Weight`=$weight,`BMI`=$bmi WHERE UID=$uid";
            $result3=mysqli_query($conn,$sql3);
        }
    }
    $sqlupdate="UPDATE `user_tbl` SET `Name`='$name',`Gender`='$gender',`DOB`='$dob',`Email`='$email',`Phone`='$phone',`Area_Street`='$area',`Region`='$region',`City`='$city',`Pincode`='$pincode',`State`='$state'  WHERE UID=$uid";
    $resultupdate=mysqli_query($conn,$sqlupdate);
    if($resultupdate)
    {
        $hidden="true";
    }



}
if(isset($_SESSION['UID']))
{
    $uid=$_SESSION['UID'];
    $sql="SELECT * FROM `user_tbl` WHERE UID=$uid";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

    $sql2="SELECT * FROM `order_tbl` WHERE `UID`=$uid AND `Order_Type`='Membership' ORDER BY Order_ID DESC";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    $num2=mysqli_num_rows($result2);
    if($num2>0)
    {
        $oid=$row2['Order_ID'];
        $sql2="SELECT * FROM `membership_order_tbl` WHERE `Order_ID`=$oid";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $mpoid=$row2['Membership_Plan_Order_ID'];
        
        $sqlmember="SELECT * FROM `member_tbl` WHERE `UID`=$uid";
        $resultmember=mysqli_query($conn,$sqlmember);
        $num=mysqli_num_rows($result);
        if($num>0)
        {
            $sql2="SELECT * FROM `member_tbl` WHERE `Membership_Plan_Order_ID`=$mpoid";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

    <!-- Google Font -->
    <!-- Css Styles -->
    <?php include_once ("partials/style-links.php"); ?>


    <style>
        .box input, select, textarea{
            width: 50%;
            margin: 10px;
            color: black;
            font-size: 15px;
            border-radius: 5px;
            border-width: 2px;
        }
    </style>


</head>

<body>
    
    <!-- Page Preloder -->
    <!-- Header Section Begin -->
    <?php include_once ("partials/header.php"); ?>
    <!-- Header End -->
    <?php
    
    if($hidden=="true")
    {
        echo "<div class='alert alert-success' role='alert'>
        Profile Updated Successfully!
        </div>"; 
    }
    ?>
    <?php include_once ("partials/acc-header.php"); ?>

    <center>
    <form action="" method="POST">
        <div class="register-div">
        <h3>Personal Information</h4>
         
                <div class="box">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" onkeypress="validateName(event)" value="<?php echo $row['Name']; ?>">
                </div>

                <div class="box">
                <label>Gender</label>
                <select name="gender">
                        <option selected value="<?php echo $row['Gender']; ?>"><?php echo $row['Gender']; ?></option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="box">
                    <label for="dob">D.O.B</label>
                    <input type="date" name="dob" id="dob" value="<?php echo $row['DOB']; ?>">
                </div>

                <div class="box">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="name" maxlength="10" minlength="10" pattern="[0-9]*" title="Please enter only digits" value="<?php echo $row['Phone']; ?>">
                </div>

                <div class="box">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $row['Email']; ?>">
                </div>

                <div class="box">
                <label for="area">House No. / Street</label>
                <input type="text" name="area" id="area" maxlength="50" placeholder="Enter House No. / Street" value="<?php echo $row['Area_Street']; ?>">
                </div>
                <div class="box">
                <label for="name">Landmark</label>
                <input type="text" name="region" id="region" maxlength="20" value="<?php echo $row['Region']; ?>" placeholder="Enter Landmark (Region)" required onkeypress="validateName(event)">
                </div>
                <div class="box">
                <label for="city">City</label>
                <input type="text" name="city" id="city" placeholder="Enter City" maxlength="20" value="<?php echo $row['City']; ?>" required onkeypress="validateName(event)">
                </div>
                <div class="box">
                <label>State</label>
                <select name="state">
                        <option selected value="<?php echo $row['State']; ?>"><?php echo $row['State']; ?></option>
                        <?php
                        $sql="SELECT * FROM `state`";
                        $result=mysqli_query($conn,$sql);
                        while($row3=mysqli_fetch_assoc($result))
                        {
                            echo "<option value='".$row3['State']."'>".$row3['State']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="box">
                <label for="pincode">Pincode</label>
                <input type="text" name="pincode" id="pincode" value="<?php echo $row['Pincode']; ?>" pattern="[0-9]*" title="Please enter only digits" minlength="6" maxlength="6"> 
                </div>

                <?php
                    $sqlmember="SELECT * FROM `member_tbl` WHERE `UID`=$uid";
                    $resultmember=mysqli_query($conn,$sqlmember);
                    $num=mysqli_num_rows($result);
                    if($num>0 and $num2>0)
                    {
                        echo "<h3>BMI</h3>

                        <div class='box'>
                            <label for='height'>Height (cm)</label>
                            <input type='number' name='height' id='height' value='".$row2['Height']."' placeholder='(in cm)'>
                        </div>
        
                        <div class='box'>
                            <label for='weight'>Weight (Kg)</label>
                            <input type='number' name='weight' id='weight' value='".$row2['Weight']."' placeholder='(in kgs)'>
                        </div>
                        
                        <div class='box'>
                            <label for='weight'>BMI</label>
                            <input type='number' name='bmi' id='weight' value='".$row2['BMI']."' disabled>
                        </div>";
                    }
                ?>
                
                <div class='button-container'>
                    <button class='btn btn-lg btn-dark loginbtn' type='submit'>Save</button>
                    <button class='btn btn-lg btn-outline-dark' type='reset'>Cancel</button></a>
                </div>
        </div>
        
    </form>

    <div class="para">
        <p>Unhappy with FIT-O-GYM?
        <a href="deactivate.php">Deactivate</a></p>
    </div>
    </center>
    <!-- Footer Section Begin -->
    <?php include_once ("partials/footer.php"); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include_once ("partials/js-links.php"); ?>
    <script>
        function validateName(event){
            const input = event.key;
            if(/\d/.test(input)){
                event.preventDefault();
            }
        }
    </script>

</body>
</html>