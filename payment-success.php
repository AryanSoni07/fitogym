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
  <!-- Footer Section End -->

  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The Payment has been done successfully ! Your Payment id is <?php echo $_SESSION['paymentid'];?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
  <?php include_once ("partials/footer.php"); ?>
  <!-- Js Plugins -->
  <?php include_once ("partials/js-links.php"); ?>

</body>

</html>