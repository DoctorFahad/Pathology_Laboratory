<?php
   include"PageTop.php";
   require_once "../DBOperations/DBConfig.php";
?>
<form class="content-wraper-area" method="POST">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">ReportResult Details</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#ReportResultModel"
                                        class='btn btn-dark'>Add ReportResult</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><i>TestId</i></th>
                                                    <th><i>Result</i></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal" id="ReportResultModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add ReportResult</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <b>Test Id</b><span class="error" id="lblTestId">*</span>
                                <select name="txtTestId" id="txtTestId" class="form-control">
                                    <option value="">Select Test</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Result</b><span class="error" id="lblResult">*</span>
                                <input type="text" class="form-control" name="txtResult" id="txtResult">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" id="btnADD">ADD</button>
                <button type="reset" onclick="cancle()" class="btn btn-danger" id="btnCANCLE"
                    data-bs-dismiss="modal">CANCLE</button>
            </div>
        </div>
    </div>
</div>
<script>
var dt = $("#dataTable").DataTable({
    "ajax": {
        "url": "../Controllers/ReportResultController.php?Choice=GetReportResultList",
        "dataSrc": ""
    },
    "columns": [{
            data: "TestId"
        },
        {
            data: "Result"
        },
        {
            data: "ReportId"
        },
        {
            data: "ReportId"
        },
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [{
            'targets': 2,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var DeleteReportResult = 'DeleteReportResult(' + data + ')'
                return "<i class= 'fas fa-trash' onclick='" + DeleteReportResult + "'></i>"
            }
        },
        {
            'targets': 3,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var GetOnlyReportResult = 'GetOnlyReportResult(' + data + ')'
                return "<i class= 'fas fa-edit' onclick='" + GetOnlyReportResult + "'></i>"
            }
        },
        {
            'targets': 0,
            'orderable': false,
        },
        {
            'targets': 1,
            'orderable': false,
        }
    ]
});

$(document).ready(function() {
    $("#btnADD").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtTestId", "lblTestId", Cnt);
        Cnt = IsEmpty("txtResult", "lblResult", Cnt);

        if (Cnt == 0) {
            var Data = {
                "ReportId": $("#txtId").val(),
                "TestId": $("#txtTestId").val(),
                "Result": $("#txtResult").val(),
            };

            $.ajax({
                url: "../Controllers/ReportResultController.php?Choice=AddReportResult",
                type: "POST",
                data: JSON.stringify(Data),
                contentType: "app/json",
                success: function(response) {
                    $("#ReportResultModel").modal("hide");
                    cancle();
                    showToast(response);
                    dt.ajax.reload(null, false);
                }
            });
        }
    });
});

function DeleteReportResult(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/ReportResultController.php?Choice=DeleteReportResult",
            type: "POST",
            data: JSON.stringify({
                "Id": Id
            }),
            contentType: "app/json",
            success: function(response) {
                showToast(response);
                dt.ajax.reload(null, false);
            }
        });
    }
}

function GetOnlyReportResult(Id) {
    $.ajax({
        url: "../Controllers/ReportResultController.php?Choice=GetOnlyReportResult",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var jsonData = JSON.parse(data);
            $("#txtTestId").val(jsonData.TestId);
            $("#txtResult").val(jsonData.Result);
            $("#txtId").val(jsonData.ReportId);
            $("#ReportResultModel").modal("show");
            $("#btnADD").html("Edit");
        }
    });
}

function GetTestList() {
    $.ajax({
        url: "../Controllers/TestController.php?Choice=GetTestList",
        type: "POST",
        success: function(response) {
            var Data = JSON.parse(response);
            Data.map(o => {
                $("#txtTestId").append("<option value='" + o.TestId + "'>" + o.TestName +
                    "</option>");
            });
        }
    });
}
GetTestList();

function cancle() {
    $("#txtTestId").val();
    $("#txtResult").val();
    $("#btnADD").html("Save");
}
</script>

<?php
   include"PageFotter.php";
?>