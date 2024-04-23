<?php
    require_once "../DBOperations/ManageHospital.php";
    require_once "../Models/HospitalModel.php";
 
 
    if(isset($_REQUEST["Choice"]))
    {
                     $Ch = $_REQUEST["Choice"];
                     $Obj= new ManageHospital();
 
             switch ($Ch)
            {
              case "AddHospital":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new HospitalModel();
                 $Model->HospitalId = $Jsondata->HospitalId;
                 $Model->HospitalName= $Jsondata->HospitalName;
                 $Model->Address= $Jsondata->Address;
                 $Model->ContactNo= $Jsondata->ContactNo;
                 $Model->Alternate= $Jsondata->Alternate;
                 $Model->Email= $Jsondata->Email;
           
                 if($Jsondata->HospitalId == 0)
                      {
                        echo $Obj->AddHospital($Model);
                      }
                  else
                      {
                        echo $Obj->UpdateHospitalDetail($Model);
                      } 	
              break;
              
              case "GetHospitalList": 
                  echo $Obj->GetHospitalList();
              break;

              case "GetOnlyHospital" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->GetOnlyHospital($Id);
              break;
              
              case "DeleteHospital" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->DeleteHospital($Id);
              break; 

              case "UpdateHospitalDetail":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new HospitalModel();
                 $Model->HospitalId = $Jsondata->HospitalId;
                 $Model->HospitalName= $Jsondata->HospitalName;
                 $Model->Address= $Jsondata->Address;
                 $Model->ContactNo= $Jsondata->ContactNo;
                 $Model->Alternate= $Jsondata->Alternate;
                 $Model->Email= $Jsondata->Email;
                $Obj->UpdateHospitalDetail($Model);
            break;
              
            case "GetHospitalReports": 
              echo $Obj->GetHospitalReports();
            break;
            }
    }
?>