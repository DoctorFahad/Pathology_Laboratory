<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrecisionLab Solution</title>
    <script src="../Content/Admin/datatable/jquery-3.7.0.js"></script>

</head>

<body>

    <div class="container" id="content">
        <style>
        body {
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }

        .brand-section {
            background-color: #0d1033;
            padding: 10px 40px;
        }

        .logo {
            width: 50%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-6 {
            width: 50%;
            flex: 0 0 auto;
        }

        .text-white {
            color: #fff;
        }

        .company-details {
            float: right;
            text-align: right;
        }

        .body-section {
            padding: 16px;
            border: 1px solid gray;
        }

        .heading {
            font-size: 20px;
            margin-bottom: 08px;
        }

        .sub-heading {
            color: #262626;
            margin-bottom: 05px;
        }

        table {
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }

        table thead tr {
            border: 1px solid #111;
            background-color: #f2f2f2;
        }

        table td {
            vertical-align: middle !important;
            text-align: center;
        }

        table th,
        table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }

        .table-bordered {
            box-shadow: 0px 0px 5px 0.5px gray;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .text-right {
            text-align: end;
        }

        .w-20 {
            width: 20%;
        }

        .float-right {
            float: right;
        }
        </style>
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-white">PrecisionLab Solution</h1>
                </div>
                <div class="col-6">
                <div class="company-details">
                        <p class="text-white">precisionlabmanagement@gmail.com</p>
                        <p class="text-white">+91 9897969594</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">Invoice No.: <span id="lblInvoiceNo"></span></h2>
                    <p class="sub-heading">Date: <span id="lblDate"></span> </p>
                    <p class="sub-heading">Priority: <span id="lblPriority"></span></p>
                </div>
                <div class="col-6">
                    <p class="sub-heading">Patient: <span id="lblPatient"></span></p>
                    <p class="sub-heading">Doctor: <span id="lblDoctor"></span></p>
                    <p class="sub-heading">Hospital: <span id="lblHospital"></span></p>
                    <p class="sub-heading">Reference No. <span id="lblReferenceNo"></span></p>
                </div>
            </div>
        </div>

        <div class="body-section">
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th class="w-20">Test Name</th>
                        <th class="w-20">Result</th>
                        <th class="w-20">Normal Range</th>
                        <th class="w-20">Unit</th>
                    </tr>
                </thead>
                <tbody id='details'>
                    <?php
                    $Id = $_REQUEST["InvoiceId"];
                    $Query = "select * from reportresult as a 
                                            join  testdetails as b on a.TestId = b.TestId and a.ReceiptId=$Id";

                    $Con = mysqli_connect("localhost", "root", "", "pathologylab_db");
                    $res = mysqli_query($Con, $Query);
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($res))
                    {
                        $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["TestName"]; ?></td>
                        <td><?php echo $row["Result"]; ?></td>
                        <td><?php echo $row["NormalRange"]; ?></td>
                        <td><?php echo $row["Unit"]; ?></td>
                    </tr>
                    <?php
                    }
                ?>
                </tbody>
            </table>
        </div>

        <div class="body-section">
            <p>&copy; Copyright 2024 - PrecisionLab Solutions. All rights reserved.
            </p>
        </div>
    </div>
    <br><br>
    <center>
        <button type='button' style='height: 50px; width: 300px;' onclick="printDiv()">Print</button>
    </center>
</body>

</html>

<script>
$(document).ready(function() {
    $.ajax({
        url: "../Controllers/ReceiptController.php?Choice=GetOnlyReceipt",
        type: "POST",
        contentType: "app/json",
        data: JSON.stringify({
            "Id": <?php echo $_REQUEST["InvoiceId"]; ?>
        }),
        success: function(res) {
            var jsonData = JSON.parse(res);
            $("#lblInvoiceNo").html(jsonData.ReceiptId);
            $("#lblDate").html(jsonData.Date);
            $("#lblPriority").html(jsonData.Priority);
            $("#lblPatient").html(jsonData.Patient);
            $("#lblDoctor").html(jsonData.Doctor);
            $("#lblHospital").html(jsonData.HospitalName);
            $("#lblReferenceNo").html(jsonData.ReferenceNo);
            $("#lblPaymentMode").html(jsonData.PaymentMode);
        }
    });

});
</script>

<script>
function printDiv() {
    var contentDiv = document.getElementById('content');
    var contentToPrint = contentDiv.innerHTML;
    var originalContent = document.body.innerHTML;

    // Replace the content of the body with the content of the div
    document.body.innerHTML = contentToPrint;

    // Print the content
    window.print();

    // Restore original content
    document.body.innerHTML = originalContent;
}
</script>