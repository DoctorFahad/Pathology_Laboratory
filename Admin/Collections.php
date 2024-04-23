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
                            <h4 class="mb-0">Collection Details</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Doctor</th>
                                                    <th>Hospital</th>
                                                    <th>Collection</th>
                                                    <th>No of Receipts</th>
                                                    <th>Paid</th>
                                                    <th>Dues</th>
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

<script>
var dt = $("#dataTable").DataTable({
    "ajax": {
        "url": "../Controllers/DoctorController.php?Choice=getDoctorCollection",
        "dataSrc": ""
    },
    "columns": [{
            data: "FullName"
        },
        {
            data: "Address"
        },
        {
            data: "Collections"
        },
        {
            data: "Count"
        },
        {
            data: "Paid"
        },
        {
            data: "Dues"
        },
        {
            data: "DoctorId"
        }
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [{
            'targets': 0,
            'orderable': false,
            'render': function(data, type, full, meta) {
                return full["FullName"] + "<br />" + full["ContactNo"] + "<br />" + full["Email"];
            }
        },
        {
            'targets': 1,
            'orderable': false,
            'render': function(data, type, full, meta) {
                return full["HospitalName"] + "<br />" + full["Address"];
            }
        },
        {
            'targets': 2,
            'render': function(data, type, full, meta) {
                var collection = parseInt(full["Collections"]);
                var commision = parseInt(full["Commission"]);
                return Math.round((collection * commision) / 100);
            }
        },
        {
            'targets': 5,
            'render': function(data, type, full, meta) {
                var collection = parseInt(full["Collections"]);
                var commision = parseInt(full["Commission"]);
                var Remain = (Math.round((collection * commision) / 100) - full["Paid"]);
                return Remain;
            }
        },
        {
            'targets': 6,
            'render': function(data, type, full, meta) {
                var collection = parseInt(full["Collections"]);
                var commision = parseInt(full["Commission"]);

                var Remain = (Math.round((collection * commision) / 100) - full["Paid"]);

                return "<span onclick='getData(" + data + "," + Remain +
                    ")' data-bs-target='#PaidModal' data-bs-toggle='modal' style='font-size: 30px;'>₹</span>";
            }
        },
        {
            'targets': 6,
            'orderable': false,
        },
        {
            'targets': 4,
            'orderable': false,
        }
    ]
});

function getData(Id, Amount) {
    $("#txtId").val(Id);
    $("#txtAmount").val(Amount);
    $("#txtCommision").val(Amount);
}
</script>
<input type="hidden" id='txtId' name='txtId' value="0" />
<input type="hidden" id='txtCommision' name='txtCommision' value="0" />



<!-- Modal -->
<div id="PaidModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Paid Commision</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <b>Amount</b>
                        <span id='lblAmount'></span>
                        <input type="number" name='txtAmount' id='txtAmount' class='form-control' />
                    </div>
                    <div class="col-md-6 mb-2">
                        <b>Payment Mode</b>
                        <span id='lblPayment'></span>
                        <select name='txtPayment' id='txtPayment' class='form-select'>
                            <option value="Cash">Cash</option>
                            <option value="UPI">UPI</option>
                            <option value="Bank">Bank</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <b>Ref No.</b>
                        <span id='lblRefNo'></span>
                        <input type="number" name='txtRefNo' id='txtRefNo' class='form-control' />
                    </div>
                    <div class="col-md-6 mb-2">
                        <b>Payment Date</b>
                        <span id='lblpayment'></span>
                        <input type="date" name='txtPaymentDate' id='txtPaymentDate' class='form-control' />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type='button' name='btnCommisionSave' id='btnCommisionSave'
                    class='btn btn-primary'>Save</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#btnCommisionSave").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtAmount", "lblAmount", Cnt);
        Cnt = IsEmpty("txtPaymentDate", "lblpayment", Cnt);
        Cnt = CheckFutureDate("txtPaymentDate", "lblpayment", Cnt);

        if (Cnt == 0) {
            var amount = parseFloat($("#txtAmount").val());
            var commision = parseFloat($("#txtCommision").val());

            if (amount <= commision) {
                $("#lblAmount").html("");

                var Data = {
                    "DoctorId": $("#txtId").val(),
                    "Amount": $("#txtAmount").val(),
                    "PaidDate": $("#txtPaymentDate").val(),
                    "PayMode": $("#txtPayment").val(),
                    "RefNo": $("#txtRefNo").val(),
                };
                $.ajax({
                    url: "../Controllers/DocPayController.php?Choice=AddDocPay",
                    type: "POST",
                    data: JSON.stringify(Data),
                    contentType: "app/json",
                    success: function(response) {
                        showToast(response);
                        dt.ajax.reload(null, false);
                    }
                });

            } else {
                $("#lblAmount").html("Not more than ₹" + commision);
            }
        }
    });
});
</script>
<?php
   include"PageFotter.php";
?>