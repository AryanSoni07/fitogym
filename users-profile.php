<?php include_once("partials/_dbconnect.php"); 
session_start();
$hidden=null;
$cperror=null;
$perror=null;
$uid= $_SESSION['UID'];
if(isset($_SESSION['UID']))
  {
    // echo $_SESSION['UID'];
    // echo $_SESSION['Type'];
  }
  else{
    header("refresh:1; url=/fitogym/login.php");
  }
  include_once("partials/_dbconnect.php"); 
  if(isset($_POST['password']))
  {
    $uid= $_SESSION['UID'];
    $password=$_POST['password'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['renewpassword'];
    $sql="SELECT * FROM `user_tbl` WHERE `user_tbl`.`UID`=$uid";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
      if(password_verify($password,$row['Password']))
      {
        if($newpassword==$cpassword)
        {
          $hash=password_hash($newpassword,PASSWORD_DEFAULT);
          $sql="UPDATE `user_tbl` SET `Password`='$hash' WHERE `UID`=$uid";
          $result=mysqli_query($conn,$sql);
          if($result)
          {
            $hidden='password';
          }
        }
        else
        {
          $cperror= "*Password and Confirm Password do not match";
        }
      }
      else
      {
        $perror="*Incorrect Password!";
      }
    
  }
  if(isset($_POST['phone']))
  {
    $uid=$_SESSION['UID'];
    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $area=$_POST['area'];
    $region=$_POST['region'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $pincode=$_POST['pincode'];
    // $image=$_POST['image'];


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
    
    $destination = __DIR__ . "/images/" . $filename;
    
    $image="/fitogym/TRAINER/images/".$filename;
    // echo $destination;
    
    // Add a numeric suffix if the file already exists
    $i = 1;
    
    while (file_exists($destination)) {
    
        $filename = $base . "($i)." . $pathinfo["extension"];
        $destination = __DIR__ . "/images/" . $filename;
    
        $i++;
    }
    
    if ( ! move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
    
        exit("Can't move uploaded file");
    
    }
    
    // echo "File uploaded successfully.";
    


    $sql="UPDATE `user_tbl` SET `Name`='$name',`Gender`='$gender',`DOB`='$dob',`Email`='$email',`Phone`='$phone',`Area_Street`='$area',`Region`='$region',`City`='$city',`Pincode`='$pincode',`State`='$state',`Image`='$image' WHERE UID=$uid";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
      $hidden='profile';
    }
    else{
      echo "Error in updating profile : ".mysqli_error($conn);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Trainer - Trainer</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <?php include_once("partials/_links.php"); ?>
    <style>
    .error {
        color: red;
        margin-left: 25%;
    }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <?php 
    include_once ("partials/_header.php");
    include_once ("partials/_a_main.php");
  ?>
    <!-- End Sidebar-->
    <?php

    $sql="SELECT * FROM `user_tbl` WHERE UID=$uid";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

  ?>
    <main id="main" class="main">
        <?php 
  if($hidden=='profile')
        {
            echo "<div class='alert alert-success' role='alert'>
            The profile is Updated Successfully!
          </div>"; 
        }
        elseif($hidden=='password')
        {
            echo "<div class='alert alert-success' role='alert'>
            The Password is Updated Successfully!
          </div>"; 
        }
  ?>
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active"><a href="users-profile.php">Profile</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="<?php echo $row['Image']; ?>" alt="Profile" class="rounded-circle">
                            <h2><?php echo $row['Name']; ?></h2>
                            <h3><?php echo $row['User_Type']; ?></h3>
                            <!-- <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div> -->
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">


                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['Name']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Job</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['User_Type']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Country</div>
                                        <div class="col-lg-9 col-md-8">India</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $row['Area_Street'].", ".$row['Region'].", ".$row['City'].", ".$row['State'].", ".$row['Pincode']; ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['Phone']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['Email']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Status</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['Status']; ?></div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form method="post" enctype="multipart/form-data" action="users-profile.php">
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="<?php echo $row['Image']; ?>" alt="Profile">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" onkeypress="validateName(event)"
                                                    class="form-control" id="name" value="<?php echo $row['Name']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="gender" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select name="gender" class="form-control" id="gender">
                                                    <option value="<?php echo $row['Gender']; ?> selected">
                                                        <?php echo $row['Gender']; ?></option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="dob" class="col-md-4 col-lg-3 col-form-label">D.O.B</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="dob" type="date" class="form-control" id="dob"
                                                    value="<?php echo $row['DOB']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">House No./ Street</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="area" type="text" maxlength="50" class="form-control" id="area"
                                                    value="<?php echo $row['Area_Street']; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Landmark</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" class="form-control" name="region" id="region" maxlength="20" value="<?php echo $row['Region']; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">City</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" maxlength="20" value="<?php echo $row['City']; ?>" required onkeypress="validateName(event)">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="gender" class="col-md-4 col-lg-3 col-form-label">State</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select name="state" class="form-control" id="state">
                                                <option selected value="<?php echo $row['State']; ?>"><?php echo $row['State']; ?></option>
                                                    <?php
                                                    $sql2="SELECT * FROM `state`";
                                                    $result2=mysqli_query($conn,$sql2);
                                                    while($row2=mysqli_fetch_assoc($result2))
                                                    {
                                                        echo "<option value='".$row2['State']."'>".$row2['State']."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Pincode</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo $row['Pincode']; ?>" pattern="[0-9]*" title="Please enter only digits" minlength="6" maxlength="6">
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone"
                                                    pattern="[0-9]*" title="Please enter only digits"
                                                    value="<?php echo $row['Phone']; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email"
                                                    value="<?php echo $row['Email']; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="image" class="col-md-4 col-lg-3 col-form-label">Image
                                                (Path)</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="image" type="file" class="form-control" id="image"
                                                    value="<?php echo $row['Image']; ?>">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>



                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form action="users-profile.php" method="post">

                                        <div class="row mb-3">
                                            <label for="currentPassword"
                                                class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                    id="currentPassword">
                                            </div>
                                        </div>
                                        <span class="error"><?php echo $perror; ?></span>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="password" class="form-control"
                                                    id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                                New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" type="password" class="form-control"
                                                    id="renewPassword">
                                            </div>
                                        </div>
                                        <span class="error"><?php echo $cperror; ?></span>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include_once("partials/_footer.php"); ?>

    <script>
    function validateName(event) {
        const input = event.key;
        if (/\d/.test(input)) {
            event.preventDefault();
        }
    }
    </script>

</body>

</html>