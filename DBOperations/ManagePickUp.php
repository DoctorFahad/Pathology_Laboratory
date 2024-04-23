<?php
  require_once "DBConfig.php";
  class ManagePickUp
  {
      private $DBObject;
      private $Con;
      public function __construct()
      {
          $this->DBObject = new DBConfig();
          $this->Con = $this->DBObject->getconnection();
      }
          public function AddPickUp($Model)
          {
             $Query="INSERT INTO `pickup` (`PickUpId`, `ReceiptId`, `PickUpDate`, `DBId`) VALUES 
                                          (NULL, '$Model->ReceiptId', '$Model->PickUpDate', '$Model->DBId');";
              if(mysqli_query($this->Con ,$Query))
              {
                  echo "PickUp Successfully Added";
              }
              else
              {
                 echo mysqli_error($this->Con);
              }
          }

       public function GetPickUpList()
           {   
             try
             {
               $dataRows= array();
               $Query= "select * from pickup";
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

       public function GetOnlyPickUp($Id)
           {
              $Query ="Select * from pickup where PickUpId=$Id";
              $Result = mysqli_query($this->Con , $Query);
              $Data = mysqli_fetch_assoc($Result);
              return json_encode($Data);
            }

       public function DeletePickUp($Id)
           {
              $Query ="Delete from pickup where PickUpId=$Id";
              if (mysqli_query($this->Con , $Query))
              {
                 return "Record Successfully Deleted";
              }
              else
              {
                 return mysqli_error($this->Con);
              }
            }    

       public function UpdatePickUpDetail($Model)
           {  
              $Query="Update doctor set  `ReceiptId`='$Model->ReceiptId',`PickUpDate`='$Model->PickUpDate',`DBId`='$Model->DBId'
                                          where `PickUpId`=$Model->PickUpId";

               if (mysqli_query($this->Con,$Query))
               {
                     echo "Data was Updated successfully";
               }
               else
               {
                    echo mysqli_error($this->Con);
               }
           }

        public function GetStaffPickupReceiptList($DBId)
        {   
          try
          {
            $dataRows= array();
            $Query= "SELECT rec.ReceiptId, rec.Priority, rec.Total, rec.Date, hos.HospitalName, pat.FullName as 'PatName', doc.FullName as 'DocName', pick.PickUpId
                            from receiptmaster as rec 
                            join hospital as hos on rec.HospitalId = hos.HospitalId 
                            join patientmaster as pat on rec.PatientId = pat.PatientId 
                            join doctor as doc on rec.DoctorId = doc.DoctorId
                            join staff as stf on rec.StaffId = stf.StaffId 
                            join pickup as pick on rec.ReceiptId = pick.ReceiptId
                            where rec.StaffId <> 0 and  pick.PickUpId not in (select PickUpId from delivery)";
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
   }
?>