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
                            <h4 class="mb-0">HosAllocation Details</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#HosAllocationModel"
                                        class='btn btn-dark'>Add HosAllocation</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Hospital</th>
                                                    <th>Staff Name</th>
                                                    <th>AllocationDate</th>
                                                    <th style="width: 50px;"></th>
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

<div class="modal" id="HosAllocationModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add HosAllocation</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <b>Hospital</b><span class="error" id="lblHospitalId">*</span>
                                <select name="txtHospitalId" class="form-control" id="txtHospitalId"
                                    class="form-control">
                                    <option value="">Select Hospital</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Staff</b><span class="error" id="lblStaffId">*</span>
                                <select name="txtStaffId" class="form-control" id="txtStaffId" class="form-control">
                                    <option value="">Select Staff</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Allocation Date</b><span class="error" id="lblAllocationDate">*</span>
                                <input type="date" class="form-control" name="txtAllocationDate" id="txtAllocationDate">
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
        "url": "../Controllers/HosAllocationController.php?Choice=GetHosAllocationList",
        "dataSrc": ""
    },
    "columns": [{
            data: "HospitalName"
        },
        {
            data: "FullName"
        },
        {
            data: "AllocationDate"
        },
        {
            data: "AllocationId"
        }
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [{
            'targets': 3,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var DeleteHosAllocation = 'DeleteHosAllocation(' + data + ')';
                var GetOnlyHosAllocation = 'GetOnlyHosAllocation(' + data + ')';
                return "<i class= 'fas fa-trash' onclick='" + DeleteHosAllocation +
                    "'></i>&nbsp;&nbsp;<i class= 'fas fa-edit' onclick='" + GetOnlyHosAllocation +
                    "'></i>"
            }
        },
        {
            'targets': [0, 1, 2],
            'orderable': false,
        }
    ]
});

$(document).ready(function() {
    $("#btnADD").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtHospitalId", "lblHospitalId", Cnt);
        Cnt = IsEmpty("txtStaffId", "lblStaffId", Cnt);
        Cnt = IsEmpty("txtAllocationDate", "lblAllocationDate", Cnt);

        if (Cnt == 0) {
            var Data = {
                "AllocationId": $("#txtId").val(),
                "HospitalId": $("#txtHospitalId").val(),
                "StaffId": $("#txtStaffId").val(),
                "AllocationDate": $("#txtAllocationDate").val(),
            };

            $.ajax({
                url: "../Controllers/HosAllocationController.php?Choice=AddHosAllocation",
                type: "POST",
                data: JSON.stringify(Data),
                contentType: "app/json",
                success: function(response) {
                    $("#HosAllocationModel").modal("hide");
                    cancle();
                    showToast(response);
                    dt.ajax.reload(null, false);
                }
            });
        }
    });
});

function DeleteHosAllocation(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/HosAllocationController.php?Choice=DeleteHosAllocation",
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

function GetOnlyHosAllocation(Id) {
    $.ajax({
        url: "../Controllers/HosAllocationController.php?Choice=GetOnlyHosAllocation",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var jsonData = JSON.parse(data);
            $("#txtHospitalId").val(jsonData.HospitalId);
            $("#txtStaffId").val(jsonData.StaffId);
            $("#txtAllocationDate").val(jsonData.AllocationDate);
            $("#txtId").val(jsonData.AllocationId);
            $("#HosAllocationModel").modal("show");
            $("#btnADD").html("Edit");
        }
    });
}

function getHospitals() {
    $.ajax({
        url: "../Controllers/HospitalController.php?Choice=GetHospitalList",
        type: "POST",
        success: function(response) {
            var Data = JSON.parse(response);
            Data.map(o => {
                $("#txtHospitalId").append("<option value='" + o.HospitalId + "'>" + o
                    .HospitalName + "</option>");
            });

        }
    });
}

getHospitals();

function getStaff() {
    $.ajax({
        url: "../Controllers/StaffController.php?Choice=GetStaffList",
        type: "POST",
        success: function(response) {
            var Data = JSON.parse(response);
            Data.map(o => {
                $("#txtStaffId").append("<option value='" + o.StaffId + "'>" + o.FullName +
                    "</option>");
            });

        }
    });
}

getStaff();

function cancle() {
    $("#txtHospitalId").val("");
    $("#txtStaffId").val("");
    $("#txtAllocationDate").val("");
    $("#btnADD").html("Save");
}
</script>

<?php
   include"PageFotter.php";
?>