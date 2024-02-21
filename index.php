<?php 
  session_start();
  if(isset($_SESSION['UID']))
  {
    // echo $_SESSION['UID'];
    // echo $_SESSION['Type'];
  }
  else{
    header("refresh:1; url=/fitogym/login.php");
  }
  include_once ("partials/_dbconnect.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard Trainer FIT-O-GYM</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php include_once ("partials/_links.php"); ?>

</head>

<body>

  <!-- ======= Header ======= -->
  <?php  include_once("partials/_header.php"); ?><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include_once("partials/_a_main.php"); ?><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">


            <!-- Tutorial Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                

                <div class="card-body">
                  <h5 class="card-title">Tutorials <span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      T
                    </div>
                    <div class="ps-3">
                    <?php
                      $sql="SELECT * FROM `tutorial_details_tbl`";
                      $result=mysqli_query($conn,$sql);
                      $num=mysqli_num_rows($result);
                      echo "<h6>$num</h6>";
                      ?>
                      
                      
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Tutorial Card -->

            <!-- Blog Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                

                <div class="card-body">
                  <h5 class="card-title">Blogs <span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      B
                    </div>
                    <div class="ps-3">
                    <?php
                      $sql="SELECT * FROM `blogs_tbl`";
                      $result=mysqli_query($conn,$sql);
                      $num=mysqli_num_rows($result);
                      echo "<h6>$num</h6>";
                      ?>
                      
                      
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Blog Card -->

            <!-- Event Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                

                <div class="card-body">
                  <h5 class="card-title">Events <span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      E
                    </div>
                    <div class="ps-3">
                    <?php
                      $sql="SELECT * FROM `event_tbl`";
                      $result=mysqli_query($conn,$sql);
                      $num=mysqli_num_rows($result);
                      echo "<h6>$num</h6>";
                      ?>
                      
                      
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Event Card -->
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include_once("partials/_footer.php"); ?>
</body>

</html>