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
                            <h4 class="mb-0">Laboratory Staff</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#StaffModel"
                                        class='btn btn-dark'>Add Staff</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><i>FullName</i></th>
                                                    <th><i>UserName</i></th>
                                                    <th><i>Address</i></th>
                                                    <th><i>ContactNo</i></th>
                                                    <th><i>Gender</i></th>
                                                    <th><i>DOB</i></th>
                                                    <th><i>DOJ</i></th>
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

<div class="modal" id="StaffModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add Staff</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <b>Full Name</b><span class="error" id="lblFullName">*</span>
                                <input type="text" class="form-control" name="txtFullName" id="txtFullName">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>User Name</b><span class="error" id="lblUserName">*</span>
                                <input type="text" class="form-control" name="txtUserName" id="txtUserName">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Address</b><span class="error" id="lblAddress">*</span>
                                <input type="text" class="form-control" name="txtAddress" id="txtAddress">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>ContactNo</b><span class="error" id="lblCno">*</span>
                                <input type="text" class="form-control" name="txtCno" id="txtCno">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Gender</b><span class="error" id="lblGender">*</span>
                                <select name="txtGender" class="form-control" id="txtGender">
                                    <option value="Male">Male</option>
                                    <option value="FeMale">FeMale</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>DOB</b><span class="error" id="lblDOB">*</span>
                                <input type="date" class="form-control" name="txtDOB" id="txtDOB">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>DOJ</b><span class="error" id="lblDOJ">*</span>
                                <input type="date" class="form-control" name="txtDOJ" id="txtDOJ">
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
        "url": "../Controllers/StaffController.php?Choice=GetStaffList",
        "dataSrc": ""
    },
    "columns": [{
            data: "FullName"
        },
        {
            data: "UserName"
        },
        {
            data: "Address"
        },
        {
            data: "ContactNo"
        },
        {
            data: "Gender"
        },
        {
            data: "DOB"
        },
        {
            data: "DOJ"
        },
        {
            data: "Email"
        },
        {
            data: "StaffId"
        },
        {
            data: "StaffId"
        },
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [{
            'targets': 8,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var DeleteStaff = 'DeleteStaff(' + data + ')'
                return "<i class= 'fas fa-trash' onclick='" + DeleteStaff + "'></i>"
            }
        },
        {
            'targets': 9,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var GetOnlyStaff = 'GetOnlyStaff(' + data + ')'
                return "<i class= 'fas fa-edit' onclick='" + GetOnlyStaff + "'></i>"
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
        },
        {
            'targets': 5,
            'orderable': false,
        },
        {
            'targets': 6,
            'orderable': false,
        },
        {
            'targets': 7,
            'orderable': false,
        }
    ]
});

$(document).ready(function() {
    $("#btnADD").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtFullName", "lblFullName", Cnt);
        Cnt = IsEmpty("txtUserName", "lblUserName", Cnt);
        Cnt = IsEmpty("txtAddress", "lblAddress", Cnt);
        Cnt = IsEmpty("txtCno", "lblCno", Cnt);
        Cnt = IsEmpty("txtGender", "lblGender", Cnt);
        Cnt = IsEmpty("txtDOB", "lblDOB", Cnt);
        Cnt = IsEmpty("txtDOJ", "lblDOJ", Cnt);
        Cnt = IsEmpty("txtEmail", "lblEmail", Cnt);
        Cnt = CheckContactNo("txtCno", "lblCno", Cnt);
        Cnt = CheckFutureDate("txtDOB", "lblDOB", Cnt);
        Cnt = CheckFutureDate("txtDOJ", "lblDOJ", Cnt);

        if (Cnt == 0) {
            var Data = {
                "StaffId": $("#txtId").val(),
                "FullName": $("#txtFullName").val(),
                "UserName": $("#txtUserName").val(),
                "Address": $("#txtAddress").val(),
                "ContactNo": $("#txtCno").val(),
                "Gender": $("#txtGender").val(),
                "DOB": $("#txtDOB").val(),
                "DOJ": $("#txtDOJ").val(),
                "Email": $("#txtEmail").val(),
            };

            $.ajax({
                url: "../Controllers/StaffController.php?Choice=AddStaff",
                type: "POST",
                data: JSON.stringify(Data),
                contentType: "app/json",
                success: function(response) {
                    $("#StaffModel").modal("hide");
                    cancle();
                    showToast(response);
                    dt.ajax.reload(null, false);
                }
            });
        }
    });
});

function DeleteStaff(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/StaffController.php?Choice=DeleteStaff",
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

function GetOnlyStaff(Id) {
    $.ajax({
        url: "../Controllers/StaffController.php?Choice=GetOnlyStaff",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var jsonData = JSON.parse(data);
            $("#txtFullName").val(jsonData.FullName);
            $("#txtUserName").val(jsonData.UserName);
            $("#txtAddress").val(jsonData.Address);
            $("#txtCno").val(jsonData.ContactNo);
            $("#txtGender").val(jsonData.Gender);
            $("#txtDOB").val(jsonData.DOB);
            $("#txtDOJ").val(jsonData.DOJ);
            $("#txtEmail").val(jsonData.Email);
            $("#txtId").val(jsonData.StaffId);
            $("#StaffModel").modal("show");
            $("#btnADD").html("Edit");
        }
    });
}

function cancle() {
    $("#txtFullName").val("");
    $("#txtUserName").val("");
    $("#txtAddress").val("");
    $("#txtCno").val("");
    $("#txtGender").val("");
    $("#txtDOB").val("");
    $("#txtDOJ").val("");
    $("#txtEmail").val("");
    $("#btnADD").html("Save");
}
</script>

<?php
   include"PageFotter.php";
?>