<?php
session_start();
if (isset($_SESSION['UID'])) {
    // echo $_SESSION['UID'];
    // echo $_SESSION['Type'];
} else {
    header("refresh:1; url=/fitogym/login.php");
}
include_once("partials/_dbconnect.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Payments</title>
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
            <h1>Payments</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active"><a href="payments.php">View Payments</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section contact">

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payments</h5>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Payment ID</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Order_Type</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `payment_details_tbl`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                        <td scope='col'>" . $row['Transaction_ID'] . "</td>
                                        <td scope='col'>" . $row['Order_ID'] . "</td>
                                        <td scope='col'>" . $row['Type'] . "</td>
                                        <td scope='col'>" . $row['Amount'] . "</td>
                                        <td scope='col'>" . $row['Payment_Date'] . "</td>
                                        <td scope='col'>" . $row['Payment_Time'] . "</td>";
                                        if($row['Type']=="Product")
                                        {

                                            echo"<td><a href='view-payment-details.php?oid=".$row['Order_ID']."'><button type='button' class='btn btn-outline-primary'>View Details</button></a></td>";
                                        }
                                        elseif($row['Type']=="Membership")
                                        {

                                            echo"<td><a href='view-payment-detail.php?oid=".$row['Order_ID']."'><button type='button' class='btn btn-outline-primary'>View Details</button></a></td>";
                                        }
                                        echo "</tr>";
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