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

  <title>Clients</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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
      <h1>View Clients</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Clients</li>
          <li class="breadcrumb-item active"><a href="view-clients.php">View Clients</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Clients</h5>
              
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
                    <th>Address</th>
                    <th>Status</th>
                    <th>Update</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql="SELECT * FROM `user_tbl` WHERE `User_Type`='Client'";
                    $result=mysqli_query($conn,$sql);

                  while($row=mysqli_fetch_assoc($result))
                  {
                    echo "<tr>
                      <td>".$row['Name']."</td>
                      <td>".$row['Gender']."</td>
                      <td>".$row['DOB']."</td>
                      <td>".$row['Email']."</td>
                      <td>".$row['Phone']."</td>
                      <td>".$row['Area_Street'].", ".$row['Region'].", ".$row['City'].", ".$row['State'].", ".$row['Pincode']."</td>
                      <td>".$row['Status']."</td>
                      <td><a href='update-client.php?uid=".$row['UID']."'><button type='button' class='btn btn-outline-primary'>Update</button></a></td>
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