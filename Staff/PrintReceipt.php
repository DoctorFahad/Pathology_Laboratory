<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrecisionLab Solution</title>
    <script src="../Content/Admin/datatable/jquery-3.7.0.js"></script>
    <style>
        body{
            background-color: #F6F6F6; 
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color: #0d1033;
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class="container">
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
            <h3 class="heading">Ordered Items</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Test Name</th>
                        <th class="w-20">Rate</th>
                        <th class="w-20">Qty</th>
                        <th class="w-20">Total</th>
                    </tr>
                </thead>
                <tbody id='details'>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right">Sub Total</td>
                        <td><span id="lblTotal"></span></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">GST Total @18%</td>
                        <td><span id="lblGST"></span></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Grand Total</td>
                        <td><span id="lblNetTotal"></span></td>
                    </tr>
                </tfoot>
            </table>
            <br>
            <h3 class="heading">Payment Status: Paid</h3>
            <h3 class="heading">Payment Mode: <span id="lblPaymentMode"></span></h3>
        </div>

        <div class="body-section">
            <p>&copy; Copyright 2024 - PrecisionLab Solutions. All rights reserved. 
            </p>
        </div>      
    </div>      

</body>
</html>

<script>
    $(document).ready(function(){
        $.ajax({
            url: "../Controllers/ReceiptController.php?Choice=GetOnlyReceipt",
            type: "POST",
            contentType: "app/json",
            data: JSON.stringify({"Id": <?php echo $_REQUEST["InvoiceId"]; ?>}),
            success: function(res)
            {
                var jsonData=JSON.parse(res);
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


        $.ajax({
            url: "../Controllers/ReceiptController.php?Choice=ReceiptDetails",
            type: "POST",
            contentType: "app/json",
            data: JSON.stringify({"Id": <?php echo $_REQUEST["InvoiceId"]; ?>}),
            success: function(res)
            {
                var Total = 0;
                var jsonData=JSON.parse(res);
         
                jsonData.map(o=> {

                    Total += parseInt(o.Cost);

                    $("#details").append("<tr>" +
                                        "<td>" + o.TestName + "</td>" +
                                        "<td>" + o.Cost + "</td>" +
                                        "<td>1</td>" +
                                        "<td>" + o.Cost + "</td>" +
                                    "</tr>");
                });
                
                $("#lblTotal").html(Total);
                $("#lblGST").html(((Total * 18) / 100));
                $("#lblNetTotal").html((Total + ((Total * 18) / 100)));
            }
        });

    });
</script>