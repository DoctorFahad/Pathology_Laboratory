<?php
  require_once "DBConfig.php";
  class ManageAdmin
  {
    private $DBObject;
    private $Con;
    public function __construct()
    {
      $this->DBObject = new DBConfig();
      $this->Con = $this->DBObject->getconnection();
    }
    public function AddAdmin($Model)
    {
      $Query="INSERT INTO `admin` (`AdminId`, `FullName`, `UserName`, `ContactNo`, `Email`, `Passwd`) VALUES 
                                  (NULL, '$Model->FullName', '$Model->UserName', '$Model->ContactNo', '$Model->Email', '$Model->Passwd');";
      if(mysqli_query($this->Con ,$Query))
      {
        echo "Admin Successfully Add";
      }
      else
      {
        echo mysqli_error($this->Con);
      }
    }
  
    public function GetAdminList()
    {   
      try
      {
        $dataRows= array();
        $Query= "select * from admin";
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
  
    public function GetOnlyAdmin($Id)
    {
      $Query ="Select * from admin where AdminId=$Id";
      $Result = mysqli_query($this->Con , $Query);
      $Data = mysqli_fetch_assoc($Result);
      return json_encode($Data);
    }

    public function getDashboard()
    {
      $Query ="select (select count(*) from doctor) as DocCount,
                      (select count(*) from patientmaster) as PatientCount,
                      (select count(*) from hospital) as HosCount,
                      ((select count(*) from staff) + (select count(*) from deliveryboy)) as SaffCount,
                      (select count(*) from receiptmaster) as RecCount,
                      (select COALESCE(sum(Total), 0) from receiptmaster) as TotalRec";
                      
      $Result = mysqli_query($this->Con , $Query);
      $Data = mysqli_fetch_assoc($Result);
      return json_encode($Data);
    }

    public function DeleteAdmin($Id)
    {
      $Query ="Delete from admin where AdminId=$Id";
      if (mysqli_query($this->Con , $Query))
      {
        return "Record Successfully Deleted";
      }
      else
      {
        return mysqli_error($this->Con);
      }
    }    

    public function UpdateAdminDetail($Model)
    {  
      $Query="Update admin set `FullName`= '$Model->FullName',`UserName`= '$Model->UserName', `ContactNo`='$Model->ContactNo', 
                              `Email`='$Model->Email'
                              where `AdminId`=$Model->AdminId";

      if (mysqli_query($this->Con,$Query))
      {
        echo "Data was Updated successfully";
      }
      else
      {
        echo mysqli_error($this->Con);
      }
    }
     
    public function changePassword($OldPass, $NewPass, $AdminId)
    {
        $Query = "Select * from admin where Passwd='$OldPass' and AdminId=$AdminId";
        $res = mysqli_query($this->Con,$Query);
        if (mysqli_fetch_assoc($res))
        {
            $Query = "Update admin set Passwd='$NewPass' where AdminId=$AdminId";
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
      $query = "select * from admin where UserName='$UserName' and Passwd='$Passwd'";
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
      $query = "select * from admin where Email='$Email'";
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

  }
?>