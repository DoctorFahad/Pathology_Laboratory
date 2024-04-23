<?php
    require_once "../DBOperations/ManageDoctor.php";
    require_once "../Models/DoctorModel.php";
 
 
    if(isset($_REQUEST["Choice"]))
    {
                     $Ch = $_REQUEST["Choice"];
                     $Obj= new ManageDoctor();
 
             switch ($Ch)
            {
              case "AddDoctor":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new DoctorModel();
                 $Model->DoctorId = $Jsondata->DoctorId;
                 $Model->HospitalId= $Jsondata->HospitalId;
                 $Model->FullName= $Jsondata->FullName;
                 $Model->Address= $Jsondata->Address;
                 $Model->ContactNo= $Jsondata->ContactNo;
                 $Model->Email= $Jsondata->Email;
                 $Model->Alternate= $Jsondata->Alternate;
                 $Model->Commission= $Jsondata->Commission;

                 if($Jsondata->DoctorId == 0)
                      {
                        echo $Obj->AddDoctor($Model);
                      }
                  else
                      {
                        echo $Obj->UpdateDoctorDetail($Model);
                      }                
              break;
              
              case "GetDoctorList": 
                  echo $Obj->GetDoctorList();
              break;

              case "GetDoctorReference": 
                echo $Obj->GetDoctorReference();
              break;

              case "getDoctorCollection": 
                echo $Obj->getDoctorCollection();
              break;  
              case "GetOnlyDoctor" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->GetOnlyDoctor($Id);
              break;
              
              case "DeleteDoctor" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->DeleteDoctor($Id);
              break; 

              case "UpdateDoctorDetail":
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Model= new DoctorModel();
                $Model->DoctorId = $Jsondata->DoctorId;
                $Model->HospitalId= $Jsondata->HospitalId;
                 $Model->FullName= $Jsondata->FullName;
                 $Model->Address= $Jsondata->Address;
                 $Model->ContactNo= $Jsondata->ContactNo;
                 $Model->Email= $Jsondata->Email;
                 $Model->Alternate= $Jsondata->Alternate;
                 $Model->Commission= $Jsondata->Commission;
                $Obj->UpdateDoctorDetail($Model);
            break;
              
            }
    }
?>