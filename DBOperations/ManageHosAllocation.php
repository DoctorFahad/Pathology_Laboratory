<?php
  require_once "DBConfig.php";
  class ManageHosAllocation
  {
      private $DBObject;
      private $Con;
      public function __construct()
      {
          $this->DBObject = new DBConfig();
          $this->Con = $this->DBObject->getconnection();
      }
          public function AddHosAllocation($Model)
          {
             $Query="INSERT INTO `hosallocation` (`AllocationId`, `HospitalId`, `StaffId`, `AllocationDate`) VALUES 
                                          (NULL, '$Model->HospitalId', '$Model->StaffId', '$Model->AllocationDate');";
              if(mysqli_query($this->Con ,$Query))
              {
                  echo "HospitalAllocation Successfully Added";
              }
              else
              {
                 echo mysqli_error($this->Con);
              }
          }

       public function GetHosAllocationList()
           {   
             try
             {
               $dataRows= array();
               $Query= "select allo.*, hos.HospitalName, stf.FullName from hosallocation as allo join hospital as hos on allo.HospitalId = hos.HospitalId join staff as stf on allo.StaffId = stf.StaffId ";
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

       public function GetOnlyHosAllocation($Id)
           {
              $Query ="Select * from hosallocation where AllocationId=$Id";
              $Result = mysqli_query($this->Con , $Query);
              $Data = mysqli_fetch_assoc($Result);
              return json_encode($Data);
            }

       public function DeleteHosAllocation($Id)
           {
              $Query ="Delete from hosallocation where AllocationId=$Id";
              if (mysqli_query($this->Con , $Query))
              {
                 return "Record Successfully Deleted";
              }
              else
              {
                 return mysqli_error($this->Con);
              }
            }    

       public function UpdateHosAllocation($Model)
           {  
              $Query="Update hosallocation set  `HospitalId`='$Model->HospitalId',`StaffId`='$Model->StaffId',`AllocationDate`='$Model->AllocationDate'
                                          where `AllocationId`=$Model->AllocationId";

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