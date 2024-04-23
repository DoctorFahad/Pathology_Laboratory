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
                            <h4 class="mb-0">Receipt List</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Receipt No</th>
                                                    <th>Patient Details</th>
                                                    <th>Doctor</th>
                                                    <th>Total Cost</th>
                                                    <th>Payment Details</th>
                                                    <th>Receipt Date</th>
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

<div class="modal" id="DoctorModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add Doctor</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
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
        "url": "../Controllers/ReceiptController.php?Choice=GetReceipts",
        "dataSrc": ""
    },
    "columns": [{
            data: "ReceiptId"
        },
        {
            data: "FullName"
        },
        {
            data: "DocName"
        },
        {
            data: "Total"
        },
        {
            data: "PaymentMode"
        },
        {
            data: "Date"
        },
        {
            data: "ReceiptId"
        },
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [
        {
            'targets': 1,
            'orderable': false,
            'render': function(data, type, full, meta) {
                return full["FullName"] + "<br />" + full["ContactNo"] + ", " + full["Gender"] +
                    "<br />" + full["DOB"];
            }
        },
        {
            'targets': 3,
            'orderable': false,
            'render': function(data, type, full, meta) {
                return full["Total"];
            }
        },
        {
            'targets': 5,
            'orderable': false,
            'render': function(data, type, full, meta) {
                return full["Date"];
            }
        },
        {
            'targets': 4,
            'orderable': false,
            'render': function(data, type, full, meta) {
                return full["PaymentMode"] + ", " + full["ReferenceNo"];
            }
        },
        {
            'targets': 6,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                return "<a href='GenerateReport.php?Id=" + data + "'><i class= 'fas fa-edit'></i></a>&nbsp;<a href='PrintReceipt.php?InvoiceId=" + data + "'><i class= 'fas fa-print'></i></a>"
            }
        },
        {
            'targets': [0, 1, 2, 3, 4,5],
            'orderable': false,
        }
    ]
});

</script>

<?php
   include"PageFotter.php";
?>