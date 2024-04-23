<?php
    require_once "../DBOperations/ManageStaff.php";
    require_once "../Models/StaffModel.php";
    require_once "../PHPMailer/MailTest.php";
 
    function generateRandomPassword($length = 10) {
      // List of characters to be used in the password
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_';
  
      // Length of the character list
      $charLength = strlen($characters);
  
      // Initialize the password variable
      $password = '';
  
      // Loop to generate random characters
      for ($i = 0; $i < $length; $i++) {
          // Generate a random index within the range of the character list
          $randomIndex = rand(0, $charLength - 1);
  
          // Append the randomly selected character to the password
          $password .= $characters[$randomIndex];
      }
  
      // Return the generated password
      return $password;
  }


    if(isset($_REQUEST["Choice"]))
    {
                     $Ch = $_REQUEST["Choice"];
                     $Obj= new ManageStaff();
 
             switch ($Ch)
            {
              case "AddStaff":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new StaffModel();
                 $Model->StaffId = $Jsondata->StaffId;
                 $Model->FullName= $Jsondata->FullName;
                 $Model->UserName= $Jsondata->UserName;
                 $Model->Address= $Jsondata->Address;
                 $Model->ContactNo= $Jsondata->ContactNo;
                 $Model->Gender= $Jsondata->Gender;
                 $Model->DOB= $Jsondata->DOB;
                 $Model->DOJ= $Jsondata->DOJ;
                 $Model->Email= $Jsondata->Email;
                 $Model->Passwd= generateRandomPassword(5);
                 if($Jsondata->StaffId == 0)
                      {
                        echo $Obj->AddStaff($Model);
                        sendMail($Model->Email, "Create Account", "Dear <b> $Model->FullName </b> Your account is successfully created and login details are <b>Username: </b>$Model->UserName and <b>Password:</b> $Model->Passwd <br />Regards<br />Precision Lab Solution");

                      }
                  else
                      {
                        echo $Obj->UpdateStaffDetail($Model);
                      }               	  
              break;
              
              case "GetStaffList": 
                  echo $Obj->GetStaffList();
              break;

              case "updatePasswd" :
                $Json = json_decode(file_get_contents("php://input"));
                $StaffId = $Json->StaffId;
                $oldPass = $Json->oldPass;
                $newPass = $Json->newPass;
                echo $Obj->changePassword($oldPass,  $newPass, $StaffId);
              break;

              case "GetOnlyStaff" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->GetOnlyStaff($Id);
              break;
              
              case "DeleteStaff" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->DeleteStaff($Id);
              break; 

              case "UpdateStaffDetail":
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Model= new StaffModel();
                $Model->StaffId = $Jsondata->StaffId;
                $Model->FullName = $Jsondata->FullName;
                $Model->UserName = $Jsondata->UserName;
                $Model->Address = $Jsondata->Address;
                $Model->ContactNo = $Jsondata->ContactNo;
                $Model->Gender = $Jsondata->Gender;
                $Model->DOB = $Jsondata->DOB;
                $Model->DOJ = $Jsondata->DOJ;
                $Model->Email = $Jsondata->Email;
                $Obj->UpdateStaffDetail($Model);
            break;
            
            case "Authentication": 
              $Jsondata = Json_decode(file_get_contents("php://input"));
              echo $Obj->Authentication($Jsondata->UserName, $Jsondata->Passwd);
            break;

            case "forgotPasswd" :
              $Jsondata = Json_decode(file_get_contents("php://input"));
              $Email = $Jsondata->Email;
              echo  $Obj->forgotPasswd($Email);
            break;
          }
    }
?>