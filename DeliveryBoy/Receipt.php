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
                            <h4 class="mb-0">Receipt Details</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><i>Invoive No.</i></th>
                                                    <th><i>Patient Name</i></th>
                                                    <th><i>Doctor Name</i></th>
                                                    <th><i>Hospital Name</i></th>
                                                    <th><i>Date</i></th>
                                                    <th><i>Total</i></th>
                                                    <th><i>Prority</i></th>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Are you sure you have Picked this Sample?</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" id="btnADDPickUp">PickedUp</button>
                <button type="reset" class="btn btn-danger" id="btnCANCLE"
                    data-bs-dismiss="modal">CANCLE</button>
            </div>
        </div>
    </div>
</div>


<script>


$(document).ready(function(){
    $("#btnADDPickUp").click(function(){
        $.ajax(
        {
            url: "../Controllers/PickUpController.php?Choice=AddPickUp",
            type: "POST",
            data: JSON.stringify({
                "ReceiptId": $("#txtId").val(),
                "DBId" :  getCookie("DBId") 
            }),
            contentType: "app/json",
            success: function(response) {
                showToast(response);
                dt.ajax.reload(null, false);
            }
        });
        $("#DeliveryBoyModel").modal("hide");
    });
});


var dt = $("#dataTable").DataTable({
    "ajax": {
        "url": "../Controllers/ReceiptController.php?Choice=GetStaffReceiptList",
        "dataSrc": ""
    },
    "columns": [
        {
            data: "ReceiptId"
        },
        {
            data: "PatName"
        },
        {
            data: "DocName"
        },
        {
            data: "HospitalName"
        },
        {
            data: "Date"
        },
        {
            data: "Total"
        },
        {
            data: "Priority"
        },
        {
            data: "ReceiptId"
        },
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [
        {
            'targets': 7,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var GetOnlyReceipt = 'GetOnlyReceipt(' + data + ')'
                return "<i class= 'fas fa-edit' onclick='" + GetOnlyReceipt + "'></i>"
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

function GetOnlyReceipt(Id) {
    $("#txtId").val(Id);
    $("#DeliveryBoyModel").modal("show");
}

</script>

<?php
   include"PageFotter.php";
?>