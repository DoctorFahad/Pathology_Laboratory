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
                            <h4 class="mb-0">Patient Details</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#PatientModel"
                                        class='btn btn-dark'>Add Patient</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><i>FullName</i></th>
                                                    <th><i>ContactNo</i></th>
                                                    <th><i>DOB</i></th>
                                                    <th><i>Age</i></th>
                                                    <th><i>Gender</i></th>
                                                    <th><i>AdharNo</i></th>
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

<div class="modal" id="PatientModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add Patient</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                                <b>Contact No</b><span class="error" id="lblCno">*</span>
                                <input type="text" class="form-control" name="txtCno" id="txtCno">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>DOB</b><span class="error" id="lblDoB">*</span>
                                <input type="date" class="form-control" name="txtDOB" id="txtDOB" max="<?php echo date("Y-m-d"); ?>">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Age</b><span class="error" id="lblAge">*</span>
                                <input type="text" class="form-control" name="txtAge" id="txtAge" disabled>
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Gender</b><span class="error" id="lblGender">*</span>
                                <select name="txtGender" class="form-control" id="txtGender">
                                    <option value="Male">Male</option>
                                    <option value="FeMale">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Adhar No</b><span class="error" id="lblAdharNo">*</span>
                                <input type="text" class="form-control" name="txtAdharNo" id="txtAdharNo">
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
        "url": "../Controllers/PatientController.php?Choice=GetPatientList",
        "dataSrc": ""
    },
    "columns": [{
            data: "FullName"
        },
        {
            data: "ContactNo"
        },
        {
            data: "DOB"
        },
        {
            data: "Age"
        },
        {
            data: "Gender"
        },
        {
            data: "AdharNo"
        },
        {
            data: "Email"
        },
        {
            data: "PatientId"
        },
        {
            data: "PatientId"
        },
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [{
            'targets': 7,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var DeletePatient = 'DeletePatient(' + data + ')'
                return "<i class= 'fas fa-trash' onclick='" + DeletePatient + "'></i>"
            }
        },
        {
            'targets': 8,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var GetOnlyPatient = 'GetOnlyPatient(' + data + ')'
                return "<i class= 'fas fa-edit' onclick='" + GetOnlyPatient + "'></i>"
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
        }
    ]
});

$(document).ready(function() {
    $("#btnADD").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtFullName", "lblFullName", Cnt);
        Cnt = IsEmpty("txtCno", "lblCno", Cnt);
        Cnt = IsEmpty("txtDOB", "lblDoB", Cnt);
        Cnt = IsEmpty("txtAge", "lblAge", Cnt);
        Cnt = IsEmpty("txtGender", "lblGender", Cnt);
        Cnt = IsEmpty("txtAdharNo", "lblAdharNo", Cnt);
        Cnt = IsEmpty("txtEmail", "lblEmail", Cnt);
        Cnt = CheckFutureDate("txtDOB", "lblDoB", Cnt);
        Cnt = CheckContactNo("txtCno", "lblCno", Cnt);
        Cnt = ValidateAadhaar("txtAdharNo", "lblAdharNo", Cnt);
        Cnt = EmailValidation("txtEmail", "lblEmail", Cnt);

        if (Cnt == 0) {
            var Data = {
                "PatientId": $("#txtId").val(),
                "FullName": $("#txtFullName").val(),
                "NormalRange": $("#txtNormalRange").val(),
                "ContactNo": $("#txtCno").val(),
                "DOB": $("#txtDOB").val(),
                "Age": $("#txtAge").val(),
                "Gender": $("#txtGender").val(),
                "AdharNo": $("#txtAdharNo").val(),
                "Email": $("#txtEmail").val(),
            };

            $.ajax({
                url: "../Controllers/PatientController.php?Choice=AddPatient",
                type: "POST",
                data: JSON.stringify(Data),
                contentType: "app/json",
                success: function(response) {
                    $("#PatientModel").modal("hide");
                    cancle();
                    showToast(response);
                    dt.ajax.reload(null, false);
                }
            });
        }
    });
});

function DeletePatient(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/PatientController.php?Choice=DeletePatient",
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

function GetOnlyPatient(Id) {
    $.ajax({
        url: "../Controllers/PatientController.php?Choice=GetOnlyPatient",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var jsonData = JSON.parse(data);
            $("#txtFullName").val(jsonData.FullName);
            $("#txtCno").val(jsonData.ContactNo);
            $("#txtDOB").val(jsonData.DOB);
            $("#txtAge").val(jsonData.Age);
            $("#txtGender").val(jsonData.Gender);
            $("#txtAdharNo").val(jsonData.AdharNo);
            $("#txtEmail").val(jsonData.Email);
            $("#txtId").val(jsonData.PatientId);
            $("#PatientModel").modal("show");
            $("#btnADD").html("Edit");
        }
    });
}

function cancle() {
    $("#txtFullName").val();
    $("#txtCno").val();
    $("#txtDOB").val();
    $("#txtAge").val();
    $("#txtGender").val();
    $("#txtAdharNo").val();
    $("#txtEmail").val();
    $("#btnADD").html("Save");
    window.location.href = '';
}

var selectedDateInput = document.getElementById('txtDOB');
selectedDateInput.addEventListener('change', function() {
    var selectedDate = new Date(this.value);
    var currentDate = new Date();
    var differenceInMilliseconds = currentDate - selectedDate;
    var age = Math.floor(differenceInMilliseconds / 1000 / 60 / 60 / 24 / 365.25);
    document.getElementById('txtAge').value = age;
});
</script>

<?php
   include"PageFotter.php";
?>