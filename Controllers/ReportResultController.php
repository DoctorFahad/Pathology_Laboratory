<?php
    require_once "../DBOperations/ManageReportResult.php";
    require_once "../Models/ReportResultModel.php";
 
 
    if(isset($_REQUEST["Choice"]))
    {
            $Ch = $_REQUEST["Choice"];
            $Obj= new ManageReportResult();
 
            switch ($Ch)
            {
              case "AddReportResult":
                $Jsondata = json_decode(file_get_contents("php://input"));
                //echo var_dump($Jsondata);
                foreach ($Jsondata as $item) {
                    $Model = new ReportResultModel();
                    $Model->TestId = $item->TestId;
                    $Model->Result = $item->result;
                    $Model->ReceiptId = $item->ReceiptId;
                    echo $Obj->AddReportResult($Model);
                }            
              break;
              
              case "GetReportResultList": 
                  echo $Obj->GetReportResultList($_REQUEST["Id"]);
              break;

              case "GetOnlyReportResult" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->GetOnlyReportResult($Id);
              break;
              
              case "DeleteReportResult" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->DeleteReportResult($Id);
              break; 

              case "UpdateReportResultDetail":
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Model= new ReportResultModel();
                $Model->ReportId = $Jsondata->ReportId;
                $Model->TestId= $Jsondata->TestId;
                $Model->Result= $Jsondata->Result;
                $Obj->UpdateReportResultDetail($Model);
              break;
              
            }
    }
?>