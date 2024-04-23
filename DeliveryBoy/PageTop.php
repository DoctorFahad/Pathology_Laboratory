<?php
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
?>

<!doctype html>
<html lang="en">


<!-- Mirrored from demo.riktheme.com/fojota/side-menu/elegant-icons.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Jan 2024 11:15:33 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>DeliveryBoy-Precision Lab Solutions</title>
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
    if (getCookie("DBId") == null) {
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
                    <!-- Sidebar Menu -->
                    <nav>
                        <ul class="sidebar-menu" data-widget="tree">
                            <li><a href="Receipt.php"><span style='font-family: Times New Roman'>Home</span></a></li>
                            <li><a href="PickUpList.php"><span style='font-family: Times New Roman'>PickUpList</span></a></li>
                            <li><a href="Delivered.php"><span style='font-family: Times New Roman'>Delivered</span></a></li>
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
                                aria-haspopup="true" aria-expanded="false"> <img
                                    src="../Content/Admin/img/bg-img/Profile.jpg" alt=""></button><strong>Welcome,
                                <span id='lblProfile'></span></strong>
                            <div class="dropdown-menu profile dropdown-menu-right">
                                <!-- User Profile Area -->
                                <div class="user-profile-area">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#DeliveryProfileModel"
                                        class="dropdown-item"><i class="bx bx-user font-15" aria-hidden="true"></i>Change profile</a>
                                    <a data-bs-toggle="modal" data-bs-target="#ChangePassword" class="dropdown-item"><i
                                            class="bx bx-wrench font-15" aria-hidden="true"></i>Change Password</a>
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
                            deleteCookie("FullName");
                            deleteCookie("DBId");
                            window.location.href = "Login.php";
                        }
                    });

                    $("#lblProfile").html(getCookie("FullName"));
                });
                </script>