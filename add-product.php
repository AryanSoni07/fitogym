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
  $productExist="false";
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
      $id=$_POST['id'];
      $category=$_POST['category'];
      $name=$_POST['name'];
      $description=$_POST['description'];
      $price=$_POST['price'];
     
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
    
    $destination = __DIR__ . "/images/products/" . $filename;
    
    $image="/fitogym/ADMIN/images/products/".$filename;
    // echo $destination;
    
    // Add a numeric suffix if the file already exists
    $i = 1;
    
    while (file_exists($destination)) {
    
        $filename = $base . "($i)." . $pathinfo["extension"];
        $destination = __DIR__ . "/images/products/" . $filename;
        $image="/fitogym/ADMIN/images/products/".$filename;
        $i++;
    }
    
    if ( ! move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
    
        exit("Can't move uploaded file");
    
    }
   

      $existProduct="SELECT * FROM `product_details_tbl` WHERE `product_details_tbl`.`Product_ID`='$id'";
      $result=mysqli_query($conn,$existProduct);
      $numExist=mysqli_num_rows($result);
      
      if($numExist > 0)
      {
          $productExist="Exist";
      }
      else{
          $sql="INSERT INTO `product_details_tbl`(`Product_ID`, `Category_ID`, `Product_Name`, `Product_Description`, `Product_Price`, `Product_Image`) VALUES ('$id','$category','$name','$description','$price','$image')";
          
          $result=mysqli_query($conn,$sql);
          if($result)
          {
              $productExist="true";
          }
          else{
              $productExist="Error";
          }
      }
  } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add Product</title>
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
        if($productExist=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Product Added Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($productExist=="Exist")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          This Product ID is already Used!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        elseif($productExist=="Error")
        {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Error in adding Product!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
      ?>
    <div class="pagetitle">
      <h1>Add New Product</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Products</li>
          <li class="breadcrumb-item active"><a href="add-product.php">Add New Product</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
      <div class="row">
      <div class="card">
            <div class="card-body">
            <h5 class="card-title">Product Details</h5>
              <!-- General Form Elements -->
              <form action="add-product.php" enctype="multipart/form-data" method="post">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Product ID</label>
                  <div class="col-sm-10">
                  <?php
                                $catsql="SELECT * FROM `product_details_tbl`";
                                $catresult=mysqli_query($conn,$catsql);
                                $catnum=mysqli_num_rows($catresult);
                                $catnum+=1;
                                $catid="PR_00".$catnum;
                                ?>
                    <input type="text" class="form-control" name="id" value="<?php echo $catid; ?>" readonly required >
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Product Category</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="category">
                      <option selected>---Select Category---</option>
                      <?php
                      $sql="SELECT * FROM `category_tbl`";
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_assoc($result))
                      {
                        echo "<option value='".$row['Category_ID']."'>".$row['Category_Name']."</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Product Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Product Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="description" style="height: 100px" required></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Product Price (in ₹)</label>
                  <div class="col-sm-10">
                    <input type="text" name="price" pattern="[0-9]*" title="Please enter only digits" class="form-control" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" name="image" class="col-sm-2 col-form-label">Product Image</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="image" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add Product</button>
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