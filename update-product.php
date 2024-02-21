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
    $productUpdate="false";
    if(isset($_GET['pid']))
    {
        $pid=$_GET['pid'];
        $sql="SELECT * FROM `product_details_tbl` WHERE Product_ID='$pid'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $pname=$row["Product_Name"];
        $catid=$row["Category_ID"];
        $pdescription=$row["Product_Description"];
        $price=$row['Product_Price'];
        $pimage=$row["Product_Image"];
        $status=$row["Status"];
    }  
    elseif($_SERVER['REQUEST_METHOD']=="POST")
    {
        $pid=$_POST['id'];
        $catid=$_POST['category'];
        $pname=$_POST['name'];
        $pdescription=$_POST['description'];
        $price=$_POST['price'];
        $status=$_POST['status'];

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
     
  
            $sql="UPDATE `product_details_tbl` SET `Product_ID`='$pid',`Category_ID`='$catid',`Product_Name`='$pname',`Product_Description`='$pdescription',`Product_Price`='$price',`Product_Image`='$image' WHERE `Product_ID`='$pid'";
            
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $productUpdate="true";
            }
            else{
                $productUpdate="Error";
            }
        
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <?php
include_once("partials/_links.php");
?>
</head>
<body>
<?php include_once("partials/_header.php");
    include_once("partials/_a_main.php"); ?>
<main id="main" class="main">
    <?php
        if($productUpdate=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Product Details Updated Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($productUpdate=="Error")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          Error in Updating Product Details!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        // elseif($productUpdate=="false")
        // {
        //   echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //   Error in Updating Product Details!
        //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        //       </div>';
        // }
    ?>
<div class="pagetitle">
      <h1>Update Product Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Products</li>
          <li class="breadcrumb-item active"><a href="view-product.php">View Product</a></li>
          <li class="breadcrumb-item active"><a href="">Update Product</a></li>
        </ol>
      </nav>
    </div>
<div class="row">
      <div class="card">
            <div class="card-body">
            <h5 class="card-title">Product Details</h5>
              <!-- General Form Elements -->
              <form action="update-product.php?id=<?php echo $pid; ?>" enctype="multipart/form-data" method="post">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Product ID</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" readonly name="id" value="<?php echo $pid; ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Product Category</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" value="<?php echo $cat_id; ?>" name="category">
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
                    <input type="text" class="form-control" name="name" value="<?php echo $pname; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Product Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="description" style="height: 100px" required><?php echo $pdescription; ?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Product Price (in ₹)</label>
                  <div class="col-sm-10">
                    <input type="text" name="price" pattern="[0-9]*" title="Please enter only digits" value="<?php echo $price; ?>" class="form-control" required>
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
                  <label for="inputNumber" name="image" class="col-sm-2 col-form-label">Product Image</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" value="<?php echo $pimage; ?>" name="image" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Update Product Details</button>
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