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
  $categoryExist="false";
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
      $id=$_POST['id'];
      $name=$_POST['name'];
      $description=$_POST['description'];

      $existCategory="SELECT * FROM `category_tbl` WHERE `category_tbl`.`Category_ID`='$id'";
      $result=mysqli_query($conn,$existCategory);
      $numExist=mysqli_num_rows($result);
      
      if($numExist > 0)
      {
          $categoryExist="Exist";
      }
      else{
          $sql="INSERT INTO `category_tbl`(`Category_ID`, `Category_Name`, `Category_Description`) VALUES ('$id','$name','$description')";
          
          $result=mysqli_query($conn,$sql);
          if($result)
          {
              $categoryExist="true";
          }
          else{
              echo "Error in Adding product";
              $categoryExist="Error";
          }
      }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add Category</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <?php include_once("partials/_links.php"); ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php
    include_once("partials/_header.php");
    include_once("partials/_a_main.php");
  ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

  <?php
        if($categoryExist=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Category Added Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($categoryExist=="Exist")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          This Category ID is already Used!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        elseif($categoryExist=="Error")
        {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Error in adding Category!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
      ?>
    <div class="pagetitle">
      <h1>Add Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Categories</li>
          <li class="breadcrumb-item active"><a href="add-category.php">Add New Category</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
      <div class="card">
            <div class="card-body">
            <h5 class="card-title">Category Details</h5>
              <!-- General Form Elements -->
              <form action="add-category.php" method="post">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Category ID</label>
                  <div class="col-sm-10">
                    <?php
                      $catsql="SELECT * FROM `category_tbl`";
                      $catresult=mysqli_query($conn,$catsql);
                      $catnum=mysqli_num_rows($catresult);
                      $catnum+=1;
                      $catid="CAT_00".$catnum;
                    ?>
                    <input type="text" readonly class="form-control" name="id" value="<?php echo $catid; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Category Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Category Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="description" style="height: 100px" required></textarea>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add Category</button>
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

</body>

</html>