<?php
    require_once "../DBOperations/ManageDocPay.php";
    require_once "../Models/DocPayModel.php";
 
 
    if(isset($_REQUEST["Choice"]))
    {
                     $Ch = $_REQUEST["Choice"];
                     $Obj= new ManageDocPay();
 
             switch ($Ch)
            {
              case "AddDocPay":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new DocPayModel();
                 $Model->DoctorId= $Jsondata->DoctorId;
                 $Model->Amount= $Jsondata->Amount;
                 $Model->PaidDate= $Jsondata->PaidDate;
                 $Model->PayMode= $Jsondata->PayMode;
                 $Model->RefNo= $Jsondata->RefNo;

                 echo $Obj->AddDocPay($Model);              
              break;
              
              case "GetDocPayList": 
                  echo $Obj->GetDocPayList();
              break;


              case "GetDoctorPayReports": 
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $dtFrom = $Jsondata->dtFrom;
                $dtTo = $Jsondata->dtTo;
                echo $Obj->GetDoctorPayReports($dtFrom,$dtTo);
              break;

              case "GetOnlyDocPay" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->GetOnlyDocPay($Id);
              break;
              
              case "DeleteDocPay" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->DeleteDocPay($Id);
              break; 

              case "UpdateDocPay":
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Model= new DocPayModel();
                $Model->DocPayId = $Jsondata->DocPayId;
                $Model->DoctorId= $Jsondata->DoctorId;
                $Model->Amount= $Jsondata->Amount;
                $Model->PaidDate= $Jsondata->PaidDate;
                $Model->PayMode= $Jsondata->PayMode;
                $Model->RefNo= $Jsondata->RefNo;
                $Obj->UpdateDocPay($Model);
            break;
              
            }
    }
?>