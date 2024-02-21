<?php 
session_start();
if(isset($_SESSION['UID']))
{
   //echo $_SESSION['UID']; 
  // echo $_SESSION['Type'];
}
else{
  header("refresh:1; url=/fitogym/login.php");
}

include_once("partials/_dbconnect.php"); ?>
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
    <?php include_once("partials/_header.php"); 
        include_once("partials/_a_main.php");
  ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Blogs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Blogs</li>
                    <li class="breadcrumb-item active"><a href="view-my-blogs.php">My Blogs</a></li>
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
                                    <th scope="col">Blog_ID</th>
                                    <th scope="col">UID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Blog_Description</th>
                                    <th scope="col">Blog_Image</th>
                                    <th scope="col">Blog_Date</th>
                                    <th scope="col">Blog_Time</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                  $sql="SELECT * FROM `blogs_tbl` WHERE `blogs_tbl`.`UID`=$_SESSION[UID]";
                  $result=mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_assoc($result))
                  {
                    echo "<tr>
                      <td scope='col'>".$row['Blog_ID']."</td>
                      <td scope='col'>".$row['UID']."</td>
                      <td scope='col'>".$row['Blog_Title']."</td>
                      <td scope='col'>".$row['Blog_Description']."</td>
                      <td><img src='".$row['Blog_Image']."'  width='100%' ></td>
                      <td scope='col'>".$row['Date']."</td>
                      <td scope='col'>".$row['Time']."</td>
                      <td><a href='update-blog.php?bid=".$row['Blog_ID']."'><button type='button' class='btn btn-outline-primary'>Update</button></a></td>
                    </tr>";
                  }
                  ?>
                                </tr>
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