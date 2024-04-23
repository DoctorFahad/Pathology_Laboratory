<?php
    require_once "DBConfig.php";
    class ManageHospital
    {
        private $DBObject;
        private $Con;
        public function __construct()
        {
            $this->DBObject = new DBConfig();
            $this->Con = $this->DBObject->getconnection();
        }
            public function AddHospital($Model)
            {
               $Query="INSERT INTO `hospital` (`HospitalId`, `HospitalName`, `Address`, `ContactNo`, `Alternate`, `Email`) VALUES
                                              (NULL, '$Model->HospitalName', '$Model->Address', '$Model->ContactNo', '$Model->Alternate', '$Model->Email');";

                if(mysqli_query($this->Con ,$Query))
                {
                    echo "Hospital Successfully Add";
                }
                else
                {
                   echo mysqli_error($this->Con);
                }
            }
  
         public function GetHospitalList()
             {   
               try
               {
                 $dataRows= array();
                 $Query= "select * from hospital";
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
  
         public function GetOnlyHospital($Id)
             {
                $Query ="Select * from hospital where HospitalId=$Id";
                $Result = mysqli_query($this->Con , $Query);
                $Data = mysqli_fetch_assoc($Result);
                return json_encode($Data);
              }
  
         public function DeleteHospital($Id)
             {
                $Query ="Delete from hospital where HospitalId=$Id";
                if (mysqli_query($this->Con , $Query))
                {
                   return "Record Successfully Deleted";
                }
                else
                {
                   return mysqli_error($this->Con);
                }
              }    
              
              
              public function GetHospitalReports()
              {   
                try
                {
                  $dataRows= array();
                  $Query= "select a.*, (select count(*) from receiptmaster where HospitalId=a.HospitalId) as 'Count' from hospital as a";
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
              

         public function UpdateHospitalDetail($Model)
             {  
                $Query="Update hospital set `HospitalName`='$Model->HospitalName', `Address`='$Model->Address', `ContactNo`='$Model->ContactNo',
                                            `Alternate`= '$Model->Alternate',  `Email`='$Model->Email'
                                             where `HospitalId`=$Model->HospitalId";
  
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