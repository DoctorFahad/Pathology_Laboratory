<?php
  require_once "DBConfig.php";
  class ManageDoctor
  {
      private $DBObject;
      private $Con;
      public function __construct()
      {
          $this->DBObject = new DBConfig();
          $this->Con = $this->DBObject->getconnection();
      }
          public function AddDoctor($Model)
          {
             $Query="INSERT INTO `doctor` (`DoctorId`, `HospitalId`, `FullName`, `Address`, `ContactNo`, `Alternate`, `Email`, `Commission`) VALUES 
                                          (NULL, '$Model->HospitalId', '$Model->FullName', '$Model->Address', '$Model->ContactNo',
                                                 '$Model->Alternate', '$Model->Email', '$Model->Commission');";
              if(mysqli_query($this->Con ,$Query))
              {
                  echo "Doctor Successfully Add";
              }
              else
              {
                 echo mysqli_error($this->Con);
              }
          }

      public function GetDoctorList()
      {   
        try
        {
          $dataRows= array();
          $Query= "select doc.*, hos.HospitalName   from doctor as doc join hospital as hos on doc.HospitalId = hos.HospitalId";
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

      public function getDoctorCollection()
      {   
        try
        {
          $dataRows= array();
          $Query= "select a.*, b.*, (select COALESCE(sum(Total), 0) from receiptmaster where DoctorId = a.DoctorId) as 'Collections', (select count(*) from receiptmaster where DoctorId = a.DoctorId) as 'Count',
                                    (select COALESCE(sum(Amount), 0) from doctorpay where DoctorId = a.DoctorId) as 'Paid',
                                    ((select COALESCE(sum(Total), 0) from receiptmaster where DoctorId = a.DoctorId) - (select COALESCE(sum(Amount), 0) from doctorpay where DoctorId = a.DoctorId)) as 'Dues'
                                    from doctor as a join hospital as b on a.HospitalId = b.HospitalId;";
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

       public function GetOnlyDoctor($Id)
           {
              $Query ="Select * from doctor where DoctorId=$Id";
              $Result = mysqli_query($this->Con , $Query);
              $Data = mysqli_fetch_assoc($Result);
              return json_encode($Data);
            }

       public function DeleteDoctor($Id)
           {
              $Query ="Delete from doctor where DoctorId=$Id";
              if (mysqli_query($this->Con , $Query))
              {
                 return "Record Successfully Deleted";
              }
              else
              {
                 return mysqli_error($this->Con);
              }
            }
            
            
            public function GetDoctorReference()
            {   
              try
              {
                $dataRows= array();
                $Query= "select a.*, (select count(*) from receiptmaster where DoctorId=a.DoctorId) as 'Count' from doctor as a";
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

       public function UpdateDoctorDetail($Model)
           {  
              $Query="Update doctor set  `HospitalId`='$Model->HospitalId',`FullName`='$Model->FullName',`Address`='$Model->Address',`ContactNo`='$Model->ContactNo',
                                         `Alternate`='$Model->Alternate',`Email`='$Model->Email',`Commission`='$Model->Commission'
                                          where `DoctorId`=$Model->DoctorId";

               if (mysqli_query($this->Con,$Query))
               {
                     echo "Data was Updated successfully";
               }
               else
               {
                    echo mysqli_error($this->Con);
               }
           }
   }
?>