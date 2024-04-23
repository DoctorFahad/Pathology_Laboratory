<?php
    require_once "../DBOperations/ManagePickUp.php";
    require_once "../Models/PickUpModel.php";
 
 
    if(isset($_REQUEST["Choice"]))
    {
                     $Ch = $_REQUEST["Choice"];
                     $Obj= new ManagePickUp();
 
            switch ($Ch)
            {
                case "AddPickUp":
                    $Jsondata = Json_decode(file_get_contents("php://input"));
                    $Model= new PickUpModel();
                    $Model->ReceiptId= $Jsondata->ReceiptId;
                    $Model->PickUpDate= date("Y-m-d");
                    $Model->DBId= $Jsondata->DBId;
                    echo $Obj->AddPickUp($Model);             
                break;
              
                case "GetStaffPickupReceiptList":
                    echo $Obj->GetStaffPickupReceiptList($_REQUEST["Id"]);
                break;

                case "GetPickUpList": 
                    echo $Obj->GetPickUpList();
                break;

                case "GetOnlyPickUp" :
                    $Jsondata = Json_decode(file_get_contents("php://input"));
                    $Id = $Jsondata->Id;
                    echo  $Obj->GetOnlyPickUp($Id);
                break;
              
                case "DeletePickUp" :
                    $Jsondata = Json_decode(file_get_contents("php://input"));
                    $Id = $Jsondata->Id;
                    echo  $Obj->DeletePickUp($Id);
                break; 

                case "UpdatePickUpDetail":
                    $Jsondata = Json_decode(file_get_contents("php://input"));
                    $Model= new PickUpModel();
                    $Model->PickUpId = $Jsondata->PickUpId;
                    $Model->ReceiptId= $Jsondata->ReceiptId;
                    $Model->PickUpDate= $Jsondata->PickUpDate;
                    $Model->DBId= $Jsondata->DBId;
                    $Obj->UpdatePickUpDetail($Model);
                break;
            }
    }
?>