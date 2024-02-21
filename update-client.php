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
    $trainerUpdate="false";
        $uid=$_GET['uid'];
        $sql="SELECT * FROM `user_tbl` WHERE `UID`=$uid";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $name=$row["Name"];
        $gender=$row["Gender"];
        $dob=$row["DOB"];
        $email=$row["Email"];
        $phone=$row["Phone"];

        $area=$row['Area_Street'];
        $region=$row['Region'];
        $city=$row['City'];
        $state=$row['State'];
        $pincode=$row['Pincode'];

        $image=$row["Image"];
        $status=$row["Status"];
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $uid=$_POST['id'];
        $name=$_POST['name'];
        $gender=$_POST['gender'];
        $dob=$_POST["dob"];
        $email=$_POST["email"];
        $phone=$_POST["phone"];

        $area=$_POST['area'];
        $region=$_POST['region'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        $pincode=$_POST['pincode'];

        $status=$_POST['status'];
            $sql="UPDATE `user_tbl` SET `UID`='$uid',`Name`='$name',`User_Type`='Client',`Gender`='$gender',`DOB`='$dob',`Email`='$email',`Phone`='$phone',`Area_Street`='$area',`Region`='$region',`City`='$city',`Pincode`='$pincode',`State`='$state',`Status`='$status' WHERE `UID`='$uid'";
            
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $trainerUpdate="true";
            }
            else{
                $trainerUpdate="Error";
            }
        
    } 
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Client Details</title>
    <?php
include_once("partials/_links.php");
?>
</head>

<body>
    <?php include_once("partials/_header.php");
    include_once("partials/_a_main.php"); ?>
    <main id="main" class="main">
        <?php
        if($trainerUpdate=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Client Details Updated Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($trainerUpdate=="Error")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          Error in Updating Client Details!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
    ?>
        <div class="pagetitle">
            <h1>Update Client Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Client</li>
                    <li class="breadcrumb-item active"><a href="view-clients.php">View Clients Details</a></li>
                    <li class="breadcrumb-item active"><a href="">Update Client Details</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="card">
            <div class="card-body">
                        <h5 class="card-title">Client Details</h5>
                        <!-- General Form Elements -->
                        <form method="post" action="update-client.php?uid=<?php echo $uid; ?>" >
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">UID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="id" value="<?php echo $uid; ?>" readonly required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="gender">
                                    <option selected value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                        <option value='Male'>Male</option>
                                        <option value='Female'>Female</option>
                                        <option value='Others'>Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phone" required minlength="10" value="<?php echo $phone; ?>" maxlength="10">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" value="<?php echo $email; ?>" name="email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">DOB</label>
                                <div class="col-sm-10">
                                    <input type="date" name="dob" value="<?php echo $dob; ?>" class="form-control">
                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">House No. / Street</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="area" value="<?php echo $area; ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Landmark</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="region" value="<?php echo $region; ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="city" value="<?php echo $city; ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">State</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="state">
                                    <option selected value="<?php echo $row['State']; ?>"><?php echo $row['State']; ?></option>
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
                                    <input type="text" class="form-control" name="pincode" value="<?php echo $pincode; ?>" required minlength="6" maxlength="6">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="status">
                                    <option selected value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update Client Details</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
            </div>
        </div>
        </div>
    </main>
    <?php include_once("partials/_footer.php"); ?>
</body>

</html>