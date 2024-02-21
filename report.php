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

  <title>Reports</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <?php include_once("partials/_links.php"); ?>

  </head>

<body>
<?php 
    include_once ("partials/_header.php");
    include_once ("partials/_a_main.php");
  ?>
  <main id="main" class="main">
  <div class="pagetitle">
      <h1>Reports</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active"><a href="report.php">Reports</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  </main><!-- End #main -->

  <?php include_once("partials/_footer.php"); ?>
</body>

</html>