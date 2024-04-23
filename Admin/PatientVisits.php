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
                            <h4 class="mb-0">Patient Visits</h4>
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
                                            <td colspan='7'>
                                                <h1>Patient Visits</h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Patient Id</th>
                                            <th>Patient</th>
                                            <th>Contact No.</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>Email</th>
                                            <th>Number Of Visits</th>
                                        </tr>
                                    </thead>
                                    <tbody id='patientvisitList'></tbody>
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
            name: `PatientVisits.xlsx`,
            sheet: {
                name: 'PatientVisits'
            }
        });
    });

    $("#btngetReport").click(function() {
            $.ajax({
                url: "../Controllers/PatientController.php?Choice=GetPatientVisits",
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
                        $("#patientvisitList").append("<tr class='receipts'><td>" +  o.PatientId + "</td><td>" +  o.FullName + "</td><td>" +  o.ContactNo + "</td><td>" +  o.Gender + "</td><td>" +  o.DOB + "</td><td>" +  o.Email + "</td><td>" +  o.Count + "</td></tr>");
                    });
                }
            });
    });
});
</script>

<?php
   include"PageFotter.php";
?>