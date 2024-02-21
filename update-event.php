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
    $eventUpdate="false";
    if(isset($_GET['eid']))
    {
        $eid=$_GET['eid'];
        $sql="SELECT * FROM `event_tbl` WHERE `Event_ID`='$eid'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $name=$row["Event_Name"];
        $venue=$row["Venue"];
        $description=$row["Event_Description"];
        $image=$row["Event_Image"];
        $Edate=$row["Event_Date"];
        $Etime=$row["Event_Time"];
    }  
    elseif($_SERVER['REQUEST_METHOD']=="POST")
    {
        $eid=$_POST["id"];
        $name=$_POST["name"];
        $venue=$_POST["venue"];
        $description=$_POST["description"];
        $Edate=$_POST["Edate"];
        $Etime=$_POST["Etime"];

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
        
        $destination = __DIR__ . "/images/events/" . $filename;
        
        $image="/fitogym/TRAINER/images/events/".$filename;
        // echo $destination;
        
        // Add a numeric suffix if the file already exists
        $i = 1;
        
        while (file_exists($destination)) {
        
            $filename = $base . "($i)." . $pathinfo["extension"];
            $destination = __DIR__ . "/images/events/" . $filename;
        
            $i++;
        }
        
        if ( ! move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
        
            exit("Can't move uploaded file");
        
        }
  
            $sql="UPDATE `event_tbl` SET `Event_ID`=$eid,`Event_Name`='$name',`Venue`='$venue',`Event_Description`='$description',`Event_Image`='$image',`Event_Date`='$Edate', `Event_Time`='$Etime' WHERE `Event_ID`=$eid";
            
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $eventUpdate="true";
            }
            else{
                $eventUpdate="Error";
            }
        
    } 
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <?php
include_once("partials/_links.php");
?>
</head>

<body>
    <?php include_once("partials/_header.php");
    include_once("partials/_a_main.php"); ?>
    <main id="main" class="main">
        <?php
        if($eventUpdate=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Event Updated Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($eventUpdate=="Error")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          Error in Updating Event!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
    ?>
        <div class="pagetitle">
            <h1>Update Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Event</li>
                    <li class="breadcrumb-item active"><a href="view-my-blogs.php">View Events</a></li>
                    <li class="breadcrumb-item active"><a href="#">Update Event</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Event Details</h5>
                    <!-- General Form Elements -->
                    <form action="update-event.php?id=<?php echo $eid; ?>" enctype="multipart/form-data" method="POST">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Event ID</label>
                            <div class="col-sm-10">
                                <input type="number" readonly class="form-control" name="id" value="<?php echo $eid; ?>"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Event Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Event Venue</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="venue" value="<?php echo $venue; ?>"
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
                            <label for="inputText" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="Edate" value="<?php echo $Edate; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Time</label>
                            <div class="col-sm-10">
                            <input type="time" class="form-control" name="Etime" value="<?php echo $Etime; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update Event</button>
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