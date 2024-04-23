<?php
    require_once "../DBOperations/ManageReceipt.php";
    require_once "../Models/ReceiptModel.php";
    require_once "../Models/RecDetailModel.php";
 
    if(isset($_REQUEST["Choice"]))
    {
            $Ch = $_REQUEST["Choice"];
            $Obj= new ManageReceipt();
 
             switch ($Ch)
            {
              case "AddReceipt":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new ReceiptModel();
                 $Model->ReceiptId= $Jsondata->ReceiptId;
                 $Model->PatientId= $Jsondata->PatientId;
                 $Model->DoctorId= $Jsondata->DoctorId;
                 $Model->HospitalId= $Jsondata->HospitalId;
                 $Model->PaymentMode= $Jsondata->PaymentMode;
                 $Model->ReferenceNo= $Jsondata->ReferenceNo;
                 $Model->Date= $Jsondata->Date;
                 $Model->Total= $Jsondata->Total;
                 $Model->Priority= $Jsondata->Priority;
                 $Model->StaffId = $Jsondata->StaffId;
                 $testsJson = Json_decode($Jsondata->tests, true);
                 echo $Obj->AddReceipt($Model);
                
                 foreach ($testsJson as $item) {
                    $Model = new RecDetailModel();
                    $Model->TestId = $item["TestId"];
                    $Model->ReceiptId = $Jsondata->ReceiptId;
                    $Model->Cost = $item["Cost"];
                    $Obj->insertRecDetail($Model);
                  }

                echo "Save";
              break;
              
              case "GetReceiptList": 
                      echo $Obj->GetReceiptList();
              break;

              case "ReceiptDetails": 
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo $Obj->GetReceiptDetails($Id);
              break;

              case "GetReceiptReports": 
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $dtFrom = $Jsondata->dtFrom;
                $dtTo = $Jsondata->dtTo;
                echo $Obj->GetReceiptReports($dtFrom,$dtTo);
              break;

              case "getReceiptNo": 
                echo $Obj->getReceiptNo();
              break;

              case "GetOnlyReceipt":
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->GetOnlyReceipt($Id);
              break;

              case "GetOnlyReceipts":
                echo  $Obj->GetOnlyReceipts($_REQUEST["Id"]);
              break;
              
              case "DeleteReceipt" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->DeleteReceipt($Id);
              break; 

              case "UpdateReceiptDetail":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new ReceiptModel();
                 $Model->ReceiptId= $Jsondata->ReceiptId;
                 $Model->PatientId= $Jsondata->PatientId;
                 $Model->DoctorId= $Jsondata->DoctorId;
                 $Model->HospitalId= $Jsondata->HospitalId;
                 $Model->PaymentMode= $Jsondata->PaymentMode;
                 $Model->ReferenceNo= $Jsondata->ReferenceNo;
                 $Model->Date= $Jsondata->Date;
                 $Model->Total= $Jsondata->Total;
                 $Model->Priority= $Jsondata->Priority;
                $Obj->UpdateReceiptDetail($Model);
              break;
              
              case "GetStaffReceiptList": 
               echo $Obj->GetStaffReceiptList();
              break;
              
              case "GetReceipts": 
                echo $Obj->GetReceipts();
              break;
            }
    }
?>