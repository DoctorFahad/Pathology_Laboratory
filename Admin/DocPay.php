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
                            <h4 class="mb-0">DocPay Details</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#DocPayModel"
                                        class='btn btn-dark'>Add DocPay</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Doctor</th>
                                                    <th>Amount</th>
                                                    <th>Paid Date</th>
                                                    <th>Payment Method</th>
                                                    <th>RefNo.</th>
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

<div class="modal" id="DocPayModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add DocPay</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <b>Doctor</b><span class="error" id="lblDoctorId">*</span>
                                <select name="txtDoctorId" class="form-control" id="txtDoctorId" class="form-control">
                                    <option value="">Select Doctor</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Amount</b><span class="error" id="lblAmount">*</span>
                                <input type="number" class="form-control" name="txtAmount" id="txtAmount">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Paid Date</b><span class="error" id="lblPaidDate">*</span>
                                <input type="date" class="form-control" name="txtPaidDate" id="txtPaidDate">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Payment Mode</b><span class="error" id="lblPaymentMethod">*</span>
                                <select name="txtPaymentMethod" class="form-select" id="txtPaymentMethod">
                                    <option value="Cash">Cash</option>
                                    <option value="Online">Online</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>RefNo.</b><span class="error" id="lblRefNo">*</span>
                                <input type="text" class="form-control" name="txtRefNo" id="txtRefNo">
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
        "url": "../Controllers/DocPayController.php?Choice=GetDocPayList",
        "dataSrc": ""
    },
    "columns": [{
            data: "FullName"
        },
        {
            data: "Amount"
        },
        {
            data: "PaidDate"
        },
        {
            data: "PayMode"
        },
        {
            data: "RefNo"
        },
        {
            data: "DocPayId"
        }
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [{
            'targets': 5,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var DeleteDocPay = 'DeleteDocPay(' + data + ')';
                var GetOnlyDocPay = 'GetOnlyDocPay(' + data + ')';
                return "<i class= 'fas fa-trash' onclick='" + DeleteDocPay +
                    "'></i>&nbsp;&nbsp;<i class= 'fas fa-edit' onclick='" + GetOnlyDocPay + "'></i>"
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
        Cnt = IsEmpty("txtDoctorId", "lblDoctorId", Cnt);
        Cnt = IsEmpty("txtAmount", "lblAmount", Cnt);
        Cnt = IsEmpty("txtPaidDate", "lblPaidDate", Cnt);
        Cnt = IsEmpty("txtPaymentMethod", "lblPaymentMethod", Cnt);
        Cnt = IsEmpty("txtRefNo", "lblRefNo", Cnt);
        Cnt = CheckFutureDate("txtPaidDate", "lblPaidDate", Cnt);

        if (Cnt == 0) {
            var Data = {
                "DocPayId": $("#txtId").val(),
                "DoctorId": $("#txtDoctorId").val(),
                "Amount": $("#txtAmount").val(),
                "PaidDate": $("#txtPaidDate").val(),
                "PayMode": $("#txtPaymentMethod").val(),
                "RefNo": $("#txtRefNo").val(),
            };

            $.ajax({
                url: "../Controllers/DocPayController.php?Choice=AddDocPay",
                type: "POST",
                data: JSON.stringify(Data),
                contentType: "app/json",
                success: function(response) {
                    $("#DocPayModel").modal("hide");
                    cancle();
                    showToast(response);
                    dt.ajax.reload(null, false);
                }
            });
        }
    });
});

function DeleteDocPay(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/DocPayController.php?Choice=DeleteDocPay",
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

function GetOnlyDocPay(Id) {
    $.ajax({
        url: "../Controllers/DocPayController.php?Choice=GetOnlyDocPay",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var jsonData = JSON.parse(data);
            $("#txtDoctorId").val(jsonData.DoctorId);
            $("#txtAmount").val(jsonData.Amount);
            $("#txtPaidDate").val(jsonData.PaidDate);
            $("#txtPaymentMethod").val(jsonData.PaidDate);
            $("#txtRefNo").val(jsonData.RefNo);
            $("#txtId").val(jsonData.DocPayId);
            $("#DocPayModel").modal("show");
            $("#btnADD").html("Edit");
        }
    });
}

function getDoctor() {
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
}

getDoctor();

function cancle() {
    $("#txtDoctorId").val("");
    $("#txtAmount").val("");
    $("#txtPaidDate").val("");
    $("#txtPaymentMethod").val("");
    $("#txtRefNo").val("");
    $("#btnADD").html("Save");
}
</script>

<?php
   include"PageFotter.php";
?>