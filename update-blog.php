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
    $blogUpdate="false";
    if(isset($_GET['bid']))
    {
        $bid=$_GET['bid'];
        $sql="SELECT * FROM `blogs_tbl` WHERE `Blog_ID`='$bid'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $title=$row["Blog_Title"];
        $description=$row["Blog_Description"];
        $image=$row["Blog_Image"];
        $Btime=$row["Time"];
        $Bdate=$row["Date"];
    }  
    elseif($_SERVER['REQUEST_METHOD']=="POST")
    {
        $bid=$_POST['id'];
        $title=$_POST['title'];
        $description=$_POST['description'];
        $Btime=$_POST['Btime'];
        $Bdate=$_POST['Bdate'];

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
        
        $destination = __DIR__ . "/images/blogs/" . $filename;
        
        $image="/fitogym/TRAINER/images/blogs/".$filename;
        // echo $destination;
        
        // Add a numeric suffix if the file already exists
        $i = 1;
        
        while (file_exists($destination)) {
        
            $filename = $base . "($i)." . $pathinfo["extension"];
            $destination = __DIR__ . "/images/blogs/" . $filename;
        
            $i++;
        }
        
        if ( ! move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
        
            exit("Can't move uploaded file");
        
        }
  
            $sql="UPDATE `blogs_tbl` SET `Blog_ID`='$bid',`Blog_Title`='$title',`Blog_Description`='$description',`Blog_Image`='$image',`Time`='$Btime',`Date`='$Bdate' WHERE `Blog_ID`='$bid'";
            
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $blogUpdate="true";
            }
            else{
                $blogUpdate="Error";
            }
        
    } 
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Blog</title>
    <?php
include_once("partials/_links.php");
?>
</head>

<body>
    <?php include_once("partials/_header.php");
    include_once("partials/_a_main.php"); ?>
    <main id="main" class="main">
        <?php
        if($blogUpdate=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Blog Updated Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($blogUpdate=="Error")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          Error in Updating Blog!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
    ?>
        <div class="pagetitle">
            <h1>Update Blog</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Blog</li>
                    <li class="breadcrumb-item active"><a href="view-my-blogs.php">View Blogs</a></li>
                    <li class="breadcrumb-item active"><a href="#">Update Blog</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Blog Details</h5>
                    <!-- General Form Elements -->
                    <form action="update-blog.php?id=<?php echo $bid; ?>" enctype="multipart/form-data" method="POST">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Blog ID</label>
                            <div class="col-sm-10">
                                <input type="number" readonly class="form-control" name="id" value="<?php echo $bid; ?>"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Blog Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" value="<?php echo $title; ?>"
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
                            <label for="inputNumber" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image"
                                    value="<?php echo $image; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Time</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" name="Btime" value="<?php echo $Btime; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                            <input type="date" class="form-control" name="Bdate" value="<?php echo $Bdate; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update Blog</button>
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