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
                            <h4 class="mb-0">TestCount Report</h4>
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
                                                <h1>TestCount Report</h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Test ID</th>
                                            <th>Test Name</th>
                                            <th>Cost</th>
                                            <th>Number of Patient</th>
                                        </tr>
                                    </thead>
                                    <tbody id='TestList'></tbody>
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
            name: `TestCountReport.xlsx`,
            sheet: {
                name: 'TestCountReport'
            }
        });
    });

    $("#btngetReport").click(function() {
            $.ajax({
                url: "../Controllers/TestController.php?Choice=GetTestReports",
                type: "POST",
                data: JSON.stringify({
                }),
                contentType: "app/json",
                success: function(res) {
                    console.log(res);
                    res = JSON.parse(res);
                    res.map(o => {
                        $("#TestList").append("<tr class='receipts'><td>" +  o.TestId  + "</td><td>" +  o.TestName + "</td><td>" +  o.Cost + "</td><td>" +  o.Count + "</td></tr>");
                    });
                }
            });
    });
});
</script>

<?php
   include"PageFotter.php";
?>