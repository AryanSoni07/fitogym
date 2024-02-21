<?php 
session_start();
include_once("partials/_dbconnect.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>View Tutorial</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <?php include_once("partials/_links.php"); ?>

  </head>

<body>

  <!-- ======= Header ======= -->
  <?php include_once("partials/_header.php"); 
        include_once("partials/_a_main.php");
  ?><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>View Tutorials</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Tutorials</li>
          <li class="breadcrumb-item active"><a href="view-all-tutorials.php">All Tutorials</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
      <div class="col-lg-12">

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tutorials</h5>

        <!-- Table with stripped rows -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Trainer_ID</td>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                      $sql="SELECT * FROM `tutorial_details_tbl`";
                      $result=mysqli_query($conn,$sql);

                    while($row=mysqli_fetch_assoc($result))
                    {
                      echo "<tr>
                        <td>".$row['Tutorial_ID']."</td>
                        <td>".$row['Trainer_ID']."</td>
                        <td>".$row['Tutorial_Name']."</td>
                        <td>".$row['Description']."</td>
                        <td><img src='".$row['Tutorial_Image']."'  width='100%' ></td>
                        <td>".$row['Tutorial_Link']."</td>
                        <td>".$row['Tutorial_Date']."</td>
                      </tr>";
                    }
                  ?>
            </tbody>
        </table>

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