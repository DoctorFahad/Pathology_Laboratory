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
                            <h4 class="mb-0">Hospital Details</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#HospitalModel"
                                        class='btn btn-dark'>Add Hospital</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><i>HospitalName</i></th>
                                                    <th><i>Address</i></th>
                                                    <th><i>ContactNo</i></th>
                                                    <th><i>Alternate</i></th>
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

<div class="modal" id="HospitalModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add Hospital</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <b>Hospital Name</b><span class="error" id="lblHospitalName">*</span>
                                <input type="text" class="form-control" name="txtHospitalName" id="txtHospitalName">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Address</b><span class="error" id="lblAddress">*</span>
                                <input type="text" class="form-control" name="txtAddress" id="txtAddress">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Contact No</b><span class="error" id="lblCno">*</span>
                                <input type="number" class="form-control" name="txtCno" id="txtCno">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Alternate</b><span class="error" id="lblAltno">*</span>
                                <input type="text" class="form-control" name="txtAlternate" id="txtAlternate">
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
        "url": "../Controllers/HospitalController.php?Choice=GetHospitalList",
        "dataSrc": ""
    },
    "columns": [{
            data: "HospitalName"
        },
        {
            data: "Address"
        },
        {
            data: "ContactNo"
        },
        {
            data: "Alternate"
        },
        {
            data: "Email"
        },
        {
            data: "HospitalId"
        },
        {
            data: "HospitalId"
        },
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [{
            'targets': 5,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var DeleteHospital = 'DeleteHospital(' + data + ')'
                return "<i class= 'fas fa-trash' onclick='" + DeleteHospital + "'></i>"
            }
        },
        {
            'targets': 6,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var GetOnlyHospital = 'GetOnlyHospital(' + data + ')'
                return "<i class= 'fas fa-edit' onclick='" + GetOnlyHospital + "'></i>"
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
        Cnt = IsEmpty("txtHospitalName", "lblHospitalName", Cnt);
        Cnt = IsEmpty("txtAddress", "lblAddress", Cnt);
        Cnt = IsEmpty("txtCno", "lblCno", Cnt);
        Cnt = IsEmpty("txtEmail", "lblEmail", Cnt);
        Cnt = CheckContactNo("txtCno", "lblCno", Cnt);
        Cnt = EmailValidation("txtEmail", "lblEmail", Cnt);
        Cnt = CheckContactNo("txtAlternate", "lblAltno", Cnt);

        if (Cnt == 0) {
            var Data = {
                "HospitalId": $("#txtId").val(),
                "HospitalName": $("#txtHospitalName").val(),
                "Address": $("#txtAddress").val(),
                "ContactNo": $("#txtCno").val(),
                "Alternate": $("#txtAlternate").val(),
                "Email": $("#txtEmail").val(),
            };

            $.ajax({
                url: "../Controllers/HospitalController.php?Choice=AddHospital",
                type: "POST",
                data: JSON.stringify(Data),
                contentType: "app/json",
                success: function(response) {
                    $("#HospitalModel").modal("hide");
                    cancle();
                    showToast(response);
                    dt.ajax.reload(null, false);
                }
            });
        }
    });
});

function DeleteHospital(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/HospitalController.php?Choice=DeleteHospital",
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

function GetOnlyHospital(Id) {
    $.ajax({
        url: "../Controllers/HospitalController.php?Choice=GetOnlyHospital",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var jsonData = JSON.parse(data);
            $("#txtHospitalName").val(jsonData.HospitalName);
            $("#txtAddress").val(jsonData.Address);
            $("#txtCno").val(jsonData.ContactNo);
            $("#txtAlternate").val(jsonData.Alternate);
            $("#txtEmail").val(jsonData.Email);
            $("#txtId").val(jsonData.HospitalId);
            $("#HospitalModel").modal("show");
            $("#btnADD").html("Edit");
        }
    });
}

function cancle() {
    $("#txtHospitalName").val("");
    $("#txtAddress").val("");
    $("#txtCno").val("");
    $("#txtAlternate").val("");
    $("#txtEmail").val("");
    $("#btnADD").html("Save");
    window.location.href = '';
}
</script>

<?php
   include"PageFotter.php";
?>