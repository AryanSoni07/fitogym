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
    $tutorialUpdate="false";
    if(isset($_GET['tid']))
    {
        $tid=$_GET['tid'];
        $sql="SELECT * FROM `tutorial_details_tbl` WHERE `Tutorial_ID`='$tid'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $name=$row["Tutorial_Name"];
        $description=$row["Description"];
        $image=$row["Tutorial_Image"];
        $link=$row["Tutorial_Link"];
        $Tdate=$row["Tutorial_Date"];
    }  
    elseif($_SERVER['REQUEST_METHOD']=="POST")
    {
        $tid=$_POST['id'];
        $name=$_POST['name'];
        $description=$_POST['description'];
        $Tdate=$_POST['Tdate'];
  
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
        if ($_FILES["link"]["size"] > 36700160) {
            exit('File too large (max 35MB)');
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
    

            $sql="UPDATE `tutorial_details_tbl` SET `Tutorial_ID`='$tid',`Tutorial_Name`='$name',`Description`='$description',`Tutorial_Image`='$image',`Tutorial_link`='$link',`Tutorial_Date`='$Tdate' WHERE `Tutorial_ID`='$tid'";
            
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $tutorialUpdate="true";
            }
            else{
                $tutorialUpdate="Error";
            }
        
    } 
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tutorial</title>
    <?php
include_once("partials/_links.php");
?>
</head>

<body>
    <?php include_once("partials/_header.php");
    include_once("partials/_a_main.php"); ?>
    <main id="main" class="main">
        <?php
        if($tutorialUpdate=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Tutorial Updated Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($tutorialUpdate=="Error")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          Error in Updating Tutorial!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
    ?>
        <div class="pagetitle">
            <h1>Update Tutorial</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Tutorial</li>
                    <li class="breadcrumb-item active"><a href="view-my-blogs.php">View Tutorials</a></li>
                    <li class="breadcrumb-item active"><a href="#">Update Tutorial</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tutorial Details</h5>
                    <!-- General Form Elements -->
                    <form action="update-tutorial.php?id=<?php echo $tid; ?>" enctype="multipart/form-data" method="POST">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Tutorial ID</label>
                            <div class="col-sm-10">
                                <input type="number" readonly class="form-control" name="id" value="<?php echo $tid; ?>"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Blog Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" style="height: 100px"
                                    required><?php echo $description; ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Image Link</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image"
                                    value="<?php echo $image; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Link</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="link" value="<?php echo $link; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                            <input type="date" class="form-control" name="Tdate" value="<?php echo $Tdate; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update Tutorial</button>
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