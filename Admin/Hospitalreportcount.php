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
                            <h4 class="mb-0">Hospitalvise Report Count</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button type='button' id='btngetReport' class='btn btn-primary'>Get Report</button>
                                <button type='button' id='btnExport' class='btn btn-primary'>Export</button>
                            </div>
                            <div class="col-md-12 table-responsive mt-3">
                                <table id='dataTable' class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td colspan='6'>
                                                <h1>Hospitalvise Report Count</h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Hospital ID</th>
                                            <th>Hospital Name</th>
                                            <th>Address</th>
                                            <th>Number of Reports</th>
                                        </tr>
                                    </thead>
                                    <tbody id='HospitalList'></tbody>
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
            name: `HospitalReportCount.xlsx`,
            sheet: {
                name: 'HospitalReportCount'
            }
        });
    });

    $("#btngetReport").click(function() {
            $.ajax({
                url: "../Controllers/HospitalController.php?Choice=GetHospitalReports",
                type: "POST",
                data: JSON.stringify({
                }),
                contentType: "app/json",
                success: function(res) {
                    console.log(res);
                    res = JSON.parse(res);
                    res.map(o => {
                        $("#HospitalList").append("<tr class='receipts'><td>" +  o.HospitalId  + "</td><td>" +  o.HospitalName + "</td><td>" +  o.Address + "</td><td>" +  o.Count + "</td></tr>");
                    });
                }
            });
    });
});
</script>

<?php
   include"PageFotter.php";
?>