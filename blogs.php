<?php 
session_start();
include_once("partials/_dbconnect.php"); 
$hidden=false;
if(isset($_SESSION['UID']))
{
  // echo $_SESSION['UID']; 
  // echo $_SESSION['Type'];
}
else{
    header("refresh:1; url=/fitogym/login.php");
  }
if(isset($_GET['bid']))
{
    $bid=$_GET['bid'];
    $sql="UPDATE `blogs_tbl` SET `View`='Hide' WHERE `Blog_ID`=$bid";
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

    <title>Blogs</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <?php include_once("partials/_links.php"); ?>

</head>

<body>

    <!-- ======= Header ======= -->
    
    <!-- End Sidebar-->

    <main id="main" class="main">
    <?php include_once("partials/_header.php"); 
        include_once("partials/_a_main.php");

        if($hidden==true)
        {
            echo "<div class='alert alert-success' role='alert'>
            The blog is hidden Successfully!
          </div>"; 
        }
  ?>
        <div class="pagetitle">
            <h1>Blogs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active"><a href="blogs.php">Blogs</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Blogs</h5>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Blog ID</th>
                                    <th scope="col">UID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Blog Description</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Hide</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql="SELECT * FROM `blogs_tbl` WHERE View='Show'";
                                    $result=mysqli_query($conn,$sql);

                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        $uid=$row['UID'];
                                        $sql2="SELECT * FROM user_tbl WHERE UID=$uid";
                                        $result2=mysqli_query($conn,$sql2);
                                        $row2=mysqli_fetch_assoc($result2);
                                        echo "<tr>
                                        <td scope='col'>".$row['Blog_ID']."</td>
                                        <td scope='col'>".$row['UID']."</td>
                                        <td scope='col'>".$row2['Name']."</td>
                                        <td scope='col'>".$row['Blog_Description']."</td>
                                        <td scope='col'>".$row['Date']."</td>
                                        <td scope='col'>".$row['Time']."</td>
                                        <td scope='col'><a href='?bid=".$row['Blog_ID']."' class='btn btn-primary'>Hide</a></td>
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