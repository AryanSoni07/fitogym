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
                    <th>
                    <b>Name</b>
                    </th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>D.O.J</th>
                    <th>Salary/Month</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                      $sql="SELECT * FROM `user_tbl` WHERE `User_Type`='Trainer' ";
                      $result=mysqli_query($conn,$sql);

                    while($row=mysqli_fetch_assoc($result))
                    {
                      $uid=$row['UID'];
                      $sql2="SELECT * FROM `trainer_tbl` WHERE `UID`=$uid";
                      $result2=mysqli_query($conn,$sql2);
                      $row2=mysqli_fetch_Assoc($result2);
                      echo "<tr>
                      <td>".$row['Name']."</td>
                      <td>".$row['Gender']."</td>
                      <td>".$row['DOB']."</td>
                      <td>".$row['Email']."</td>
                      <td>".$row['Phone']."</td>
                      <td>".$row2['DOJ']."</td>
                      <td>".$row2['Salary']."</td>
                      <td>".$row['Area_Street'].", ".$row['Region'].", ".$row['City'].", ".$row['State'].", ".$row['Pincode']."</td>
                      <td>".$row['Status']."</td>
                      <td><a href='update-trainer.php?tid=".$row['UID']."'><button type='button' class='btn btn-outline-primary'>Update</button></a></td>
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