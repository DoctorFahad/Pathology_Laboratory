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
                            <h4 class="mb-0">Doctor Details</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#DoctorModel"
                                        class='btn btn-dark'>Add Doctor</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Hospital</th>
                                                    <th>FullName</th>
                                                    <th>Contact Details</th>
                                                    <th>Commission</th>
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

<div class="modal" id="DoctorModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add Doctor</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <b>Hospital Id</b><span class="error" id="lblHospitalId">*</span>
                                <select name="txtHospitalId" class="form-control" id="txtHospitalId"
                                    class="form-control">
                                    <option value="">Select Hospital</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Full Name</b><span class="error" id="lblFullName">*</span>
                                <input type="text" class="form-control" name="txtFullName" id="txtFullName">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Address</b><span class="error" id="lblAddress">*</span>
                                <input type="text" class="form-control" name="txtAddress" id="txtAddress">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Contact No</b><span class="error" id="lblCno">*</span>
                                <input type="text" class="form-control" name="txtCno" id="txtCno">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Alternate</b><span class="error" id="lblAltno"></span>
                                <input type="text" class="form-control" name="txtAlternate" id="txtAlternate">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Email</b><span class="error" id="lblEmail">*</span>
                                <input type="text" class="form-control" name="txtEmail" id="txtEmail">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Commission</b>
                                <input type="text" class="form-control" name="txtCommission" id="txtCommission">
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
        "url": "../Controllers/DoctorController.php?Choice=GetDoctorList",
        "dataSrc": ""
    },
    "columns": [{
            data: "HospitalName"
        },
        {
            data: "FullName"
        },
        {
            data: "Address"
        },
        {
            data: "Commission"
        },
        {
            data: "DoctorId"
        }
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [{
            'targets': 2,
            'orderable': false,
            'render': function(data, type, full, meta) {
                return full["Address"] + "<br />" + full["ContactNo"] + ", " + full["Alternate"] +
                    "<br />" + full["Email"];
            }
        },
        {
            'targets': 4,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var DeleteDoctor = 'DeleteDoctor(' + data + ')';
                var GetOnlyDoctor = 'GetOnlyDoctor(' + data + ')';
                return "<i class= 'fas fa-trash' onclick='" + DeleteDoctor +
                    "'></i>&nbsp;&nbsp;<i class= 'fas fa-edit' onclick='" + GetOnlyDoctor + "'></i>"
            }
        },
        {
            'targets': [0, 1, 2, 3, 4],
            'orderable': false,
        }
    ]
});

$(document).ready(function() {
    $("#btnADD").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtHospitalId", "lblHospitalId", Cnt);
        Cnt = IsEmpty("txtFullName", "lblFullName", Cnt);
        Cnt = IsEmpty("txtAddress", "lblAddress", Cnt);
        Cnt = IsEmpty("txtCno", "lblCno", Cnt);
        Cnt = IsEmpty("txtEmail", "lblEmail", Cnt);
        Cnt = CheckContactNo("txtCno", "lblCno", Cnt);
        Cnt = EmailValidation("txtEmail", "lblEmail", Cnt);
        Cnt = CheckContactNo("txtAlternate", "lblAltno", Cnt);
        
        if (Cnt == 0) {
            var Data = {
                "DoctorId": $("#txtId").val(),
                "HospitalId": $("#txtHospitalId").val(),
                "FullName": $("#txtFullName").val(),
                "Address": $("#txtAddress").val(),
                "ContactNo": $("#txtCno").val(),
                "Alternate": $("#txtAlternate").val(),
                "Email": $("#txtEmail").val(),
                "Commission": $("#txtCommission").val(),
            };

            $.ajax({
                url: "../Controllers/DoctorController.php?Choice=AddDoctor",
                type: "POST",
                data: JSON.stringify(Data),
                contentType: "app/json",
                success: function(response) {
                    $("#DoctorModel").modal("hide");
                    cancle();
                    showToast(response);
                    dt.ajax.reload(null, false);
                }
            });
        }
    });
});

function DeleteDoctor(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/DoctorController.php?Choice=DeleteDoctor",
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

function GetOnlyDoctor(Id) {
    $.ajax({
        url: "../Controllers/DoctorController.php?Choice=GetOnlyDoctor",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var jsonData = JSON.parse(data);
            $("#txtHospitalId").val(jsonData.HospitalId);
            $("#txtFullName").val(jsonData.FullName);
            $("#txtAddress").val(jsonData.Address);
            $("#txtCno").val(jsonData.ContactNo);
            $("#txtAlternate").val(jsonData.Alternate);
            $("#txtEmail").val(jsonData.Email);
            $("#txtCommission").val(jsonData.Commission);
            $("#txtId").val(jsonData.DoctorId);
            $("#DoctorModel").modal("show");
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

function cancle() {
    $("#txtHospitalId").val("");
    $("#txtFullName").val("");
    $("#txtAddress").val("");
    $("#txtCno").val("");
    $("#txtAlternate").val("");
    $("#txtEmail").val("");
    $("#txtCommission").val("");
    $("#btnADD").html("Save");
    window.location.href = '';
}
</script>

<?php
   include"PageFotter.php";
?>