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
  include_once("partials/_dbconnect.php");
  $planExist="false";
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
      $id=$_POST['id'];
      $name=$_POST['name'];
      $description=$_POST['description'];
      $price=$_POST['price'];
      $validity=$_POST['validity'];

      $existPlan="SELECT * FROM `membership_details_tbl` WHERE `membership_details_tbl`.`Membership_Plan_ID`='$id'";
      $result=mysqli_query($conn,$existPlan);
      $numExist=mysqli_num_rows($result);
      
      if($numExist > 0)
      {
          $planExist="Exist";
      }
      else{
          $sql="INSERT INTO `membership_details_tbl`(`Membership_Plan_ID`, `Membership_Plan_Name`, `Membership_Plan_Description`, `Price`, `Validity`, `Membership_Plan_Status`) VALUES ('$id','$name','$description','$price','$validity','Active')";
          
          $result=mysqli_query($conn,$sql);
          if($result)
          {
              $planExist="true";
          }
          else{
              $planExist="Error";
          }
      }
  } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Add Membership Plans</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include_once("partials/_links.php"); ?>
</head>

<body>

    <!-- header+sidebar -->
    <?php 
      include_once("partials/_header.php"); 
      include_once("partials/_a_main.php");
  ?>
    <main id="main" class="main">
        <?php
        if($planExist=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Membership Plan Added Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($planExist=="Exist")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          This Membership Plan ID is already Used!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        elseif($planExist=="Error")
        {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Error in adding membership plans!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
      ?>
        <div class="pagetitle">
            <h1>Add Membership Plan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Membership Plans</li>
                    <li class="breadcrumb-item active"><a href="add-plans.php">Add Membership Plan</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Membership Plan Details</h5>
                        <!-- General Form Elements -->
                        <form action="add-plans.php" method="post">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Membership Plan ID</label>
                                <div class="col-sm-10">
                                <?php
                                $catsql="SELECT * FROM `membership_details_tbl`";
                                $catresult=mysqli_query($conn,$catsql);
                                $catnum=mysqli_num_rows($catresult);
                                $catnum+=1;
                                $catid="Plan00".$catnum;
                                ?>
                                    <input type="text" class="form-control" value="<?php echo $catid; ?>" readonly name="id" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Membership Plan Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Membership Plan
                                    Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" style="height: 100px"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Validity(in months)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="validity" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Price(in ₹)</label>
                                <div class="col-sm-10">
                                    <input type="text" pattern="[0-9]*" title="Please enter only digits" class="form-control" name="price" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Add Membership Plan</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include_once("partials/_footer.php"); ?>

</body>

</html>