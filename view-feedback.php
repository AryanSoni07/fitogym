<?php 
session_start();
include_once("partials/_dbconnect.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Feedbacks</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <?php include_once("partials/_links.php"); ?>

</head>

<body>

  <!-- ======= Header ======= -->
  <?php 
    include_once ("partials/_header.php");
    include_once ("partials/_a_main.php");
  ?><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Feedback</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="view-feedback.php">Feedback</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section faq">
      <div class="row">
      <div class="card">
            <div class="card-body">
              <h5 class="card-title">Feedback</h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Feedback_ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Feedback</th>
                    <th scope="col">Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $sql="SELECT * FROM `feedback_tbl`";
                  $result=mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_assoc($result))
                  {
                    $uid=$row['UID'];
                    $sql2="SELECT * FROM `user_tbl` WHERE `UID`=$uid";
                    $result2=mysqli_query($conn,$sql2);
                    $row2=mysqli_fetch_assoc($result2);
                    echo "<tr>
                      <td scope='col'>".$row['Feedback_ID']."</td>
                      <td scope='col'>".$row2['Name']."</td>
                      <td scope='col'>".$row['Feedback_Description']."</td>
                      <td scope='col'>".$row['Date']."</td>
                    </tr>";
                  }
                  ?>
                </tbody>
              </table>
              <!-- Add name of member instead od id -->
              <!-- End Table with stripped rows -->

            </div>
          </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include_once("partials/_footer.php"); ?>
</body>

</html>