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
                            <h4 class="mb-0">DeliveryBoy Details</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#DeliveryBoyModel"
                                        class='btn btn-dark'>Add DeliveryBoy</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><i>FullName</i></th>
                                                    <th><i>UserName</i></th>
                                                    <th><i>ContactNo</i></th>
                                                    <th><i>LicenseNo</i></th>
                                                    <th><i>ExpiryDate</i></th>
                                                    <th><i>Email</i></th>
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

<div class="modal" id="DeliveryBoyModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add DeliveryBoy</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <b>DeliveryBoy Name</b><span class="error" id="lblDeliveryBoyName">*</span>
                                <input type="text" class="form-control" name="txtDeliveryBoyName" id="txtDeliveryBoyName">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>UserName</b><span class="error" id="lblUserName">*</span>
                                <input type="text" class="form-control" name="txtUserName" id="txtUserName">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Contact No</b><span class="error" id="lblCno">*</span>
                                <input type="text" class="form-control" name="txtCno" id="txtCno">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>LicenseNo</b><span class="error" id="lblLicenseNo">*</span>
                                <input type="text" class="form-control" name="txtLicenseNo" id="txtLicenseNo">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>ExpiryDate</b><span class="error" id="lblExpiryDate">*</span>
                                <input type="date" class="form-control" name="txtExpiryDate" id="txtExpiryDate">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Email</b><span class="error" id="lblEmail">*</span>
                                <input type="text" class="form-control" name="txtEmail" id="txtEmail">
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
        "url": "../Controllers/DeliveryBoyController.php?Choice=GetDeliveryBoyList",
        "dataSrc": ""
    },
    "columns": [{
            data: "FullName"
        },
        {
            data: "UserName"
        },
        {
            data: "ContactNo"
        },
        {
            data: "LicenseNo"
        },
        {
            data: "ExpiryDate"
        },
        {
            data: "Email"
        },
        {
            data: "DBId"
        },
        {
            data: "DBId"
        },
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [{
            'targets': 6,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var DeleteDeliveryBoy = 'DeleteDeliveryBoy(' + data + ')'
                return "<i class= 'fas fa-trash' onclick='" + DeleteDeliveryBoy + "'></i>"
            }
        },
        {
            'targets': 7,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var GetOnlyDeliveryBoy = 'GetOnlyDeliveryBoy(' + data + ')'
                return "<i class= 'fas fa-edit' onclick='" + GetOnlyDeliveryBoy + "'></i>"
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
        },
        {
            'targets': 4,
            'orderable': false,
        }
    ]
});

$(document).ready(function() {
    $("#btnADD").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtDeliveryBoyName", "lblDeliveryBoyName", Cnt);
        Cnt = IsEmpty("txtUserName", "lblUserName", Cnt);
        Cnt = IsEmpty("txtCno", "lblCno", Cnt);
        Cnt = IsEmpty("txtLicenseNo", "lblLicenseNo", Cnt);
        Cnt = IsEmpty("txtExpiryDate", "lblExpiryDate", Cnt);
        Cnt = IsEmpty("txtEmail", "lblEmail", Cnt);
        Cnt = validateIndianLicenseNumber("txtLicenseNo", "lblLicenseNo", Cnt);
        Cnt = CheckContactNo("txtCno", "lblCno", Cnt);
        Cnt = EmailValidation("txtEmail", "lblEmail", Cnt);

        if (Cnt == 0) {
            var Data = {
                "DBId": $("#txtId").val(),
                "FullName": $("#txtDeliveryBoyName").val(),
                "UserName": $("#txtUserName").val(),
                "ContactNo": $("#txtCno").val(),
                "LicenseNo": $("#txtLicenseNo").val(),
                "ExpiryDate": $("#txtExpiryDate").val(),
                "Email": $("#txtEmail").val(),
            };

            $.ajax({
                url: "../Controllers/DeliveryBoyController.php?Choice=AddDeliveryBoy",
                type: "POST",
                data: JSON.stringify(Data),
                contentType: "app/json",
                success: function(response) {
                    $("#DeliveryBoyModel").modal("hide");
                    cancle();
                    showToast(response);
                    dt.ajax.reload(null, false);
                    window.location.href = "";
                }
            });
        }
    });
});

function DeleteDeliveryBoy(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/DeliveryBoyController.php?Choice=DeleteDeliveryBoy",
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

function GetOnlyDeliveryBoy(Id) {
    $.ajax({
        url: "../Controllers/DeliveryBoyController.php?Choice=GetOnlyDeliveryBoy",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var jsonData = JSON.parse(data);
            $("#txtDeliveryBoyName").val(jsonData.FullName);
            $("#txtUserName").val(jsonData.UserName);
            $("#txtCno").val(jsonData.ContactNo);
            $("#txtLicenseNo").val(jsonData.LicenseNo);
            $("#txtExpiryDate").val(jsonData.ExpiryDate);
            $("#txtEmail").val(jsonData.Email);
            $("#txtId").val(jsonData.DBId);
            $("#DeliveryBoyModel").modal("show");
            $("#btnADD").html("Edit");
        }
    });
}

function cancle() {
    $("#txtDeliveryBoyName").val("");
    $("#txtUserName").val("");
    $("#txtCno").val("");
    $("#txtLicenseNo").val("");
    $("#txtExpiryDate").val("");
    $("#txtEmail").val("");
    $("#btnADD").html("Save");
    window.location.href = '';
}
</script>

<?php
   include"PageFotter.php";
?>