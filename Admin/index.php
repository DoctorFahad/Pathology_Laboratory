<?php
   include"PageTop.php";
?>
    <form class="content-wraper-area">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-sm-4">
                    <div class="card ">
                        <div class="card-body" data-intro="New Orders">
                            <div class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class="fas fa-receipt"></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5><span id='lblReceipt'></span> Receipt</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card ">
                        <div class="card-body" data-intro="New Orders">
                            <div class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class="fas fa-rupee-sign"></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5><span id='lblCollection'></span> Collectiion</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card ">
                        <div class="card-body" data-intro="New Orders">
                            <div class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class="fas fa-user-doctor"></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5><span id='lblDoctor'></span> Doctors</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card ">
                        <div class="card-body" data-intro="New Orders">
                            <div class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class="fas fa-hospital"></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5><span id='lblHospital'></span> Hospital</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card ">
                        <div class="card-body" data-intro="New Orders">
                            <div class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5><span id='lblPatient'></span> Patient</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card ">
                        <div class="card-body" data-intro="New Orders">
                            <div class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5><span id='lblStaff'></span> Staff</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>  
    <script>
        $(document).ready(function(){
            $.ajax({
                url: "../Controllers/AdminController.php?Choice=getDashboard",
                type: "POST",
                contentType: "app/json",
                success: function(res) {
                    res = JSON.parse(res.trim());
                    $("#lblDoctor").html(res.DocCount);
                    $("#lblReceipt").html(res.RecCount);
                    $("#lblCollection").html(res.TotalRec);
                    $("#lblHospital").html(res.HosCount);
                    $("#lblPatient").html(res.PatientCount);
                    $("#lblStaff").html(res.SaffCount);
                },
                error: function(err) {
                    alert(err.message);
                }
            });
        });
    </script>
<?php
   include"PageFotter.php";
?>





