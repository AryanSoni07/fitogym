<?php session_start();
include_once ("partials/_dbconnect.php");
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="TopGym Template">
    <meta name="keywords" content="TopGym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About</title>

    <!-- Google Font -->
    <!-- Css Styles -->
    <?php include_once ("partials/style-links.php"); ?>

</head>

<body>
    <!-- Page Preloder -->
    <!-- Header Section Begin -->
    <?php include_once ("partials/header.php"); ?>
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-area set-bg" data-setbg="images/elements/element-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-content">
                        <h2>About Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Elements Section Begin -->
    <section class="element-section">
        <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="icon-box-title">
                        <h2>FOUNDERS</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-icon-box">
                            <img class="single-icon-box-img" src="images/about1.jpg" alt="">
                        <h5>Aryan Soni</h5>
                        <p>Exercise Diet Faculty</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-icon-box">
                            <img class="single-icon-box-img" src="images/about2.jpg" alt="">
                        <h5>Sneha Kumari</h5>
                        <p>HOD & Nutritionist - FIT-O-GYM Fitness Institute</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-icon-box">
                    <img class="single-icon-box-img" src="images/about3.jpeg" alt="">
                        <h5>Sneha Priya</h5>
                        <p>Sr. Exercise Diet Faculty</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="accordin-elem">
                        <h2>VISION AND MISSION</h2>
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">
                                        Our Vision
                                    </a>
                                </div>
                                <div id="collapseOne" class="collapse"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>FIT-O-GYM believes in people do their best work when they feel like they’re a part of a company with strong values. We believe each employee comes with a diverse experience and it is this diverse experience which sets up apart. Freedom of thought and believe is our core motto.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">
                                        Our Mission
                                    </a>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>FIT-O-GYM has the mission is to build a community of skilled, experienced and empathetic trainers who understand that fitness is a continuous journey and there always in continuous education.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading active">
                                    <a class="active" data-toggle="collapse"
                                        data-target="#collapseThree">
                                        Our Passion
                                    </a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>FIT-O-GYM is a nurturing ground for an individual who is passionate about fitness and wants to embark on the journey of spreading authentic fitness. We believe in promoting and spreading fitness across and providing the required guidance for individuals who wish to excel in this field.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tabs-elem">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab">Pilates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Body Building</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-3" role="tab">Fitness</a>
                            </li>
                        </ul><!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane" id="tabs-1" role="tabpanel">
                                <p>“Physical fitness is the first requisite of happiness.” “It's the mind
                                    itself which shapes the body.” “A man is as young as his spinal column.
                                    ”In addition to your instructor's training and expertise, there are
                                    overhead costs. Good Pilates equipment lasts forever, but it needs to
                                    be maintained regularly, with springs, wheels and straps replaced
                                    routinely whose care will be taken by us.</p>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <p>Bodybuilding is the activity of exerting your muscles to strengthen
                                    them and make them more prominent. Bodybuilding is the sport of developing
                                     one's muscles through hypertrophic exercises. In order to achieve muscle
                                     growth, the athlete progressively overloads muscles through resistance
                                     exercises. The sport of bodybuilding has a distinct focus on aesthetics.</p>
                            </div>
                            <div class="tab-pane active" id="tabs-3" role="tabpanel">
                                <p>Not everyone can wake up every day feeling energized and motivated to put
                                    in the hard work that it takes to stay fit. Science-backed, expert-driven
                                    content to guide your fitness journey. Find your motivation, your movement,
                                     and the resources you need to make fitness a daily routine at FIT-O-GYM.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-80">
                <div class="col-lg-12">
                    <div class="milestone-title">
                        <h2>MILESTONES</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="milestone-counter">
                        <div class="counter-icon">
                            <img src="img/shirt-icon.png" alt="">
                        </div>
                        <?php
                            $sql="SELECT * FROM `member_tbl`";
                            $result=mysqli_query($conn,$sql);
                            $num=mysqli_num_rows($result);
                        ?>
                        <span class="m-counter"><?php echo $num; ?></span>
                        <p>Members</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="milestone-counter">
                        <div class="counter-icon">
                            <img src="img/certify.png" alt="">
                        </div>
                        <?php
                            $sql="SELECT * FROM `user_tbl` WHERE `User_Type`='Trainer'";
                            $result=mysqli_query($conn,$sql);
                            $num=mysqli_num_rows($result);
                        ?>
                        <span class="m-counter"><?php echo $num; ?></span>
                        <p>Trainers</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="milestone-counter">
                        <div class="counter-icon">
                            <img src="img/award-icon.png" alt="">
                        </div>
                        <?php
                            $sql="SELECT * FROM `membership_details_tbl`";
                            $result=mysqli_query($conn,$sql);
                            $num=mysqli_num_rows($result);
                        ?>
                        <span class="m-counter"><?php echo $num; ?></span>
                        <p>Plans</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="milestone-counter">
                        <div class="counter-icon">
                            <img src="img/footer-icon.png" alt="">
                        </div>
                        <?php
                            $sql="SELECT * FROM `product_details_tbl`";
                            $result=mysqli_query($conn,$sql);
                            $num=mysqli_num_rows($result);
                        ?>
                        <span class="m-counter"><?php echo $num; ?></span>
                        <p>Products</p>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <!-- Elements Section End -->

    <!-- Footer Section Begin -->
    <?php include_once ("partials/footer.php"); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include_once ("partials/js-links.php"); ?>

</body>

</html>
