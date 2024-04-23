<?php
    require_once "DBConfig.php";
    class ManageDeliveryBoy
    {
        private $DBObject;
        private $Con;
        public function __construct()
        {
            $this->DBObject = new DBConfig();
            $this->Con = $this->DBObject->getconnection();
        }
            public function AddDeliveryBoy($Model)
            {
               $Query="INSERT INTO `deliveryboy` (`DBId`, `FullName`, `ContactNo`, `LicenseNo`, `ExpiryDate`, `Email`, `UserName`, `Passwd`) VALUES
                                              (NULL, '$Model->FullName', '$Model->ContactNo', '$Model->LicenseNo', '$Model->ExpiryDate', '$Model->Email', '$Model->UserName', '$Model->Passwd');";

                if(mysqli_query($this->Con ,$Query))
                {
                    echo "DeliveryBoy Successfully Added";
                }
                else
                {
                   echo mysqli_error($this->Con);
                }
            }

         public function GetDeliveryBoyList()
             {   
               try
               {
                 $dataRows= array();
                 $Query= "select * from deliveryboy";
                 if ($Result= mysqli_query($this->Con ,$Query))
                 {     
                   while ($row= mysqli_fetch_assoc($Result))
                   {
                        $dataRows []= $row;
                   }
                   return json_encode($dataRows);
                 }
                 else 
                 {
                   return "Error".mysqli_error($this->Con);
                 }
               }
               catch(Exception $Exp)
               {
                   return $Exp->getMessege();             
               }
             }
  
         public function GetOnlyDeliveryBoy($Id)
             {
                $Query ="Select * from deliveryboy where DBId=$Id";
                $Result = mysqli_query($this->Con , $Query);
                $Data = mysqli_fetch_assoc($Result);
                return json_encode($Data);
              }
  
         public function DeleteDeliveryBoy($Id)
             {
                $Query ="Delete from deliveryboy where DBId=$Id";
                if (mysqli_query($this->Con , $Query))
                {
                   return "Record Successfully Deleted";
                }
                else
                {
                   return mysqli_error($this->Con);
                }
              }    
  
         public function UpdateDeliveryBoyDetail($Model)
             {  
                $Query="Update deliveryboy set `FullName`='$Model->FullName', `ContactNo`='$Model->ContactNo', `LicenseNo`='$Model->LicenseNo',
                                            `ExpiryDate`= '$Model->ExpiryDate',  `Email`='$Model->Email', `UserName`='$Model->UserName'
                                             where `DBId`=$Model->DBId";
  
                 if (mysqli_query($this->Con,$Query))
                 {
                       echo "Data was Updated successfully";
                 }
                 else
                 {
                      echo mysqli_error($this->Con);
                 }
             }

             public function changePassword($OldPass, $NewPass, $DBId)
              {
                  $Query = "Select * from deliveryboy where Passwd='$OldPass' and DBId=$DBId";
                  $res = mysqli_query($this->Con,$Query);
                  if (mysqli_fetch_assoc($res))
                  {
                      $Query = "Update deliveryboy set Passwd='$NewPass' where DBId=$DBId";
                      if(mysqli_query($this->Con,$Query))
                      {
                          echo "Updated";
                      }
                      else
                      {
                          echo mysqli_error($this->Con);
                      }
                  }
                else
                {
                  return "Incorrect";
                }
              }

              public function forgotPasswd($Email)
    {
      $query = "select * from deliveryboy where Email='$Email'";
      $result = mysqli_query($this->Con ,$query);
      if ($row = mysqli_fetch_assoc($result))
      {
          require_once("../PHPMailer/MailTest.php");
          $Message = "Dear ".$row["FullName"].", Your Login details is Username: <b>".$row["UserName"]."</b> and Password: <b>".$row["Passwd"]."</b>";
          sendMail($row["Email"], "Forgot Password", $Message);
      }
      else
      {
        return "Registered Email not found";
      }
    }

             public function Authentication($UserName, $Passwd)
             {
               $query = "select * from deliveryboy where UserName='$UserName' and Passwd='$Passwd'";
               $result = mysqli_query($this->Con ,$query);
               if ($row = mysqli_fetch_assoc($result))
               {
                 return json_encode($row);
               }
               else
               {
                 return "Fail";
               }
             }    
     }
?>