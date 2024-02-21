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
    $categoryUpdate="false";
    if(isset($_GET['catid']))
    {
        $catid=$_GET['catid'];
        $sql="SELECT * FROM `category_tbl` WHERE `Category_ID`='$catid'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $catname=$row["Category_Name"];
        $catdescription=$row["Category_Description"];
    }  
    elseif($_SERVER['REQUEST_METHOD']=="POST")
    {
        $catid=$_POST['id'];
        $catname=$_POST['name'];
        $catdescription=$_POST['description'];
  
            $sql="UPDATE `category_tbl` SET `Category_ID`='$catid',`Category_Name`='$catname',`Category_Description`='$catdescription' WHERE `Category_ID`='$catid'";
            
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $categoryUpdate="true";
            }
            else{
                $categoryUpdate="Error";
            }
        
    } 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <?php
include_once("partials/_links.php");
?>
</head>
<body>
<?php include_once("partials/_header.php");
    include_once("partials/_a_main.php"); ?>
<main id="main" class="main">
    <?php
        if($categoryUpdate=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Category Details Updated Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($categoryUpdate=="Error")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          Error in Updating Category Details!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
    ?>
<div class="pagetitle">
      <h1>Update Category Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Products</li>
          <li class="breadcrumb-item active"><a href="view-categories.php">View Categories</a></li>
          <li class="breadcrumb-item active"><a href="">Update Category</a></li>
        </ol>
      </nav>
    </div>
<div class="row">
<div class="card">
            <div class="card-body">
            <h5 class="card-title">Category Details</h5>
              <!-- General Form Elements -->
              <form action="update-category.php?id=<?php echo $catid; ?>" method="post">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Category ID</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="id" readonly value="<?php echo $catid; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Category Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="<?php echo $catname; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Category Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="description" style="height: 100px" required><?php echo $catdescription; ?></textarea>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Update Category Details</button>
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