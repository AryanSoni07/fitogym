<?php

session_start();
include_once ("partials/_dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FIT-O-GYM</title>
    <!-- Google Font -->
    <!-- Css Styles -->
    <?php include_once ("partials/style-links.php"); ?>

    <style>
    * {
        box-sizing: border-box;
    }

    /* Float four columns side by side */
    .column {
        float: left;
        width: 100%;
        padding: 10px 80px;
    }

    /* Remove extra left and right margins, due to padding */
    .row {
        margin: 0 -5px;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive columns */
    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }
    }

    /* Style the counter cards */
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        padding-top: 16px;
        padding-bottom: 16px;
        padding-left: 30px;
        padding-right: 30px;
        text-align: left;
        background-color: #ffffff;
    }

    .card-container {
        display: grid;
        align-items: center;
        grid-template-columns: 1fr 1fr 1fr;
        column-gap: 5px;
    }

    a {
        color: blue;
    }

    a:hover {
        color: black;
    }

    .center {
        display: block;
        margin: 10px 550px;
    }

.no-order-h2{
      margin-left: 450px;
      margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <!-- Header Section Begin -->
    <?php include_once ("partials/header.php"); ?>
    <!-- Header End -->
    <?php include_once ("partials/acc-header.php"); ?>

    <?php
if(isset($_GET['success']))
{
    echo "<div class='alert alert-success' role='alert'>
            Plan Purchased Successfully!
          </div>"; 
}

?>
    <section class="my-plan">
        <center>
            <h3>My Plan</h3>
        <center>
      <?php
        $uid=$_SESSION['UID'];
        $sql="SELECT * FROM `order_tbl` WHERE `UID`=$uid AND `Order_Type`='Membership'";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);
        if($num>0)
        {
            while($row=mysqli_fetch_assoc($result))
            {
                $oid=$row['Order_ID'];
                $sql3="SELECT * FROM `membership_order_tbl` WHERE `Order_ID`=$oid AND Expiry_Date>CURRENT_DATE()" ;
                $result3=mysqli_query($conn,$sql3);
                $num3=mysqli_num_rows($result3);
                if($num3>0)
                {
                    $row3=mysqli_fetch_assoc($result3);
                    $mpi=$row3['Membership_Plan_ID'];
        
                    $sql2="SELECT * FROM `membership_details_tbl` WHERE `Membership_Plan_ID`='$mpi'";
                    $result2=mysqli_query($conn,$sql2);
                    $row2=mysqli_fetch_assoc($result2);
        
        
                    echo "
                    <div class='row'>
                        <div class='column'>
                            <div class='card'><div class='card-container'>
                            <div class='image'>
                            <img src='images/products/prod1.jpg' height='200px' width='200px'>
                            </div>
                            <div class='text'>
                            <h3>".$row2['Membership_Plan_Name']."</h3>
                            <p>FIT-O-GYM</p>
                            <b>About This Plan</b>".$row2['Membership_Plan_Description']."<br>
                            <br><br><b>Expiring on ".$row3['Expiry_Date']."</b><br>
                            <p>Plan access will automatically be ended after midnight</p>
                            <br><br>
                            <a href='feedback.php?pid=$mpi&type=Plan' class='btn btn-primary'>Write Review</a>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>";
                }
            }
        }
        else{
            echo "
            <br><br><img src='images/cart.png' height='200px' class='center'><h2 style='color:grey;' class='no-order-h2'>You have no Active Plans! <a href='plans.php' class='btn btn-lg btn-warning '>Buy Plan</a></h2>";
        }

      ?>
    </section>

    <!-- Footer Section Begin -->
    <?php include_once ("partials/footer.php"); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include_once ("partials/js-links.php"); ?>

</body>

</html>