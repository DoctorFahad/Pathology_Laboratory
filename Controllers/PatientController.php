<?php
    require_once "../DBOperations/ManagePatient.php";
    require_once "../Models/PatientModel.php";
 
 
    if(isset($_REQUEST["Choice"]))
    {
                     $Ch = $_REQUEST["Choice"];
                     $Obj= new ManagePatient();
 
             switch ($Ch)
            {
              case "AddPatient":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new PatientModel();
                 $Model->PatientId = $Jsondata->PatientId;
                 $Model->FullName= $Jsondata->FullName;
                 $Model->ContactNo= $Jsondata->ContactNo;
                 $Model->DOB= $Jsondata->DOB;
                 $Model->Age= $Jsondata->Age;
                 $Model->Gender= $Jsondata->Gender;
                 $Model->AdharNo= $Jsondata->AdharNo;
                 $Model->Email= $Jsondata->Email;

                 if($Jsondata->PatientId == 0)
                    {
                      echo $Obj->AddPatient($Model);
                    }
                  else
                      {
                        echo $Obj->UpdatePatientDetail($Model);
                      }                      	
              break;
              
              case "GetPatientList": 
                  echo $Obj->GetPatientList();
              break;

              case "GetPatientVisits": 
                echo $Obj->GetPatientVisits();
              break;

              case "GetOnlyPatient" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->GetOnlyPatient($Id);
              break;
              
              case "DeletePatient" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->DeletePatient($Id);
              break; 

              case "UpdatePatientDetail":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new PatientModel();
                 $Model->PatientId = $Jsondata->PatientId;
                 $Model->FullName= $Jsondata->FullName;
                 $Model->ContactNo= $Jsondata->ContactNo;
                 $Model->DOB= $Jsondata->DOB;
                 $Model->Age= $Jsondata->Age;
                 $Model->Gender= $Jsondata->Gender;
                 $Model->AdharNo= $Jsondata->AdharNo;
                 $Model->Email= $Jsondata->Email;
                 $Obj->UpdatePatientDetail($Model);
            break;
              
            }
    }
?>