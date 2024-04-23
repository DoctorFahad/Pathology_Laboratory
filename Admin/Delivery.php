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
                            <h4 class="mb-0">Delivery Details</h4>
                        </div>
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#DeliveryModel"
                                        class='btn btn-dark'>Add Delivery</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><i>PickUpId</i></th>
                                                    <th><i>DeliveryDate</i></th>
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

<div class="modal" id="DeliveryModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add Delivery</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <b>PickUp Id</b><span class="error" id="lblPickUpId">*</span>
                                <select name="txtPickUpId" id="txtPickUpId" class="form-control">
                                    <option value="">Select PickUp</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Delivery Date</b><span class="error" id="lblDeliveryDate">*</span>
                                <input type="date" class="form-control" name="txtDeliveryDate" id="txtDeliveryDate">
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
        "url": "../Controllers/DeliveryController.php?Choice=GetDeliveryList",
        "dataSrc": ""
    },
    "columns": [{
            data: "PickUpId"
        },
        {
            data: "DeliveryDate"
        },
        {
            data: "DeliveryId"
        },
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [{
            'targets': 2,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var DeleteDelivery = 'DeleteDelivery(' + data + ')';
                var GetOnlyDelivery = 'GetOnlyDelivery(' + data + ')';
                return "<i class= 'fas fa-trash' onclick='" + DeleteDelivery +
                    "'></i>&nbsp;&nbsp;<i class= 'fas fa-edit' onclick='" + GetOnlyDelivery + "'></i>"
            }
        },
        {
            'targets': 0,
            'orderable': false,
        },
        {
            'targets': 1,
            'orderable': false,
        }
    ]
});

$(document).ready(function() {
    $("#btnADD").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtPickUpId", "lblPickUpId", Cnt);
        Cnt = IsEmpty("txtDeliveryDate", "lblDeliveryDate", Cnt);
        Cnt = CheckFutureDate("txtDeliveryDate", "lblDeliveryDate", Cnt);
        
        if (Cnt == 0) {
            var Data = {
                "DeliveryId": $("#txtId").val(),
                "PickUpId": $("#txtPickUpId").val(),
                "DeliveryDate": $("#txtDeliveryDate").val(),
            };

            $.ajax({
                url: "../Controllers/DeliveryController.php?Choice=AddDelivery",
                type: "POST",
                data: JSON.stringify(Data),
                contentType: "app/json",
                success: function(response) {
                    $("#DeliveryModel").modal("hide");
                    cancle();
                    showToast(response);
                    dt.ajax.reload(null, false);
                }
            });
        }
    });
});

function DeleteDelivery(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/DeliveryController.php?Choice=DeleteDelivery",
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

function GetOnlyDelivery(Id) {
    $.ajax({
        url: "../Controllers/DeliveryController.php?Choice=GetOnlyDelivery",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var jsonData = JSON.parse(data);
            $("#txtPickUpId").val(jsonData.PickUpId);
            $("#txtDeliveryDate").val(jsonData.DeliveryDate);
            $("#txtId").val(jsonData.DeliveryId);
            $("#DeliveryModel").modal("show");
            $("#btnADD").html("Edit");
        }
    });
}

function getPickUp() {
    $.ajax({
        url: "../Controllers/PickUpController.php?Choice=GetPickUpList",
        type: "POST",
        success: function(response) {
            var Data = JSON.parse(response);
            Data.map(o => {
                $("#txtPickUpId").append("<option value='" + o.PickUpId + "'>" + o.PickUpId +
                    "</option>");
            });
        }
    });
}

getPickUp();

function cancle() {
    $("#txtPickUpId").val("");
    $("#txtDeliveryDate").val("");
    $("#btnADD").html("Save");
}
</script>

<?php
   include"PageFotter.php";
?>