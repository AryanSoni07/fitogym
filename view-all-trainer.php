<?php 
session_start();
include_once("partials/_dbconnect.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>View Trainer</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <?php include_once("partials/_links.php"); ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php
    include_once("partials/_header.php");
    include_once("partials/_a_main.php");
  ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>View Trainers</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Trainer</li>
          <li class="breadcrumb-item active"><a href="view-trainer.php">View Trainers</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
      <div class="col-lg-12">

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Trainers</h5>

        <!-- Table with stripped rows -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                      $sql="SELECT * FROM `user_tbl` WHERE `User_Type`='Trainer' ";
                      $result=mysqli_query($conn,$sql);

                    while($row=mysqli_fetch_assoc($result))
                    {
                      echo "<tr>
                      <td>".$row['Name']."</td>
                      <td>".$row['Gender']."</td>
                      <td>".$row['DOB']."</td>
                      <td>".$row['Email']."</td>
                      <td>".$row['Status']."</td>
                    </tr>";
                    }
                  ?>
            </tbody>
        </table>
        <!-- End Table with stripped rows -->

    </div>
</div>

</div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include_once("partials/_footer.php"); ?>

</body>

</html>