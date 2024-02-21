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
    $planUpdate="false";
    if(isset($_GET['planid']))
    {
        $planid=$_GET['planid'];
        $sql="SELECT * FROM `membership_details_tbl` WHERE `Membership_Plan_ID`='$planid'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $planname=$row["Membership_Plan_Name"];
        $plandescription=$row["Membership_Plan_Description"];
        $price=$row["Price"];
        $validity=$row["Validity"];
        $status=$row["Membership_Plan_Status"];
    }  
    elseif($_SERVER['REQUEST_METHOD']=="POST")
    {
        $planid=$_POST['id'];
        $planname=$_POST['name'];
        $plandescription=$_POST['description'];
        $price=$_POST["price"];
        $validity=$_POST["validity"];
        $status=$_POST["status"];
  
            $sql="UPDATE `membership_details_tbl` SET `Membership_Plan_ID`='$planid',`Membership_Plan_Name`='$planname',`Membership_Plan_Description`='$plandescription',`Price`='$price',`Validity`='$validity',`Membership_Plan_Status`='$status' WHERE `Membership_Plan_ID`='$planid'";
            
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $planUpdate="true";
            }
            else{
                $planUpdate="Error";
            }
        
    } 
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update membership Plans</title>
    <?php
include_once("partials/_links.php");
?>
</head>

<body>
    <?php include_once("partials/_header.php");
    include_once("partials/_a_main.php"); ?>
    <main id="main" class="main">
        <?php
        if($planUpdate=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Membership Plan Details Updated Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($planUpdate=="Error")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          Error in Updating Membership Plan Details!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
    ?>
        <div class="pagetitle">
            <h1>Update Membership Plan Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Membership Plans</li>
                    <li class="breadcrumb-item active"><a href="view-plans.php">View Membership Plans</a></li>
                    <li class="breadcrumb-item active"><a href="">Update Membership Plans</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Membership Plan Details</h5>
                    <!-- General Form Elements -->
                    <form action="update-plans.php?id=<?php echo $planid; ?>" method="post">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Membership Plan ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly name="id" value="<?php echo $planid; ?>"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Membership Plan Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="<?php echo $planname; ?>"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Membership Plan
                                Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" style="height: 100px"
                                    required><?php echo $plandescription; ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Validity (in months)</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="validity"
                                    value="<?php echo $validity; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Price (in ₹)</label>
                            <div class="col-sm-10">
                                <input type="text" pattern="[0-9]*" title="Please enter only digits" class="form-control" name="price" value="<?php echo $price; ?>" required>
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
                                <button type="submit" class="btn btn-primary">Update Membership Plan</button>
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