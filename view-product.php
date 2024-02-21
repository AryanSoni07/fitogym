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
include_once("partials/_dbconnect.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>View Product</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <?php include_once("partials/_links.php"); ?>
</head>

<body>

    <!-- ======= Header ======= -->
    <?php
    include_once("partials/_header.php");
    include_once("partials/_a_main.php");
  ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Products</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Products</li>
                    <li class="breadcrumb-item active"><a href="view-product.php">View Products</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Products</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>ID</b>
                                        </th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                          $sql="SELECT * FROM `product_details_tbl`";
                                          $result=mysqli_query($conn,$sql);

                                        while($row=mysqli_fetch_assoc($result))
                                        {
                                          echo "<tr>
                                            <td>".$row['Product_ID']."</td>
                                            <td>".$row['Product_Name']."</td>
                                            <td>".$row['Product_Description']."</td>
                                            <td>₹".$row['Product_Price']."</td>
                                            <td><img src='".$row['Product_Image']."'  width='125%' ></td>
                                            <td><a href='update-product.php?pid=".$row['Product_ID']."'><button type='button' class='btn btn-outline-primary'>Update</button></a></td>
                                          </tr>";
                                        }
                                      ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

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