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
  $tutorialExist="false";
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
      $name=$_POST['name'];
      $description=$_POST['description'];
      $Tdate=$_POST['Tdate'];

    //   image upload 
      if ($_FILES["image"]["size"] > 10485760) {
        exit('File too large (max 10MB)');
    }
    
    // Use fileinfo to get the mime type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($_FILES["image"]["tmp_name"]);
    
    $mime_types = ["image/gif", "image/png", "image/jpeg", "image/jpg"];
            
    if ( ! in_array($_FILES["image"]["type"], $mime_types)) {
        echo $_FILES["image"]["type"];
        exit("Invalid file type in image");
    }
    
    // Replace any characters not \w- in the original filename
    $pathinfo = pathinfo($_FILES["image"]["name"]);
    
    $base = $pathinfo["filename"];
    
    $base = preg_replace("/[^\w-]/", "_", $base);
    
    $filename = $base . "." . $pathinfo["extension"];
    
    $destination = __DIR__ . "/images/tutorials/" . $filename;
    
    $image="/fitogym/TRAINER/images/tutorials/".$filename;
    // echo $destination;
    
    // Add a numeric suffix if the file already exists
    $i = 1;
    
    while (file_exists($destination)) {
    
        $filename = $base . "($i)." . $pathinfo["extension"];
        $destination = __DIR__ . "/images/tutorials/" . $filename;
    
        $i++;
    }
    
    if ( ! move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
    
        exit("Can't move uploaded file");
    
    }
    // image upload over 


    // video upload
    if ($_FILES["link"]["size"] > 104857600) {
        exit('File too large (max 100MB)');
    }
    
    // Use fileinfo to get the mime type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($_FILES["link"]["tmp_name"]);
    
    $mime_types = ["video/mp4", "video/mov", "video/mkv"];
            
    if ( ! in_array($_FILES["link"]["type"], $mime_types)) {
        echo $_FILES["link"]["type"];
        exit("Invalid file type in video");
    }
    
    // Replace any characters not \w- in the original filename
    $pathinfo = pathinfo($_FILES["link"]["name"]);
    
    $base = $pathinfo["filename"];
    
    $base = preg_replace("/[^\w-]/", "_", $base);
    
    $filename = $base . "." . $pathinfo["extension"];
    
    $destination = __DIR__ . "/images/tutorials/" . $filename;
    
    $link="/fitogym/TRAINER/images/tutorials/".$filename;
    // echo $destination;
    
    // Add a numeric suffix if the file already exists
    $i = 1;
    
    while (file_exists($destination)) {
    
        $filename = $base . "($i)." . $pathinfo["extension"];
        $destination = __DIR__ . "/images/tutorials/" . $filename;
        $link="/fitogym/TRAINER/images/tutorials/".$filename;
        $i++;
    }
    
    if ( ! move_uploaded_file($_FILES["link"]["tmp_name"], $destination)) {
    
        exit("Can't move uploaded file");
    
    }

    // video upload over 

      
          $uid=$_SESSION['UID'];
          $sqltrainer="SELECT * FROM `trainer_tbl` WHERE `UID`=$uid";
          $resulttrainer=mysqli_query($conn,$sqltrainer);
          $row=mysqli_fetch_assoc($resulttrainer);
          $tid=$row['Trainer_ID'];
          $sql="INSERT INTO `tutorial_details_tbl`(`Trainer_ID`, `Tutorial_Name`, `Description`, `Tutorial_Image`, `Tutorial_Link`, `Tutorial_Date`) VALUES ($tid,'$name','$description','$image','$link','$Tdate')";
          
          $result=mysqli_query($conn,$sql);
          if($result)
          {
              $tutorialExist="true";
          }
          else{
            echo "Error : ".mysqli_error($conn);
              $tutorialExist="Error";
          }
      
  } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Add Tutorial</title>
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
        if($tutorialExist=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Tutorial Added Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($tutorialExist=="Exist")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          This Tutorial ID is already Used!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        elseif($tutorialExist=="Error")
        {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Error in adding tutorial!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
      ?>
        <div class="pagetitle">
            <h1>Add Tutorial</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Tutorial</li>
                    <li class="breadcrumb-item active"><a href="add-plans.php">Add Tutorial</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tutorial Details</h5>
                        <!-- General Form Elements -->
                        <form action="add-tutorials.php" enctype="multipart/form-data" method="post">
                            
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Tutorial Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Tutorial
                                    Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" style="height: 100px"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Tutorial</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="link" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="Tdate" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Add Tutorial</button>
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