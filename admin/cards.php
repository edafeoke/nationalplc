<?php
session_start();
if (!isset($_SESSION['accountNo'])) {
    header("Location: ../user/login.php");
}

include "../bankConfig.php";
include "../admin/connection.php";
include "../admin/Notification.php";
include "../admin/adminData.php";
/* 

set id from 1 in sql

SET @autoid := 0;
UPDATE login SET ID = @autoid := (@autoid+1);
ALTER TABLE login AUTO_INCREMENT = 1; 

127.0.0.1/skybank/customer_detail/		http://localhost/phpmyadmin/tbl_sql.php?db=skybank&table=customer_detail
 Showing rows 0 -  4 (5 total, Query took 0.0030 seconds.)

SELECT
    DATE(Create_Date) AS DATE,
    COUNT(C_No)
FROM
    customer_detail
GROUP BY
    DATE(Create_Date)



*/





?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Cards <?php echo $bank_name; ?></title>

    <!-- Favicons -->
    <link href="../assets/img/favicon-32x32.png" rel="icon">
    <link href="../assets/img/apple-icon-180x180.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>



    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../admin/css/accounts/OpenAccount.css">

<style>
        .table-bordered>tbody>td>tr,
        .table-bordered>thead>td>tr,
        .table-bordered {
            border-bottom: 0;
            border-top: 0;
        }

        .close {
            float: right;
            font-size: 21px;
            font-weight: 700;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            filter: alpha(opacity=20);
            opacity: .2;
        }

        .close {
            color: #fff;
            opacity: 1;
        }

        /* Style the Image Used to Trigger the Modal */
        .kycImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .kycImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .customodal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .customodal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .customodal-content,
        #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .closebtn {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .closebtn:hover,
        .closebtn:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>

    <!-- Javascrip -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>

<body class="dark_bg">

    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <?php include "./sidebar.php"; ?>
        <!-- /#sidebar-wrapper -->


        <!-- Page Content -->
        <div id="page-content-wrapper">


            <div id="content">

                <div class="container-fluid p-0 px-lg-0 px-md-0">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light gray_bg my-navbar">

                        <!-- Sidebar Toggle (Topbar) -->
                        <div type="button" id="bar" class="nav-icon1 hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                            <span class="light_bg"></span>
                            <span class="light_bg"></span>
                            <span class="light_bg"></span>
                        </div>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - User Information -->
                            <li class="nav-item ">
                                <a class="nav-link " href="#" role="button">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $Admin ?></span>
                                    <img id="AdminDropdown" class="img-profile rounded-circle" src="<?php echo $AdminProfile; ?>">
                                </a>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid px-lg-4 dark_bg light">
                        <div class="row">
                            <div class="col-md-12 mt-lg-4 mt-4">
                                <!-- Page Heading -->
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 light">Verify Debit Cards</h1>
                                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm light btn-custo "><i class="bx bx-log-out-circle ico"></i>
                                        Logout</a> -->
                                </div>


                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card gray_bg">
                                            <div class="card-body ">
                                                <h5 class="card-title light mb-4 "></h5>


                                                <?php

                                                $query = "SELECT * FROM cards WHERE Verified='No'";
                                                $result = mysqli_query($conn, $query) or die("query fail");

                                                if (mysqli_num_rows($result) > 0) {

                                                ?>

                                                    <div class="table-responsive">

                                                        <table id="EditTable" class="table v-middle" style="margin-top: 30px;">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col">#ID</th>
                                                                    <th scope="col">Account No</th>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">D-card No</th>
                                                                    <th scope="col">CVV No</th>
                                                                    <th scope="col">Status</th>
                                                                    <th scope="col">Verify Account</th>
                                                                    <th scope="col">Reject Account</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody class="dark_bg">

                                                                <?php
                                                                while ($row = mysqli_fetch_assoc($result)) {



                                                                ?>
                                                                    <tr>
                                                                        <th class="light" scope="row"><?php echo $row['srNo']; ?></th>

                                                                        <td class="light"><?php echo $row['AccountNo']; ?></td>

                                                                        <td class="light"><?php echo $row['Name']; ?></td>

                                                                        <td class="light"><?php echo $row['CardNo']; ?></td>

                                                                        <td class="light"><?php echo $row['cvv']; ?></td>

                                                                        <td class="light"><?php echo $row['Status']; ?></td>

                                                                        <td class="light">

                                                                            <button id="<?php echo $row['AccountNo']; ?>" class="btn btn-success verify_data"><i class='bx bx-user-check'></i> Verify</button>

                                                                        </td>
                                                                        <td class="light">
                                                                            <button id="<?php echo $row['AccountNo'];
                                                                                        ?>" class="btn btn-danger reject_data"><i class='bx bx-user-x'></i> Reject</button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>

                                                                <?php
                                                                }
                                                            } else {

                                                                ?>
                                                                <h1 class="light" style="text-align: center;">No Debit Card for Verification</h1>

                                                            <?php
                                                            }
                                                            ?>

                                                            </tbody>
                                                        </table>

                                                    </div>

                                                    <!-- Search Table -->


                                            </div>
                                        </div>

                                    </div>


                                </div>


                            </div>

                        </div>

                    </div>


                </div>

                <footer class="footer gray_bg">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            <div class="col-6 text-left">
                                <p class="mb-0">
                                    <a href="../index.php" class="text-muted light"><strong><?php echo $bank_name; ?>
                                        </strong></a> &copy
                                </p>
                            </div>
                            <div class="col-6 text-right">
                                <ul class="list-inline">
                                    <!-- <li class="footer-item">
                                        <a class="text-muted light" href="#">Support</a>
                                    </li>
                                    <li class="footer-item">
                                        <a class="text-muted light" href="#">Help Center</a>
                                    </li> -->
                                    <li class="footer-item">
                                        <a class="text-muted light" href="../privacypolicy.html">Privacy</a>
                                    </li>
                                    <li class="footer-item">
                                        <a class="text-muted light" href="../terms.html">Terms</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>

    <!-- Button trigger modal -->

    <!-- /#wrapper -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    <!-- sweet alert cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>

    <script src="../admin/js/cards.js"></script>
    <script>
        $('#bar').click(function() {
            $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled');

        });

        $("#AdminDropdown").click(function() {
            $(this).popover({

                title: 'Profile Detail',
                html: true,
                container: "body",
                placement: 'bottom',
                content: ` <a href="../admin/logout.php" role="button" class="btn btn-danger nav-link">Logout</a>`

            })


        });
    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>



</body>

</html>