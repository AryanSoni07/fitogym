<?php
session_start();
include_once ("partials/_dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fit-O-Gym</title>
    <!-- Google Font -->
    <!-- Css Styles -->
    <?php include_once ("partials/style-links.php"); ?>

  </head>
  <body>
    <!-- Page Preloder -->
    <!-- Header Section Begin -->
    <?php include_once ("partials/header.php"); ?>
    <!-- Header End -->

    <section class="breadcrumb-area set-bg" data-setbg="images/contact/contact-bg.jpg">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-content">
                    <h2>Membership Plans</h2>
                    <h4>A Plan for Everyone</h4>
                    </div>
                </div>
            </div>
    </section>
        <section id="pricing-plans">
    
              <div class="row card-deck">
                    <?php
                        $sql="SELECT * FROM `membership_details_tbl`";
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo "<div class='price-col col-lg-4 col-md-6'>
                            <div class='card h-100'>
                            <div class='card'>
                            <div class='card-header'>
                            <h3>".$row['Membership_Plan_Name']."</h3>
                            </div>
                            <div class='card-body'>
                              <h2 class='planh'>".$row['Price']."/-</h2>
                              <p>Validity: ".$row['Validity']." mon</p>
                              <p>".$row['Membership_Plan_Description']."</p>
                            <div  class='d-grid'>";

                            if(isset($_SESSION['UID']))
                            {                            
                            echo "<a href='javascript:void(0)' data-planid='".$row['Membership_Plan_ID']."' data-planname='".$row['Membership_Plan_Name']."' data-amount='".$row['Price']."' validity='".$row['Validity']."' class='btn btn-lg btn-block btn-dark buynow'>Purchase</a>";
                          }
                          else{
                            echo "<a href='login.php' class='btn btn-lg btn-block btn-dark buynow'>Purchase</a>";
                          }

                            echo "</div>
                            </div>
                            </div>
                            </div>
                            </div>";
                        }
                    ?> 
            </div>
          
            </div>
        
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script>

    $(".buynow").click(function () {

      var amount = $(this).attr('data-amount');
      var planid = $(this).attr('data-planid');
      var planname = $(this).attr('data-planname');
      var ordertype="Membership";	
      var validity=$(this).attr('validity');

      var options = {
        "key": "rzp_test_V6AeC40NyZIjJ4", // Enter the Key ID generated from the Dashboard
        "amount": amount * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "name": "Fit-O-Gym",
        "description": planname,
        "image": "https://example.com/your_logo",
        "handler": function (response) {
          var paymentid = response.razorpay_payment_id;

          $.ajax({
            url: "payment.php",
            type: "POST",
            data: { plan_id: planid, payment_id: paymentid, pay_amount: amount, type:ordertype, plan_validity:validity},
            success: function (finalresponse) {
              if (finalresponse == 'done') {
                window.location.href = "http://localhost/fitogym/client-plan.php?success";
              }
              else {
                alert('Please check console.log to find error');
                console.log(finalresponse);
              }
            }
          })

        },
        "theme": {
          "color": "#3399cc"
        }
      };
      var rzp1 = new Razorpay(options);
      rzp1.open();
      e.preventDefault();
    });
  </script>


      <!-- Footer Section Begin -->
      <?php include_once ("partials/footer.php"); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include_once ("partials/js-links.php"); ?>
    
  </body>
</html>
