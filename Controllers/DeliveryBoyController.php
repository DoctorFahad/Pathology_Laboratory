<?php
    require_once "../DBOperations/ManageDeliveryBoy.php";
    require_once "../Models/DeliveryBoyModel.php";
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
                     $Obj= new ManageDeliveryBoy();
 
             switch ($Ch)
            {
              case "AddDeliveryBoy":
                 $Jsondata = Json_decode(file_get_contents("php://input"));
                 $Model= new DeliveryBoyModel();
                 $Model->DBId = $Jsondata->DBId;
                 $Model->FullName= $Jsondata->FullName;
                 $Model->UserName= $Jsondata->UserName;
                 $Model->LicenseNo= $Jsondata->LicenseNo;
                 $Model->ContactNo= $Jsondata->ContactNo;
                 $Model->ExpiryDate= $Jsondata->ExpiryDate;
                 $Model->Email= $Jsondata->Email;
                 $Model->Passwd= generateRandomPassword(5);
                 if($Jsondata->DBId == 0)
                      {
                        echo $Obj->AddDeliveryBoy($Model);
                        sendMail($Model->Email, "Create Account", "Dear <b> $Model->FullName </b> Your account is successfully created and login details are <b>Username: </b>$Model->UserName and <b>Password:</b> $Model->Passwd <br />Regards<br />Precision Lab Solution");
                      }
                  else
                      {
                        echo $Obj->UpdateDeliveryBoyDetail($Model);
                      } 	  	  
              break;
              
              case "updatePasswd" :
                $Json = json_decode(file_get_contents("php://input"));
                $DBId = $Json->DBId;
                $oldPass = $Json->oldPass;
                $newPass = $Json->newPass;
                echo $Obj->changePassword($oldPass,  $newPass, $DBId);
              break;

              case "GetDeliveryBoyList": 
                  echo $Obj->GetDeliveryBoyList();
              break;

              case "GetOnlyDeliveryBoy" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->GetOnlyDeliveryBoy($Id);
              break;
              
              case "DeleteDeliveryBoy" :
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Id = $Jsondata->Id;
                echo  $Obj->DeleteDeliveryBoy($Id);
              break; 

              case "updatePasswd" :
                $Json = json_decode(file_get_contents("php://input"));
                $DBId = $Json->DBId;
                $oldPass = $Json->oldPass;
                $newPass = $Json->newPass;
                echo $obj->chnagePassword($oldPass,  $newPass, $DBId);
            break;

              case "UpdateDeliveryBoyDetail":
                $Jsondata = Json_decode(file_get_contents("php://input"));
                $Model= new DeliveryBoyModel();
                $Model->DBId = $Jsondata->DBId;
                $Model->FullName= $Jsondata->FullName;
                 $Model->UserName= $Jsondata->UserName;
                 $Model->ContactNo= $Jsondata->ContactNo;
                 $Model->Email= $Jsondata->Email;
                 $Model->LicenseNo= $Jsondata->LicenseNo;
                 $Model->ExpiryDate	= $Jsondata->ExpiryDate;
                $Obj->UpdateDeliveryBoyDetail($Model);
            break;

            case "forgotPasswd" :
              $Jsondata = Json_decode(file_get_contents("php://input"));
              $Email = $Jsondata->Email;
              echo  $Obj->forgotPasswd($Email);
            break;
            
          case "Authentication": 
              $Jsondata = Json_decode(file_get_contents("php://input"));
              echo $Obj->Authentication($Jsondata->UserName, $Jsondata->Passwd);
          break;
              
              
        }
    }
?>