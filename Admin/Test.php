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
                            <h4 class="mb-0">Blood Tests</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#TestModel"
                                        class='btn btn-dark'>Add Test</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><i>Name</i></th>
                                                    <th><i>NormalRange</i></th>
                                                    <th><i>Unit</i></th>
                                                    <th><i>Cost</i></th>
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

<div class="modal" id="TestModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add Test</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <b>Test Name</b><span class='error' id='lblTestName'>*</span>
                                <input type="text" class="form-control" name="txtTestName" id="txtTestName">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Normal Range</b><span class='error' id='lblNormalRange'>*</span>
                                <input type="text" class="form-control" name="txtNormalRange" id="txtNormalRange">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Unit</b><span class='error' id='lblUnit'>*</span>
                                <input type="text" class="form-control" name="txtUnit" id="txtUnit">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Cost</b><span class='error' id='lblCost'>*</span>
                                <input type="text" class="form-control" name="txtCost" id="txtCost">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" id="btnADD">Save</button>
                <button type="reset" onclick="cancle()" class="btn btn-danger" id="btnCANCLE"
                    data-bs-dismiss="modal">CANCLE</button>
            </div>
        </div>
    </div>
</div>
<script>
var dt = $("#dataTable").DataTable({
    "ajax": {
        "url": "../Controllers/TestController.php?Choice=GetTestList",
        "dataSrc": ""
    },
    "columns": [{
            data: "TestName"
        },
        {
            data: "NormalRange"
        },
        {
            data: "Unit"
        },
        {
            data: "Cost"
        },
        {
            data: "TestId"
        },
        {
            data: "TestId"
        },
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [{
            'targets': 4,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var DeleteTest = 'DeleteTest(' + data + ')'
                return "<i class= 'fas fa-trash' onclick='" + DeleteTest + "'></i>"
            }
        },
        {
            'targets': 5,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var GetOnlyTest = 'GetOnlyTest(' + data + ')'
                return "<i class= 'fas fa-edit' onclick='" + GetOnlyTest + "'></i>"
            }
        },
        {
            'targets': 0,
            'orderable': false,
        },
        {
            'targets': 1,
            'orderable': false,
        },
        {
            'targets': 2,
            'orderable': false,
        },
        {
            'targets': 3,
            'orderable': false,
        }
    ]
});

$(document).ready(function() {
    $("#btnADD").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtTestName", "lblTestName", Cnt);
        Cnt = IsEmpty("txtNormalRange", "lblNormalRange", Cnt);
        Cnt = IsEmpty("txtUnit", "lblUnit", Cnt);
        Cnt = IsEmpty("txtCost", "lblCost", Cnt);

        if (Cnt == 0) {
            var Data = {
                "TestId": $("#txtId").val(),
                "TestName": $("#txtTestName").val(),
                "NormalRange": $("#txtNormalRange").val(),
                "Unit": $("#txtUnit").val(),
                "Cost": $("#txtCost").val(),
            };

            $.ajax({
                url: "../Controllers/TestController.php?Choice=AddTest",
                type: "POST",
                data: JSON.stringify(Data),
                contentType: "app/json",
                success: function(response) {
                    $("#TestModel").modal("hide");
                    cancle();
                    showToast(response);
                    dt.ajax.reload(null, false);
                }
            });
        }
    });
});

function DeleteTest(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/TestController.php?Choice=DeleteTest",
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

function GetOnlyTest(Id) {
    $.ajax({
        url: "../Controllers/TestController.php?Choice=GetOnlyTest",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var jsonData = JSON.parse(data);
            $("#txtTestName").val(jsonData.TestName);
            $("#txtNormalRange").val(jsonData.NormalRange);
            $("#txtUnit").val(jsonData.Unit);
            $("#txtCost").val(jsonData.Cost);
            $("#txtId").val(jsonData.TestId);
            $("#TestModel").modal("show");
            $("#btnADD").html("Edit");
        }
    });
}

function cancle() {
    $("#txtTestName").val("");
    $("#txtNormalRange").val("");
    $("#txtUnit").val("");
    $("#txtCost").val("");
    $("#btnADD").html("Save");
    window.location.href = '';
}
</script>

<?php
   include"PageFotter.php";
?>