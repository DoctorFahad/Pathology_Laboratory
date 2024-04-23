<?php
  require_once "DBConfig.php";
  class ManagePatient
  {
      private $DBObject;
      private $Con;
      public function __construct()
      {
          $this->DBObject = new DBConfig();
          $this->Con = $this->DBObject->getconnection();
      }
          public function AddPatient($Model)
          {
             $Query="INSERT INTO `patientmaster` (`PatientId`, `FullName`, `ContactNo`, `DOB`, `Age`, `Gender`, `AdharNo`, `Email`) VALUES 
                                                 (NULL, '$Model->FullName', '$Model->ContactNo', '$Model->DOB', '$Model->Age', '$Model->Gender', '$Model->AdharNo', '$Model->Email');";
              if(mysqli_query($this->Con ,$Query))
              {
                  echo "Patient Successfully Add";
              }
              else
              {
                 echo mysqli_error($this->Con);
              }
          }

       public function GetPatientList()
           {   
             try
             {
               $dataRows= array();
               $Query= "select * from patientmaster";
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

       public function GetOnlyPatient($Id)
           {
              $Query ="Select * from patientmaster where PatientId=$Id";
              $Result = mysqli_query($this->Con , $Query);
              $Data = mysqli_fetch_assoc($Result);
              return json_encode($Data);
            }

       public function DeletePatient($Id)
           {
              $Query ="Delete from patientmaster where PatientId=$Id";
              if (mysqli_query($this->Con , $Query))
              {
                 return "Record Successfully Deleted";
              }
              else
              {
                 return mysqli_error($this->Con);
              }
            }   
            
        public function GetPatientVisits()
        {   
          try
          {
            $dataRows= array();
            $Query= "select a.*, (select count(*) from receiptmaster where PatientId=a.PatientId) as 'Count' from patientmaster as a";
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

       public function UpdatePatientDetail($Model)
           {  
              $Query="Update patientmaster set `FullName`='$Model->FullName',`ContactNo`= '$Model->ContactNo',  `DOB`='$Model->DOB',`Age`= '$Model->Age',
                                               `Gender`= '$Model->Gender', `AdharNo`= '$Model->AdharNo', `Email`= '$Model->Email'
                                                where `PatientId`=$Model->PatientId";

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