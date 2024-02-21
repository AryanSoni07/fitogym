<?php
session_start();
if (isset($_SESSION['UID'])) {
    // echo $_SESSION['UID'];
    // echo $_SESSION['Type'];
} else {
    header("refresh:1; url=/fitogym/login.php");
}
include_once("partials/_dbconnect.php"); 
if(isset($_GET['oid']))
{
    $oid=$_GET['oid'];
    $sql="SELECT UID FROM `order_tbl` WHERE Order_ID=$oid";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $uid=$row['UID'];
    $sql="SELECT * FROM `user_tbl` WHERE UID=$uid";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $name=$row['Name'];
    $sql="SELECT Membership_Plan_ID FROM `membership_order_tbl` WHERE Order_ID=$oid";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $pid=$row['Membership_Plan_ID'];
}
?>

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
            <h1>Payment Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active"><a href="payments.php">View Payments</a></li>
                    <li class="breadcrumb-item active"><a href="view-payment-details.php">View Payment Details</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section contact">

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payment Details</h5>
                        <?php
                            // echo '$uid';
                            // echo '$name';
                            echo "
                            <div>
                            <strong>Order ID</Strong> : $oid
                        </div>
                        <div>
                            <strong>User ID</Strong> : $uid
                        </div>
                        <div>
                            <strong>Name</Strong> : $name
                        </div>";
                        ?>
                        
                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Membership Plan ID</th>
                                    <th scope="col">Membership Name</th>
                                    <th scope="col">Amount Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `membership_details_tbl` WHERE `membership_details_tbl`.`Membership_Plan_ID`='$pid'";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    
                                    echo "<tr>
                                        <td scope='col'>" . $row['Membership_Plan_ID'] . "</td>
                                        <td scope='col'>" . $row['Membership_Plan_Name'] . "</td>
                                        <td scope='col'>₹" . $row['Price'] . "</td>
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