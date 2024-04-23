<?php
   include"PageTop.php";
?>
<form class="content-wraper-area">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="container">
                                    <div class="body-section">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6 class="heading">Invoice No.: <span id="lblInvoiceNo"></span>
                                                </h6>
                                                <p class="sub-heading">Date: <span id="lblDate"></span> </p>
                                                <p class="sub-heading">Priority: <span id="lblPriority"></span></p>
                                            </div>
                                            <div class="col-6">
                                                <p class="sub-heading">Patient: <span id="lblPatient"></span></p>
                                                <p class="sub-heading">Doctor: <span id="lblDoctor"></span></p>
                                                <p class="sub-heading">Hospital: <span id="lblHospital"></span></p>
                                                <p class="sub-heading">Reference No. :<span id="lblReferenceNo"></span>
                                                </p>
                                            </div>
                                            <div class="col-md-12">
                                                <table class='table table-bordered'>
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Test</th>
                                                            <th>Result</th>
                                                            <th>Range</th>
                                                            <th>Unit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id='resultList'></tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-12">
                                                <button type='button' id='btnSave' class='btn btn-primary'>Save</button>
                                                <a class='btn btn-primary' href="printReport.php?InvoiceId=<?php echo $_REQUEST["Id"]; ?>">Print</a>
                                            </div>
                                        </div>
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
$(document).ready(function() {

    $("#btnSave").click(function(){
        var testResult = [];
        $("tbody").find("tr").each(function() {
            var result = $(this).find("input[type='text']").val();
            var testId = $(this).find("input[type='hidden']").val();
            testResult.push({
                "ReceiptId" : <?php echo $_REQUEST["Id"]; ?>,
                "TestId" : testId,
                "result" : result
            });
        });    

        $.ajax({
            url: "../Controllers/ReportResultController.php?Choice=AddReportResult",
            type: "POST",
            data: JSON.stringify(testResult),
            contentType: "app/json",
            success: function(res) {
                console.log(res);
                console.log(testResult);
            }
        });
        
    });


    $.ajax({
        url: "../Controllers/ReceiptController.php?Choice=GetOnlyReceipts&Id=<?php echo $_REQUEST["Id"]; ?>",
        type: "POST",
        contentType: "app/json",
        success: function(res) {
            console.log(res);
            var jsonData = JSON.parse(res);
            $("#lblInvoiceNo").html(jsonData.ReceiptId);
            $("#lblDate").html(jsonData.Date);
            $("#lblPriority").html(jsonData.Priority);
            $("#lblPatient").html(jsonData.FullName);
            $("#lblDoctor").html(jsonData.DocName);
            $("#lblHospital").html(jsonData.HospitalName);
            $("#lblReferenceNo").html(jsonData.ReferenceNo);
            $("#lblPaymentMode").html(jsonData.PaymentMode);
        }
    });

    $.ajax({
        url: "../Controllers/ReportResultController.php?Choice=GetReportResultList&Id=<?php echo $_REQUEST["Id"]; ?>",
        type: "POST",
        contentType: "app/json",
        success: function(res) {
            console.log(res);
            res = JSON.parse(res);
            res.map(o=> {
                $("#resultList").append("<tr class='receipts'><td><input type='hidden' value='" + o.TestId +  "' class='form-control' />" +  o.TestId + "</td><td>" +  o.TestName + "</td><td><input type='text' value='" + o.Result + "' class='txtResult form-control' /></td><td>" +  o.NormalRange + "</td><td>" +  o.Unit + "</td></tr>");
            });
        }
    });
});
</script>

<?php
   include"PageFotter.php";
?>