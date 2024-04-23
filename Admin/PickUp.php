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
                            <h4 class="mb-0">PickUp Details</h4>
                        </div>
                        //new changes
                        <input type="hidden" id="txtId" value='0' />
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#PickUpModel"
                                        class='btn btn-dark'>Add PickUp</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id='dataTable' class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><i>ReceiptId</i></th>
                                                    <th><i>PickUpDate</i></th>
                                                    <th><i>DBId</i></th>
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

<div class="modal" id="PickUpModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Add PickUp</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <b>Receipt Id</b><span class='error' id='lblReceiptId'>*</span>
                                <select name="txtReceiptId" id="txtReceiptId" class="form-control">
                                    <option value="">Select Receipt</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>PickUp Date</b><span class='error' id='lblPickUpDate'>*</span>
                                <input type="Date" class="form-control" name="txtPickUpDate" id="txtPickUpDate">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>DBId</b><span class='error' id='lblDBId'>*</span>
                                <input type="number" class="form-control" name="txtDBId" id="txtDBId">
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
        "url": "../Controllers/PickUpController.php?Choice=GetPickUpList",
        "dataSrc": ""
    },
    "columns": [{
            data: "ReceiptId"
        },
        {
            data: "PickUpDate"
        },
        {
            data: "DBId"
        },
        {
            data: "PickUpId"
        },
        {
            data: "PickUpId"
        },
    ],
    "retrieve": true,
    "destroy": true,
    "columnDefs": [{
            'targets': 3,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var DeletePickup = 'DeletePickup(' + data + ')'
                return "<i class= 'fas fa-trash' onclick='" + DeletePickup + "'></i>"
            }
        },
        {
            'targets': 4,
            'searchable': false,
            'orderable': false,
            'className': 'text-center',
            'render': function(data, type, full, meta) {
                var GetOnlyPickUp = 'GetOnlyPickUp(' + data + ')'
                return "<i class= 'fas fa-edit' onclick='" + GetOnlyPickUp + "'></i>"
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
        }
    ]
});

$(document).ready(function() {
    $("#btnADD").click(function() {
        var Cnt = 0;
        Cnt = IsEmpty("txtReceiptId", "lblReceiptId", Cnt);
        Cnt = IsEmpty("txtPickUpDate", "lblPickUpDate", Cnt);
        Cnt = IsEmpty("txtDBId", "lblDBId", Cnt);

        if (Cnt == 0) {
            var Data = {
                "PickUpId": $("#txtId").val(),
                "ReceiptId": $("#txtReceiptId").val(),
                "PickUpDate": $("#txtPickUpDate").val(),
                "DBId": $("#txtDBId").val(),
            };

            $.ajax({
                url: "../Controllers/PickUpController.php?Choice=AddPickUp",
                type: "POST",
                data: JSON.stringify(Data),
                contentType: "app/json",
                success: function(response) {
                    $("#PickUpModel").modal("hide");
                    cancle();
                    showToast(response);
                    dt.ajax.reload(null, false);
                }
            });
        }
    });
});

function DeletePickUp(Id) {
    if (confirm("Are You Sure Want To Delete These")) {
        $.ajax({
            url: "../Controllers/PickUpController.php?Choice=DeletePickUp",
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

function GetOnlyPickUp(Id) {
    $.ajax({
        url: "../Controllers/PickUpController.php?Choice=GetOnlyPickUp",
        type: "POST",
        data: JSON.stringify({
            "Id": Id
        }),
        contentType: "app/json",
        success: function(data) {
            var jsonData = JSON.parse(data);
            $("#txtReceiptId").val(jsonData.ReceiptId);
            $("#txtPickUpDate").val(jsonData.PickUpDate);
            $("#txtDBId").val(jsonData.DBId);
            $("#txtId").val(jsonData.PickUpId);
            $("#PickUpModel").modal("show");
            $("#btnADD").html("Edit");
        }
    });
}

function getReceipt() {
    $.ajax({
        url: "../Controllers/ReceiptController.php?Choice=GetReceiptList",
        type: "POST",
        success: function(response) {
            var Data = JSON.parse(response);
            Data.map(o => {
                $("#txtReceiptId").append("<option value='" + o.ReceiptId + "'>" + o.ReceiptId +
                    "</option>");
            });
        }
    });
}

getReceipt();

function cancle() {
    $("#txtReceiptId").val();
    $("#txtPickUpDate").val();
    $("#txtDBId").val();
    $("#btnADD").html("Save");
}
</script>

<?php
   include"PageFotter.php";
?>