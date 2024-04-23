<?php
    require_once "../DBOperations/ManageAdmin.php";
    require_once "../Models/AdminModel.php";
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
                     $Obj= new ManageAdmin();
 
             switch ($Ch)
            {
              case "AddAdmin":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new AdminModel();
                 $Model->AdminId = $Jsondata->AdminId;
                 $Model->FullName= $Jsondata->FullName;
                 $Model->UserName= $Jsondata->UserName;
                 $Model->ContactNo= $Jsondata->ContactNo;
                 $Model->Email= $Jsondata->Email;
                 $Model->Passwd= generateRandomPassword(5);
                 if($Jsondata->AdminId == 0)
                      {
                        echo $Obj->AddAdmin($Model);
                        sendMail($Model->Email, "Create Account", "Dear <b> $Model->FullName </b> Your account is successfully created and login details are <b>Username: </b>$Model->UserName and <b>Password:</b> $Model->Passwd <br />Regards<br />Precision Lab Solution");
                      }
                  else
                      {
                        echo $Obj->UpdateAdminDetail($Model);
                      } 	  	  
              break;
              
              case "updatePasswd" :
                $Json = json_decode(file_get_contents("php://input"));
                $AdminId = $Json->AdminId;
                $oldPass = $Json->oldPass;
                $newPass = $Json->newPass;
                echo $Obj->changePassword($oldPass,  $newPass, $AdminId);
              break;

              case "GetAdminList": 
                  echo $Obj->GetAdminList();
              break;

              case "forgotPasswd" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Email = $Jsondata->Email;
                echo  $Obj->forgotPasswd($Email);
              break;

              case "GetOnlyAdmin" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->GetOnlyAdmin($Id);
              break;
              
              case "DeleteAdmin" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->DeleteAdmin($Id);
              break; 

              case "UpdateAdminDetail":
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Model= new AdminModel();
                $Model->AdminId = $Jsondata->AdminId;
                $Model->FullName= $Jsondata->FullName;
                 $Model->UserName= $Jsondata->UserName;
                 $Model->ContactNo= $Jsondata->ContactNo;
                 $Model->Email= $Jsondata->Email;
                $Obj->UpdateAdminDetail($Model);
            break;

          case "Authentication": 
              $Jsondata = Json_decode(file_get_contents("php://input"));
              echo $Obj->Authentication($Jsondata->UserName, $Jsondata->Passwd);
          break;
              
          case "getDashboard": 
            echo $Obj->getDashboard();
        break;
              
        }
    }
?>