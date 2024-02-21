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

  <title>View Membership Plans</title>
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
      <h1>View Membership Plans</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Membership Plans</li>
          <li class="breadcrumb-item active"><a href="view-plans.php">View Membership Plans</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
      <div class="col-lg-12">

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Membership Plans</h5>

        <!-- Table with stripped rows -->
        <table class="table datatable">
            <thead>
                <tr>
                    <th>
                        <b>ID</b>
                    </th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Validity</th>
                    <th>Status</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                      $sql="SELECT * FROM `membership_details_tbl`";
                      $result=mysqli_query($conn,$sql);

                    while($row=mysqli_fetch_assoc($result))
                    {
                      echo "<tr>
                        <td>".$row['Membership_Plan_ID']."</td>
                        <td>".$row['Membership_Plan_Name']."</td>
                        <td>".$row['Membership_Plan_Description']."</td>
                        <td>₹".$row['Price']."</td>
                        <td>".$row['Validity']." Month(s)</td>
                        <td>".$row['Membership_Plan_Status']."</td>
                        <td><a href='update-plans.php?planid=".$row['Membership_Plan_ID']."'><button type='button' class='btn btn-outline-primary'>Update</button></a></td>
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