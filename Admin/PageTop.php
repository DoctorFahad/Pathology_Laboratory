<?php
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    $Con = mysqli_connect("localhost", "root", "", "pathologylab_db");
?>

<!doctype html>
<html lang="en">


<!-- Mirrored from demo.riktheme.com/fojota/side-menu/elegant-icons.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Jan 2024 11:15:33 GMT -->

<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>Admin-Precision Lab Solutions</title>
    <!-- Favicon -->
    <link rel="icon" href="../Content/Admin/img/core-img/favicon.ico">
    <!-- Plugins File -->
    <link rel="stylesheet" href="../Content/Admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Content/Admin/css/animate.css">

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="../Content/Admin/style.css">

    <script src="../Content/Admin/datatable/jquery-3.7.0.js"></script>
    <script src="../Content/Admin/datatable/jquery.dataTablesjs.min.js"></script>
    <link rel="stylesheet" href="../Content/Admin/datatable/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../Content/Admin/fontawesome/css/all.css">

    <script src="../Content/Admin/dropdowne/select2.min.js"></script>
    <link rel="stylesheet" href="../Content/Admin/dropdowne/select2.min.css">
    <script src="../Content/Admin/Cookie.js"></script>
    <script src="../Content/Admin/Validation.js"></script>


    <script>
    if (getCookie("AdminId") == null) {
        window.location.href = "Login.php";
    }
    </script>

    <style>
    .toast-container {
        width: inherit;
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #333;
        color: #fff;
        padding: 8px;
        border-radius: 5px;
        display: none;
    }

    .toast-message {
        font-size: 15px;
    }

    .form-control {
        border: 2px solid black;
    }

    .error {
        color: red;
        font-weight: bold;
    }
    </style>
    <script src="../Content/Admin/script.js"></script>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-book">
            <div class="inner">
                <div class="left"></div>
                <div class="middle"></div>
                <div class="right"></div>
            </div>
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
    <!-- /Preloader -->

    <!-- ======================================
******* Page Wrapper Area Start **********
======================================= -->
    <div class="flapt-page-wrapper">
        <!-- Sidemenu Area -->
        <div class="flapt-sidemenu-wrapper">
            <!-- Desktop Logo -->
            <div class="flapt-logo text-center" style='height: 30px;'>
                <br>
                <strong style='font-size: 20px; color:white'>𝐏𝐫𝐞𝐜𝐢𝐬𝐢𝐨𝐧 𝐋𝐚𝐛<br />𝐒𝐨𝐥𝐮𝐭𝐢𝐨𝐧𝐬</strong>
            </div>

            <!-- Side Nav -->
            <div class="flapt-sidenav" id="flaptSideNav" style='margin-top: -45px'>
                <!-- Side Menu Area -->
                <div class="side-menu-area">
                    <nav>
                        <ul class="sidebar-menu" data-widget="tree">
                            <li><a href="index.php"><span style='font-family: Times New Roman'>Home</span></a></li>
                            <li><a href="Hospital.php"><span style='font-family: Times New Roman'>Hospital</span></a>
                            </li>
                            <li><a href="Doctor.php"><span style='font-family: Times New Roman'>Doctor</span></a></li>
                            <li><a href="Patient.php"><span style='font-family: Times New Roman'>Patient</span></a></li>
                            <li><a href="Test.php"><span style='font-family: Times New Roman'>Test</span></a>
                            </li>
                            <li><a href="Collections.php"><span
                                        style='font-family: Times New Roman'>Collections</span></a></li>
                            <li><a href="Delivered.php"><span style='font-family: Times New Roman'>Delivered</span></a>
                            </li>
                            <li><a href="Ontheway.php"><span style='font-family: Times New Roman'>Ontheway</span></a>
                            </li>
                            <li class="treeview">
                                <a href="javascript:void(0)"><span style='font-family: Times New Roman'>Staff</span></a>
                                <ul class="treeview-menu">
                                    <li><a href="Staff.php"><span
                                                style='font-family: Times New Roman'>HospitalStaff</span></a></li>
                                    <li><a href="DeliveryBoy.php"><span
                                                style='font-family: Times New Roman'>DeliveryBoy</span></a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="javascript:void(0)"><span
                                        style='font-family: Times New Roman'>Receipt</span></a>
                                <ul class="treeview-menu">
                                    <li><a href="Receipt.php"><span style='font-family: Times New Roman'>Create
                                                Receipt</span></a></li>
                                    <li><a href="ReceiptList.php"><span style='font-family: Times New Roman'>Receipt
                                                List</span></a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="javascript:void(0)"><span
                                        style='font-family: Times New Roman'>Reports</span></a>
                                <ul class="treeview-menu">
                                    <li><a href="ReceiptReport.php"><span
                                                style='font-family: Times New Roman'>ReceiptReport</span></a></li>
                                    <li><a href="DoctorPayReport.php"><span
                                                style='font-family: Times New Roman'>DoctorPaymentReport</span></a></li>
                                    <li><a href="TestReport.php"><span
                                                style='font-family: Times New Roman'>TestCountReport</span></a></li>
                                    <li><a href="PatientVisits.php"><span
                                                style='font-family: Times New Roman'>PatientVisits</span></a></li>
                                    <li><a href="DoctorReference.php"><span
                                                style='font-family: Times New Roman'>DoctorReference</span></a></li>
                                    <li><a href="Hospitalreportcount.php"><span
                                                style='font-family: Times New Roman'>Hospitalvise Report Count</span></a></li>            
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="flapt-page-content">
            <!-- Top Header Area -->
            <header class="top-header-area d-flex align-items-center justify-content-between">
                <div class="left-side-content-area d-flex align-items-center">
                    <!-- Mobile Logo -->
                    <div class="mobile-logo">
                        <a href="index-2.html"><img src="../Content/Admin/img/core-img/small-logo.png"
                                alt="Mobile Logo"></a>
                    </div>

                    <!-- Triggers -->
                    <div class="flapt-triggers">
                        <div class="menu-collasped" id="menuCollasped">
                            <i class='bx bx-grid-alt'></i>
                        </div>
                        <div class="mobile-menu-open" id="mobileMenuOpen">
                            <i class='bx bx-grid-alt'></i>
                        </div>
                    </div>
                </div>

                <div class="right-side-navbar d-flex align-items-center justify-content-end">
                    <!-- Mobile Trigger -->
                    <div class="right-side-trigger" id="rightSideTrigger">
                        <i class='bx bx-menu-alt-right'></i>
                    </div>

                    <!-- Top Bar Nav -->
                    <ul class="right-side-content d-flex align-items-center">
                        <li class="nav-item dropdown">
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="../Content/Admin/img/bg-img/Profile.jpg" alt=""></button><strong>Welcome,
                                <span id='lblProfile'></span></strong>
                            <div class="dropdown-menu profile dropdown-menu-right">
                                <!-- User Profile Area -->
                                <div class="user-profile-area">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#AdminProfileModel"
                                        class="dropdown-item"><i class="bx bx-user font-15" aria-hidden="true"></i> My
                                        profile</a>
                                    <a data-bs-toggle="modal" data-bs-target="#ChangePassword" class="dropdown-item"><i
                                            class="bx bx-wrench font-15" aria-hidden="true"></i> ChangePassword</a>
                                    <a href="#" class="dropdown-item" id="logout"><i class="bx bx-power-off font-15"
                                            aria-hidden="true"></i> Sign-out</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>

            <div class="main-content">
                <script>
                $(document).ready(function() {
                    $("#logout").click(function() {
                        // Set expiration time in the past to expire the cookies

                        if (confirm("Are you sure want to logout")) {
                            deleteCookie("AdminFullName");
                            deleteCookie("AdminId");
                            window.location.href = "Login.php";
                        }
                    });

                    $("#lblProfile").html(getCookie("AdminFullName"));

                });
                </script>