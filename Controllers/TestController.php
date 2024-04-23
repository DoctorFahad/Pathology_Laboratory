<?php
    require_once "../DBOperations/ManageTest.php";
    require_once "../Models/TestModel.php";
 
 
    if(isset($_REQUEST["Choice"]))
    {
                     $Ch = $_REQUEST["Choice"];
                     $Obj= new ManageTest();
 
             switch ($Ch)
            {
              case "AddTest":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new TestModel();
                 $Model->TestId = $Jsondata->TestId;
                 $Model->TestName= $Jsondata->TestName;
                 $Model->NormalRange= $Jsondata->NormalRange;
                 $Model->Unit= $Jsondata->Unit;
                 $Model->Cost= $Jsondata->Cost;
                 
                  if($Jsondata->TestId == 0)
                      {
                        echo $Obj->AddTest($Model);
                      }
                  else
                      {
                        echo $Obj->UpdateTestDetail($Model);
                      }                     	
              break;
              
              case "GetTestList": 
                  echo $Obj->GetTestList();
              break;

              case "GetTestReports": 
                echo $Obj->GetTestReports();
              break;

              case "GetOnlyTest" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->GetOnlyTest($Id);
              break;
              
              case "DeleteTest" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->DeleteTest($Id);
              break; 

              case "UpdateTestDetail":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new TestModel();
                 $Model->TestId = $Jsondata->TestId;
                 $Model->TestName= $Jsondata->TestName;
                 $Model->NormalRange= $Jsondata->NormalRange;
                 $Model->Unit= $Jsondata->Unit;
                 $Model->Cost= $Jsondata->Cost;
                $Obj->UpdateTestDetail($Model);
            break;
              
            }
    }
?>