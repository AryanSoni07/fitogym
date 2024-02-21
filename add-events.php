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
  $eventExist="false";
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
      $name=$_POST['name'];
      $venue=$_POST['venue'];
      $description=$_POST['description'];
      $Edate=$_POST['Edate'];
      $Etime=$_POST['Etime'];

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


      
        
        $tid=$_SESSION['UID'];
        $sql2="SELECT `Trainer_ID` FROM `trainer_tbl` WHERE `trainer_tbl`.`UID`=$tid";
        $result2=mysqli_query($conn, $sql2);
        $row2=mysqli_fetch_assoc($result2);
        $trainerID=$row2['Trainer_ID'];

          $sql="INSERT INTO `event_tbl`(`Trainer_ID`, `Event_Name`, `Venue`, `Event_Description`, `Event_Image`, `Event_Date`, `Event_Time`) VALUES ('$trainerID','$name','$venue','$description','$image','$Edate','$Etime')";
          
          $result=mysqli_query($conn,$sql);
          if($result)
          {
              $eventExist="true";
          }
          else{
              $eventExist="Error";
          }
      
  } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Add Event</title>
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
        if($eventExist=="true")
        {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Event Added Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($eventExist=="Exist")
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          This Event ID is already Used!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        elseif($eventExist=="Error")
        {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Error in adding Event!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
      ?>
        <div class="pagetitle">
            <h1>Add Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Event</li>
                    <li class="breadcrumb-item active"><a href="add-events.php">Add Event</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Event Details</h5>
                        <!-- General Form Elements -->
                        <form action="add-events.php" enctype="multipart/form-data" method="post">
                           
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Event Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Venue</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="venue" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">
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
                                <label for="inputText" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="Edate" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Time</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control" name="Etime" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Add Event</button>
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