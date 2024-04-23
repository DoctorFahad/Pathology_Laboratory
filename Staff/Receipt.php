<?php
   include"PageTop.php";
   require_once "../DBOperations/DBConfig.php";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>

<!--These jQuery libraries for  
           chosen need to be included-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />

<!--These jQuery libraries for select2  
            need to be included-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />

<style>
.select2-container {
    width: 100% !important;
}
</style>
<form class="content-wraper-area" method="POST">
    <input type="hidden" id="txtId" value='0' />
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-3">Receipt</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <b>Invoice No.</b>
                                    <span class="form-control" id="txtInvoice"></span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <b>Date</b>
                                    <input type="date" value="<?php echo date("Y-m-d"); ?>"
                                        max="<?php echo date("Y-m-d"); ?>" class="form-control" name="txtDate"
                                        id="txtDate" disabled>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <b>Patient <i data-bs-toggle="modal" data-bs-target="#PatientModel"
                                            class='fas fa-plus-square'></i> </b>
                                    <select name="txtPatientId" id="txtPatientId" class="form-control">
                                        <option value="">Select Patient</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <b>Doctor <i data-bs-toggle="modal" data-bs-target="#DoctorModel"
                                            class='fas fa-plus-square'></i></b>
                                    <select name="txtDoctorId" id="txtDoctorId" class="form-control">
                                        <option value="">Select Doctor</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <b>Hospital</b>
                                    <select name="txtHospitalId" id="txtHospitalId" class="form-control">
                                        <option value="">Select Hospital</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <b>Total</b>
                                    <span class="form-control" id="txtTotal">₹0.00</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <b>Priority</b>
                                    <select name="txtPriority" class="form-select" id="txtPriority">
                                        <option value="High">High</option>
                                        <option value="Normal">Normal</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <b>Payment Mode</b>
                                    <select name="txtPaymentMode" class="form-select" id="txtPaymentMode">
                                        <option value="Cash">Cash</option>
                                        <option value="Online">Online</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <b>Reference No</b>
                                    <input type="text" class="form-control" name="txtReferenceNo" id="txtReferenceNo">
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-dark" id="btnCreateReceipt">Create
                                        Receipt</button>
                                    <button type="button" onclick="cancle()" class="btn btn-danger" id="btnCANCLE"
                                        data-bs-dismiss="modal">CANCLE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="container-fluid">
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th style='width: 30px;'></th>
                                        <th>Test</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody id='testList'>

                                </tbody>
                            </table>
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
                                <b>DOB</b><span class="error" id="lblDOB">*</span>
                                <input type="date" class="form-control" name="txtDOB" id="txtDOB"
                                    max="<?php echo date("Y-m-d"); ?>">
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
                <button type="button" class="btn btn-dark" id="btnPatientSave">ADD</button>
                <button type="button" onclick="canclePat()" class="btn btn-danger" id="btnCANCLE"
                    data-bs-dismiss="modal">CANCLE</button>
            </div>
        </div>
    </div>
</div>


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
                                <select name="txtHosId" class="form-control" id="txtHosId" class="form-control">
                                    <option value="">Select Hospital</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Full Name</b><span class="error" id="lblDocFullName">*</span>
                                <input type="text" class="form-control" name="txtDocFullName" id="txtDocFullName">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Address</b><span class="error" id="lblDocAddress">*</span>
                                <input type="text" class="form-control" name="txtDocAddress" id="txtDocAddress">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Contact No</b><span class="error" id="lblDocCno">*</span>
                                <input type="text" class="form-control" name="txtDocCno" id="txtDocCno">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Alternate</b><span class="error" id="lblDocAlternate">*</span>
                                <input type="text" class="form-control" name="txtDocAlternate" id="txtDocAlternate">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Email</b><span class="error" id="lblDocEmail">*</span>
                                <input type="text" class="form-control" name="txtDocEmail" id="txtDocEmail">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Commission</b>
                                <input type="text" class="form-control" name="txtDocCommission" id="txtDocCommission">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" id="btnAddDoctor">ADD</button>
                <button type="button" onclick="cancleDoc()" class="btn btn-danger" id="btnCANCLE"
                    data-bs-dismiss="modal">CANCLE</button>
            </div>
        </div>
    </div>
</div>

<script>
function getReceiptNo() {
    $.ajax({
        url: "../Controllers/ReceiptController.php?Choice=getReceiptNo",
        type: "POST",
        success: function(response) {
            $("#txtInvoice").html(response);
        }
    });
}

getReceiptNo();

//testdata
function getTest() {
    $.ajax({
        url: "../Controllers/TestController.php?Choice=GetTestList",
        type: "POST",
        contentType: "app/json",
        success: function(res) {
            res = JSON.parse(res);
            $("#testList").empty();
            res.map(o => {
                var Amt = parseFloat(o.Cost);
                const formattedAmount = `₹${Amt.toFixed(2)}`;
                $("#testList").append(
                    '<tr><td class="text-center"><input type="checkbox" name="chk' + o.index +
                    '" id="chk' + o.index + '" value="[' + o.TestId + ',  ' + o.Cost +
                    ']" /></td><td>' + o.TestName + '</td><td class="text-right">' +
                    formattedAmount + '</td></tr>');
            });
        }
    });
}
getTest();

//Patient Popup
$(document).ready(function() {
    $("#btnPatientSave").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtFullName", "lblFullName", Cnt);
        Cnt = IsEmpty("txtCno", "lblCno", Cnt);
        Cnt = IsEmpty("txtDOB", "lblDOB", Cnt);
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
                    canclePat();
                    showToast(response);
                    getPatients();
                }
            });
        }
    });

    //Checkbox
    $("input[type=checkbox]").change(function() {
        var Total = 0;
        $("#testList input[type=checkbox]").each(function() {
            if ($(this).is(':checked')) {
                var data = JSON.parse($(this).val());
                Total = Total + parseFloat(data[1]);
            }
        });
        const formattedAmount = `₹${Total.toFixed(2)}`;
        $("#txtTotal").html(formattedAmount);
    });

    $("#btnCreateReceipt").click(function() {

        var Cnt = 0;
        let tests = [];
        $("#testList input[type=checkbox]").each(function() {
            if ($(this).is(':checked')) {
                var data = JSON.parse($(this).val());
                tests.push({
                    "TestId": data[0],
                    "Cost": data[1]
                });
            }
        });

        var Data = {
            "ReceiptId": $("#txtInvoice").text(),
            "PatientId": $("#txtPatientId").val(),
            "DoctorId": $("#txtDoctorId").val(),
            "HospitalId": $("#txtHospitalId").val(),
            "PaymentMode": $("#txtPaymentMode").val(),
            "ReferenceNo": $("#txtReferenceNo").val(),
            "Date": $("#txtDate").val(),
            "Total": $("#txtTotal").text().replaceAll("₹", ""),
            "Priority": $("#txtPriority").val(),
            "tests": JSON.stringify(tests),
            "StaffId": getCookie("StaffId")
        };

        $.ajax({
            url: "../Controllers/ReceiptController.php?Choice=AddReceipt",
            type: "POST",
            data: JSON.stringify(Data),
            contentType: "app/json",
            success: function(response) {
                cancle();
                console.log(response);
                showToast(response);
                setTimeout(() => {
                    window.location.href = "PrintReceipt.php?InvoiceId=" + $(
                        "#txtInvoice").text();
                }, 3000);
            }
        });
    });
});

function canclePat() {
    $("#txtFullName").val("");
    $("#txtCno").val("");
    $("#txtDOB").val("");
    $("#txtAge").val("");
    $("#txtGender").val("");
    $("#txtAdharNo").val("");
    $("#txtEmail").val("");
}

//Doctor Popup
$(document).ready(function() {
    $("#btnAddDoctor").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtHospitalId", "lblHospitalId", Cnt);
        Cnt = IsEmpty("txtDocFullName", "lblDocFullName", Cnt);
        Cnt = IsEmpty("txtDocAddress", "lblDocAddress", Cnt);
        Cnt = IsEmpty("txtDocCno", "lblDocCno", Cnt);
        Cnt = IsEmpty("txtDocEmail", "lblDocEmail", Cnt);
        Cnt = CheckContactNo("txtDocCno", "lblDocCno", Cnt);
        Cnt = EmailValidation("txtDocEmail", "lblDocEmail", Cnt);
        Cnt = CheckContactNo("txtDocAlternate", "lblDocAlternate", Cnt);

        if (Cnt == 0) {
            var Data = {
                "DoctorId": $("#txtId").val(),
                "HospitalId": $("#txtHosId").val(),
                "FullName": $("#txtDocFullName").val(),
                "Address": $("#txtDocAddress").val(),
                "ContactNo": $("#txtDocCno").val(),
                "Alternate": $("#txtDocAlternate").val(),
                "Email": $("#txtDocEmail").val(),
                "Commission": $("#txtDocCommission").val(),
            };

            $.ajax({
                url: "../Controllers/DoctorController.php?Choice=AddDoctor",
                type: "POST",
                data: JSON.stringify(Data),
                contentType: "app/json",
                success: function(response) {
                    $("#DoctorModel").modal("hide");
                    cancleDoc();
                    showToast(response);
                    getDoctors();
                }
            });
        }
    });
});

function cancleDoc() {
    $("#txtHosId").val("");
    $("#txtDocFullName").val("");
    $("#txtDocAddress").val("");
    $("#txtDocCno").val("");
    $("#txtDocAlternate").val("");
    $("#txtDocEmail").val("");
    $("#txtDocCommission").val("");
}


function DeleteReceipt(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/ReceiptController.php?Choice=DeleteReceipt",
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

function GetOnlyReceipt(Id) {
    $.ajax({
        url: "../Controllers/ReceiptController.php?Choice=GetOnlyReceipt",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var JsonData = JSON.parse(data);
            $("#txtPatientId").val(JsonData.PatientId);
            $("#txtDoctorId").val(JsonData.DoctorId);
            $("#txtHospitalId").val(JsonData.HospitalId);
            $("#txtPaymentMode").val(JsonData.PaymentMode);
            $("#txtReferenceNo").val(JsonData.ReferenceNo);
            $("#txtDate").val(JsonData.Date);
            $("#txtTotal").val(JsonData.Total);
            $("#txtPriority").val(JsonData.Priority);
            $("#txtId").val(JsonData.ReceiptId);
            $("#ReceiptModel").modal("show");
        }
    });
}

//Drp Patients
function getPatients() {
    $.ajax({
        url: "../Controllers/PatientController.php?Choice=GetPatientList",
        type: "POST",
        success: function(response) {
            var Data = JSON.parse(response);
            Data.map(o => {
                $("#txtPatientId").append("<option value='" + o.PatientId + "'>" + o.FullName +
                    " | " + o.ContactNo + "</option>");
            });
        }
    });
    $("#txtPatientId").select2();
}
getPatients();

//Drp Doctors
function getDoctors() {
    $.ajax({
        url: "../Controllers/DoctorController.php?Choice=GetDoctorList",
        type: "POST",
        success: function(response) {
            var Data = JSON.parse(response);
            Data.map(o => {
                $("#txtDoctorId").append("<option value='" + o.DoctorId + "'>" + o.FullName +
                    "</option>");
            });
        }
    });
    $("#txtDoctorId").select2();
}
getDoctors();

//Drp Hospitals
function getHospitals() {
    $.ajax({
        url: "../Controllers/HospitalController.php?Choice=GetHospitalList",
        type: "POST",
        success: function(response) {
            var Data = JSON.parse(response);
            Data.map(o => {
                $("#txtHospitalId").append("<option value='" + o.HospitalId + "'>" + o
                    .HospitalName + "</option>");
                $("#txtHosId").append("<option value='" + o.HospitalId + "'>" + o.HospitalName +
                    "</option>");

            });
        }
    });

    $("#txtHospitalId").select2();

}
getHospitals();

//Cancle
function cancle() {
    $("#txtPatientId").val("");
    $("#txtDoctorId").val("");
    $("#txtHospitalId").val("");
    $("#txtPaymentMode").val("");
    $("#txtReferenceNo").val("");
    $("#txtDate").val("");
    $("#txtTotal").val("");
    $("#txtPriority").val("");
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