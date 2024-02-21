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
    h4{
      color : grey;
    }
  </style>
</head>

<body>
  <!-- Page Preloder -->
  <!-- Header Section Begin -->
  <?php include_once ("partials/header.php"); ?>
  <!-- Header End -->
  <?php include_once ("partials/acc-header.php"); ?>



  <section class="my-reviews">
    <center>
      <h3>My Reviews</h3>
      <center>


        <div class="row">
          <div class="column">
            <div class="card">
              <?php
                if(isset($_SESSION['UID']))
                {
                  $uid=$_SESSION['UID'];
                  // $name=$_SESSION['Name'];
                  $name="Sneha Priya";
                  $sql="SELECT * FROM `feedback_tbl` WHERE `UID`=$uid AND View='Show'";
                  $result=mysqli_query($conn,$sql);
                  $num=mysqli_num_rows($result);
                  if($num>0)
                  {
                    
                  while($row=mysqli_fetch_assoc($result))
                  {
                    $pid=$row['P_ID'];
                    $sql2="SELECT * FROM `membership_details_tbl` WHERE `Membership_Plan_ID`='$pid'";
                    $result2=$result=mysqli_query($conn,$sql2);
                    $row2=mysqli_fetch_assoc($result2);
                    echo "<div class='card-container'>
                          <div class='image'>
                            <img src='images/products/prod1.jpg' height='200px' width='200px'>
                          </div>
                          <div class='text'>
                            <h5>".$name."</h5>
                            <p>Member<br>Plan: ".$row2['Membership_Plan_Name']."<br>".$row['Date']."</p>
                            ".$row['Feedback_Description']."
                          </div>
                        </div>";
                  }
                }
                  else{
                    echo "<center><h4>You Have No Reviews!</h4></center>";
                  }
                }
              ?>
              
            </div>
          </div>
        </div>

  </section>

  <!-- Footer Section Begin -->
  <?php include_once ("partials/footer.php"); ?>
  <!-- Footer Section End -->

  <!-- Js Plugins -->
  <?php include_once ("partials/js-links.php"); ?>

</body>

</html>