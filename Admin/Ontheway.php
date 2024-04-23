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
                            <h4 class="mb-0">On the Way</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th><i>Invoive No.</i></th>
                                            <th><i>Patient Name</i></th>
                                            <th><i>Doctor Name</i></th>
                                            <th><i>Hospital Name</i></th>
                                            <th><i>Date</i></th>
                                            <th><i>Total</i></th>
                                            <th><i>Prority</i></th>
                                            <th>Delivery Boy</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                $Query = "SELECT rec.ReceiptId, rec.Priority, rec.Total, rec.Date, hos.HospitalName, pat.FullName as 'PatName', doc.FullName as 'DocName', db.FullName as 'DeliveryBoy', pick.DBId, pick.PickUpId from receiptmaster as rec 
                                                                    join hospital as hos on rec.HospitalId = hos.HospitalId 
                                                                    join patientmaster as pat on rec.PatientId = pat.PatientId 
                                                                    join doctor as doc on rec.DoctorId = doc.DoctorId
                                                                    join staff as stf on rec.StaffId = stf.StaffId 
                                                                    join pickup as pick on pick.ReceiptId = rec.ReceiptId
                                                                    join deliveryboy as db on pick.DBId = db.DBId
                                                                    where pick.PickUpId not in (select PickUpId from delivery);";
                                                $res = mysqli_query($Con, $Query);
                                                while ($row = mysqli_fetch_assoc($res))
                                                {
                                            ?>
                                        <tr>
                                            <td><?php echo $row["ReceiptId"]; ?></td>
                                            <td><?php echo $row["Priority"]; ?></td>
                                            <td><?php echo $row["Total"]; ?></td>
                                            <td><?php echo $row["Date"]; ?></td>
                                            <td><?php echo $row["HospitalName"]; ?></td>
                                            <td><?php echo $row["PatName"]; ?></td>
                                            <td><?php echo $row["DocName"]; ?></td>
                                            <td><?php echo $row["DeliveryBoy"]; ?></td>
                                            <td>
                                                <a onclick='GetOnlyReceipt(<?php echo $row["PickUpId"]; ?>, <?php echo $row["DBId"]; ?>)'
                                                    href="#"><i class='fas fa-thumbs-up'></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                                }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<input type="hidden" name='txtId' id='txtId' value='0' />
<input type="hidden" name='txtDBId' id='txtDBId' value=''/>
<div class="modal" id="DeliveryBoyModel">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Are you sure this sample is delivered?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" id="btnADD">Yes</button>
                <button type="reset" class="btn btn-danger" id="btnCANCLE" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#btnADD").click(function(){
        $.ajax(
        {
            url: "../Controllers/DeliveryController.php?Choice=AddDelivery",
            type: "POST",
            data: JSON.stringify({
                "PickUpId": $("#txtId").val(),
                "DBId" :  $("#txtDBId").val() 
            }),
            contentType: "app/json",
            success: function(response) {
                showToast(response);
                window.location.href = "";
            }
        });
        $("#DeliveryBoyModel").modal("hide");
    });
});
function GetOnlyReceipt(Id, DBId) {
    $("#txtId").val(Id);
    $("#txtDBId").val(DBId);
    $("#DeliveryBoyModel").modal("show");
}
</script>

<?php
   include"PageFotter.php";
?>