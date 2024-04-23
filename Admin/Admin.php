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
                            <h4 class="mb-0">Admin Details</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#AdminModel"
                                        class='btn btn-dark'>Add Patient</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><i>FullName</i></th>
                                                    <th><i>UserName</i></th>
                                                    <th><i>ContactNo</i></th>
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

<div class="modal" id="AdminModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add Admin</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <b>Full Name</b>
                                <input type="text" class="form-control" name="txtFullName" id="txtFullName">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>User Name</b>
                                <input type="text" class="form-control" name="txtUserName" id="txtUserName">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Contact No</b>
                                <input type="text" class="form-control" name="txtCno" id="txtCno">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Email</b>
                                <input type="text" class="form-control" name="txtEmail" id="txtEmail">
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
        "url": "../Controllers/AdminController.php?Choice=GetAdminList",
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
            data: "Email"
        },
        {
            data: "AdminId"
        },
        {
            data: "AdminId"
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
                var DeleteAdmin = 'DeleteAdmin(' + data + ')'
                return "<i class= 'fas fa-trash' onclick='" + DeleteAdmin + "'></i>"
            }
        },
        {
            'targets': 5,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var GetOnlyAdmin = 'GetOnlyAdmin(' + data + ')'
                return "<i class= 'fas fa-edit' onclick='" + GetOnlyAdmin + "'></i>"
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
        var Data = {
            "AdminId": $("#txtId").val(),
            "FullName": $("#txtFullName").val(),
            "UserName": $("#txtUserName").val(),
            "ContactNo": $("#txtCno").val(),
            "Email": $("#txtEmail").val(),
        };

        $.ajax({
            url: "../Controllers/AdminController.php?Choice=AddAdmin",
            type: "POST",
            data: JSON.stringify(Data),
            contentType: "app/json",
            success: function(response) {
                $("#AdminModel").modal("hide");
                cancle();
                showToast(response);
                dt.ajax.reload(null, false);
            }
        });
    });
});

function DeleteAdmin(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/AdminController.php?Choice=DeleteAdmin",
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

function GetOnlyAdmin(Id) {
    $.ajax({
        url: "../Controllers/AdminController.php?Choice=GetOnlyAdmin",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var jsonData = JSON.parse(data);
            $("#txtFullName").val(jsonData.FullName);
            $("#txtUserName").val(jsonData.UserName);
            $("#txtCno").val(jsonData.ContactNo);
            $("#txtEmail").val(jsonData.Email);
            $("#txtId").val(jsonData.AdminId);
            $("#AdminModel").modal("show");
            $("#btnADD").html("Edit");
        }
    });
}

function cancle() {
    $("#txtFullName").val("");
    $("#txtUserName").val("");
    $("#txtCno").val("");
    $("#txtEmail").val("");
    $("#btnADD").html("Save");
}
</script>

<?php
   include"PageFotter.php";
?>