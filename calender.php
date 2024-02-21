<?php 
session_start();
$hidden=null;
if(isset($_SESSION['UID']))
{
  // echo $_SESSION['UID']; 
  // echo $_SESSION['Type'];
}
else{
  header("refresh:1; url=/fitogym/login.php");
}
include_once("partials/_dbconnect.php"); 
if(isset($_GET['eid']))
{
    $eid=$_GET['eid'];
    $sql="UPDATE `event_tbl` SET `View`='Hide' WHERE `Event_ID`=$eid";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        $hidden=true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Events</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <?php include_once("partials/_links.php"); ?>

</head>

<body>

    <!-- ======= Header ======= -->
    <?php include_once("partials/_header.php"); 
        include_once("partials/_a_main.php");
  ?>
    <!-- End Sidebar-->

    <main id="main" class="main">
    <?php include_once("partials/_header.php"); 
        include_once("partials/_a_main.php");

        if($hidden==true)
        {
            echo "<div class='alert alert-success' role='alert'>
            The event is hidden Successfully!
          </div>"; 
        }
  ?>
        <div class="pagetitle">
            <h1>Events</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active"><a href="calender.php">Events</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
            <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Event Calender</h5>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Event ID</th>
                                    <th scope="col">Trainer ID</th>
                                    <th scope="col">Event Name</th>
                                    <th scope="col">Event Description</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Hide</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql="SELECT * FROM `event_tbl` WHERE View='Show' AND Event_Date>CURRENT_DATE()";
                                    $result=mysqli_query($conn,$sql);
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr>
                                        <td scope='col'>".$row['Event_ID']."</td>
                                        <td scope='col'>".$row['Trainer_ID']."</td>
                                        <td scope='col'>".$row['Event_Name']."</td>
                                        <td scope='col'>".$row['Event_Description']."</td>
                                        <td scope='col'>".$row['Event_Date']."</td>
                                        <td scope='col'>".$row['Event_Time']."</td>
                                        <td scope='col'><a href='?eid=".$row['Event_ID']."' class='btn btn-primary'>Hide</a></td>
                                        </tr>";
                                    }
                                    ?> 
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include_once("partials/_footer.php"); ?>

</body>

</html>