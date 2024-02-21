<?php 
session_start();
include_once("partials/_dbconnect.php"); 
$hidden=null;
if(isset($_SESSION['UID']))
{
  // echo $_SESSION['UID'];
  // echo $_SESSION['Type'];
}
else{
  header("refresh:1; url=/fitogym/login.php");
}
if(isset($_GET['fid']))
{
    $fid=$_GET['fid'];
    $sql="UPDATE `feedback_tbl` SET `View`='Hide' WHERE `Feedback_ID`=$fid";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        $hidden=true;
    }
}
?>

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
  <?php include_once("partials/_header.php"); 
        include_once("partials/_a_main.php");

        if($hidden==true)
        {
            echo "<div class='alert alert-success' role='alert'>
            The feedback is hidden Successfully!
          </div>"; 
        }
  ?>
    <div class="pagetitle">
      <h1>Feedback</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active"><a href="feedback.php">Feedback</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section faq">
      <div class="row">
      <div class="card">
            <div class="card-body">
              <h5 class="card-title">Feedbacks</h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Feedback ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Feedback</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Hide</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql="SELECT * FROM `feedback_tbl` WHERE View='Show'";
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
                      <td scope='col'>".$row['Time']."</td>
                      <td scope='col'><a href='?fid=".$row['Feedback_ID']."' class='btn btn-primary'>Hide</a></td>
                    </tr>";
                  }
                  ?>
                  </tbody>
              </table>
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