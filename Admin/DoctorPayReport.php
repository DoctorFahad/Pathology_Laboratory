<?php
   include"PageTop.php";
?>
<form class="content-wraper-area">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Doctor Payment Report</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="date" name='dtFrom' id='dtFrom' max="<?php echo date("Y-m-d"); ?>" class='form-control' />
                            </div>
                            <div class="col-md-4">
                                <input type="date" name='dtTo' id='dtTo' max="<?php echo date("Y-m-d"); ?>" class='form-control' />
                            </div>
                            <div class="col-md-4">
                                <button type='button' id='btngetReport' class='btn btn-primary'>Get Report</button>
                                <button type='button' id='btnExport' class='btn btn-primary'>Export</button>
                            </div>
                            <div class="col-md-12 table-responsive mt-3">
                                <table id='dataTable' class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td colspan='6'>
                                                <h1>Doctor Payment Report</h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='6'>
                                                <strong>Date from <span id='lblFrom'></span> to <span id='lblTo'></span></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>DoctorPay ID</th>
                                            <th>Doctor</th>
                                            <th>Amount</th>
                                            <th>Payment Details</th>
                                            <th>Payment Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id='doctorpayList'></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {

    $("#btnExport").click(function () {
        let table = document.getElementsByTagName("table");
        console.log(table);
        debugger;
        TableToExcel.convert(table[0], {
            name: `DoctorPayReport.xlsx`,
            sheet: {
                name: 'DoctorPayReport'
            }
        });
    });

    $("#btngetReport").click(function() {
        if ($("#dtFrom").val() != "" && $("#dtTo").val() != "") {
            $("#lblFrom").html(setData($("#dtFrom").val()));
            $("#lblTo").html(setData($("#dtTo").val()));
            $.ajax({
                url: "../Controllers/DocPayController.php?Choice=GetDoctorPayReports",
                type: "POST",
                data: JSON.stringify({
                    "dtFrom": $("#dtFrom").val(),
                    "dtTo": $("#dtTo").val()
                }),
                contentType: "app/json",
                success: function(res) {
                    console.log(res);
                    res = JSON.parse(res);
                    res.map(o => {
                        $("#doctorpayList").append("<tr class='receipts'><td>" +  o.DocPayId + "</td><td>" +  o.FullName + "</td><td>" +  o.Amount + "</td><td>" +  o.PayMode + "</td><td>" +  o.PaidDate + "</td></tr>");
                    });
                }
            });
        }
    });
});
</script>

<?php
   include"PageFotter.php";
?>