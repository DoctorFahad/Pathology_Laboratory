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


$(document).ready(function(){
    $("#btnADD").click(function(){
        $.ajax(
        {
            url: "../Controllers/DeliveryController.php?Choice=AddDelivery",
            type: "POST",
            data: JSON.stringify({
                "PickUpId": $("#txtId").val(),
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
        "url": "../Controllers/PickUpController.php?Choice=GetStaffPickupReceiptList&Id=" + getCookie("DBId"),
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
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [
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