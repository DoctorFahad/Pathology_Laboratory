<?php
    require_once "../DBOperations/ManageDelivery.php";
    require_once "../Models/DeliveryModel.php";
 
 
    if(isset($_REQUEST["Choice"]))
    {
                     $Ch = $_REQUEST["Choice"];
                     $Obj= new ManageDelivery();
 
             switch ($Ch)
            {
              case "AddDelivery":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new DeliveryModel();
                 $Model->PickUpId = $Jsondata->PickUpId;
                 $Model->DeliveryDate = date("Y-m-d");
                 $Model->DBId = $Jsondata->DBId;
                 echo $Obj->AddDelivery($Model);

              break;

             
              case "GetDeliveryList": 
                  echo $Obj->GetDeliveryList();
              break;

              case "GetOnlyDelivery" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->GetOnlyDelivery($Id);
              break;

              case "GetDeliveredReceiptList":
                echo $Obj->GetDeliveredReceiptList($_REQUEST["Id"]);
            break;
              
              case "DeleteDelivery" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->DeleteDelivery($Id);
              break; 

              case "UpdateDeliveryDetail":
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Model= new DeliveryModel();
                $Model->DeliveryId = $Jsondata->DeliveryId;
                $Model->PickUpId= $Jsondata->PickUpId;
                $Model->DeliveryDate= $Jsondata->DeliveryDate;
                $Obj->UpdateDeliveryDetail($Model);
            break;
              
            }
    }
?>