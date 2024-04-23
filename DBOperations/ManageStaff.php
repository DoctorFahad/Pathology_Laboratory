<?php
   require_once "DBConfig.php";
   class ManageStaff
   {
       private $DBObject;
       private $Con;
       public function __construct()
       {
           $this->DBObject = new DBConfig();
           $this->Con = $this->DBObject->getconnection();
       }
           public function AddStaff($Model)
           {
              $Query="INSERT INTO `staff` (`StaffId`, `FullName`, `UserName`, `Address`, `ContactNo`, `Gender`, `DOB`, `DOJ`, `Email`, `Passwd`) VALUES
                                          (NULL, '$Model->FullName', '$Model->UserName', '$Model->Address', '$Model->ContactNo',
                                                 '$Model->Gender', '$Model->DOB', '$Model->DOJ', '$Model->Email', '$Model->Passwd');";
               if(mysqli_query($this->Con ,$Query))
               {
                   echo "Staff Successfully Add";
               }
               else
               {
                  echo mysqli_error($this->Con);
               }
           }

        public function GetStaffList()
            {   
              try
              {
                $dataRows= array();
                $Query= "select * from staff";
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

        public function GetOnlyStaff($Id)
            {
               $Query ="Select * from Staff where StaffId=$Id";
               $Result = mysqli_query($this->Con , $Query);
               $Data = mysqli_fetch_assoc($Result);
               return json_encode($Data);
             }

        public function DeleteStaff($Id)
            {
               $Query ="Delete from staff where StaffId=$Id";
               if (mysqli_query($this->Con , $Query))
               {
                  return "Record Successfully Deleted";
               }
               else
               {
                  return mysqli_error($this->Con);
               }
             }    

        public function UpdateStaffDetail($Model)
        {  
            $Query="Update staff set `FullName`='$Model->FullName', `UserName`='$Model->UserName',`Address`= '$Model->Address',`ContactNo`= '$Model->ContactNo',
                                      `Gender`='$Model->Gender',`DOB`= '$Model->DOB', `DOJ`='$Model->DOJ',`Email`= '$Model->Email'
                                      where `StaffId`=$Model->StaffId";

            if (mysqli_query($this->Con,$Query))
            {
                  echo "Data was Updated successfully";
            }
            else
            {
                  echo mysqli_error($this->Con);
            }
        }

        public function changePassword($OldPass, $NewPass, $StaffId)
        {
            $Query = "Select * from staff where Passwd='$OldPass' and StaffId=$StaffId";
            $res = mysqli_query($this->Con,$Query);
            if (mysqli_fetch_assoc($res))
            {
                $Query = "Update staff set Passwd='$NewPass' where StaffId=$StaffId";
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

        public function Authentication($UserName, $Passwd)
        {
          $query = "select * from staff where UserName='$UserName' and Passwd='$Passwd'";
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

        public function forgotPasswd($Email)
        {
          $query = "select * from staff where Email='$Email'";
          $result = mysqli_query($this->Con ,$query);
          if ($row = mysqli_fetch_assoc($result))
          {
              require_once("../PHPMailer/MailTest.php");
              $Message = "Dear ".$row["FullName"].", Your Login details is Username: <b>".$row["UserName"]."</b> and Password: <b>".$row["Passwd"]."</b>";
              sendMail($row["Email"], "Forgot Password", $Message);
          }
          else
          {
            return "Fail";
          }
        }

    }
?>