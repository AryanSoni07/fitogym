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
  $userRegistered=false;
  include_once ("partials/_dbconnect.php");
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
      $name=$_POST['name'];
      $gender=$_POST['gender'];
      $dob=$_POST['dob'];
      $phone=$_POST['phone'];
      $email=$_POST['email'];
      $password="t@123456";
      
      $area=$_POST['area'];
      $region=$_POST['region'];
      $city=$_POST['city'];
      $state=$_POST['state'];
      $pincode=$_POST['pincode'];

      $salary=$_POST['salary'];
      $experience=$_POST['experience'];

      if ($_FILES["image"]["size"] > 1048576) {
        exit('File too large (max 1MB)');
    }
    
    // Use fileinfo to get the mime type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($_FILES["image"]["tmp_name"]);
    
    $mime_types = ["image/gif", "image/png", "image/jpeg", "image/jpg"];
            
    if ( ! in_array($_FILES["image"]["type"], $mime_types)) {
        exit("Invalid file type");
    }
    
    // Replace any characters not \w- in the original filename
    $pathinfo = pathinfo($_FILES["image"]["name"]);
    
    $base = $pathinfo["filename"];
    
    $base = preg_replace("/[^\w-]/", "_", $base);
    
    $filename = $base . "." . $pathinfo["extension"];
    
    $destination = __DIR__ . "/assets/img/" . $filename;
    
    $image="/fitogym/ADMIN/assets/img/".$filename;
    // echo $destination;
    
    // Add a numeric suffix if the file already exists
    $i = 1;
    
    while (file_exists($destination)) {
    
        $filename = $base . "($i)." . $pathinfo["extension"];
        $destination = __DIR__ . "/assets/img/" . $filename;
        $image="/fitogym/ADMIN/assets/img/".$filename;
        $i++;
    }
    
    if ( ! move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
    
        exit("Can't move uploaded file");
    
    }
   

      $existUser="SELECT * FROM `user_tbl` WHERE `user_tbl`.`Email`='$email'";
      $result=mysqli_query($conn,$existUser);
      $numExist=mysqli_num_rows($result);
      
      if($numExist > 0)
      {
          $userRegistered="Email";
      }
      else{
          $hash=password_hash($password,PASSWORD_DEFAULT);
          $sql="INSERT INTO `user_tbl` (`Name`, `User_Type`, `Gender`, `DOB`, `Email`, `Password`, `Phone`, `Area_Street`, `Region`, `City`, `Pincode`, `State`, `Image`, `Status`) VALUES ('$name', 'Trainer', '$gender', '$dob', '$email', '$hash', '$phone', '$area','$region','$city','$pincode','$state', '', 'Active')";
          $result=mysqli_query($conn,$sql);

          $sql3="SELECT * FROM `user_tbl` ORDER BY `UID` DESC";
          $result3=mysqli_query($conn,$sql3);
          $row3=mysqli_fetch_assoc($result3);
          $uid=$row3['UID'];

          $sql2="INSERT INTO `trainer_tbl`(`UID`, `DOJ`, `Experience`, `Salary`) VALUES ($uid,current_timestamp(),$experience,$salary)";
          $result2=mysqli_query($conn,$sql2);
          if($result)
          {
              $userRegistered="true";
          }
          else{
              $userRegistered="Error";
          }
      }
  }   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Add Trainer</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <?php include_once("partials/_links.php"); ?>
</head>

<body>

    <!-- ======= Header ======= -->
    <?php include_once("partials/_header.php"); ?>
    <?php include_once("partials/_a_main.php"); ?>
    <!-- End Sidebar-->

    <main id="main" class="main">
      <?php
        if($userRegistered=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Trainer Added Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($userRegistered=="Email")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          This email is already registered!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        elseif($userRegistered=="Error")
        {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Error in adding Trainer!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
      ?>
        <div class="pagetitle">
            <h1>Add Trainer</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Trainers</li>
                    <li class="breadcrumb-item active"><a href="add-trainer.php">Add Trainer</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Trainer Details</h5>
                        <!-- General Form Elements -->
                        <form method="post" enctype="multipart/form-data" action="add-trainer.php">
                            <div class="row mb-3">
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" required onkeypress="validateName(event)">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="gender">
                                        <option selected>---Select Gender---</option>
                                        <option value='Male'>Male</option>
                                        <option value='Female'>Female</option>
                                        <option value='Others'>Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" pattern="[0-9]*" title="Please enter only digits" class="form-control" name="phone" required minlength="10" maxlength="10">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">DOB</label>
                                <div class="col-sm-10">
                                    <input type="date" name="dob" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Salary/Month (in ₹)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="salary" required minlength="4" maxlength="5">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Experience (in years)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="experience" required minlength="1" maxlength="2">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">House No. / Street</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="area"  required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Landmark</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="region"  required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="city" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">State</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="state">
                                    <option selected>---Select State--</option>
                                    <?php
                                    $sql="SELECT * FROM `state`";
                                    $result=mysqli_query($conn,$sql);
                                    
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        echo "<option value='".$row['State']."'>".$row['State']."</option>";
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Pincode</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pincode" required minlength="6" maxlength="6">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="inputImage" class="col-sm-2 col-form-label">Trainer Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Add Trainer</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include_once("partials/_footer.php"); ?>
    <script>
        function validateName(event){
            const input = event.key;
            if(/\d/.test(input)){
                event.preventDefault();
            }
        }
    </script>

</body>

</html>