<?php
    require_once "../DBOperations/ManageHosAllocation.php";
    require_once "../Models/HosAllocationModel.php";
 
 
    if(isset($_REQUEST["Choice"]))
    {
                     $Ch = $_REQUEST["Choice"];
                     $Obj= new ManageHosAllocation();
 
             switch ($Ch)
            {
              case "AddHosAllocation":
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Model = new HosAllocationModel();
                $Model->AllocationId= $Jsondata->AllocationId;
                $Model->HospitalId= $Jsondata->HospitalId;
                $Model->StaffId= $Jsondata->StaffId;
                $Model->AllocationDate= $Jsondata->AllocationDate;
                
                if($Jsondata->AllocationId == 0)
                {
                    echo $Obj->AddHosAllocation($Model);
                }
                else
                {
                    echo $Obj->UpdateHosAllocation($Model);
                }                
              break;
              
              case "GetHosAllocationList": 
                  echo $Obj->GetHosAllocationList();
              break;

              case "GetOnlyHosAllocation" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->GetOnlyHosAllocation($Id);
              break;
              
              case "DeleteHosAllocation" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->DeleteHosAllocation($Id);
              break; 

              case "UpdateHosAllocation":
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Model= new HosAllocationModel();
                $Model->AllocationId = $Jsondata->AllocationId;
                $Model->HospitalId= $Jsondata->HospitalId;
                $Model->StaffId= $Jsondata->StaffId;
                $Model->AllocationDate= $Jsondata->AllocationDate;
                $Obj->UpdateDoctorDetail($Model);
                break;
            }
    }
?>