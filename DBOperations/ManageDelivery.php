<?php
  require_once "DBConfig.php";
  class ManageDelivery
  {
      private $DBObject;
      private $Con;
      public function __construct()
      {
          $this->DBObject = new DBConfig();
          $this->Con = $this->DBObject->getconnection();
      }
      public function AddDelivery($Model)
      {
          $Query="INSERT INTO `delivery` (`DeliveryId`, `PickUpId`, `DeliveryDate`, `DBId`) VALUES 
                                      (NULL, '$Model->PickUpId', '$Model->DeliveryDate', '$Model->DBId');";
          if(mysqli_query($this->Con ,$Query))
          {
              echo "Delivery Successfully Added";
          }
          else
          {
              echo mysqli_error($this->Con);
          }
      }

       public function GetDeliveryList()
           {   
             try
             {
               $dataRows= array();
               $Query= "select * from delivery";
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

       public function GetOnlyDelivery($Id)
           {
              $Query ="Select * from delivery where DeliveryId=$Id";
              $Result = mysqli_query($this->Con , $Query);
              $Data = mysqli_fetch_assoc($Result);
              return json_encode($Data);
            }

       public function DeleteDelivery($Id)
           {
              $Query ="Delete from delivery where DeliveryId=$Id";
              if (mysqli_query($this->Con , $Query))
              {
                 return "Record Successfully Deleted";
              }
              else
              {
                 return mysqli_error($this->Con);
              }
            }    

       public function UpdateDeliveryDetail($Model)
           {  
              $Query="Update delivery set `PickUpId`='$Model->PickUpId',`FullName`='$Model->FullName'
                                        where `DeliveryDate`=$Model->DeliveryDate";

               if (mysqli_query($this->Con,$Query))
               {
                     echo "Data was Updated successfully";
               }
               else
               {
                    echo mysqli_error($this->Con);
               }
           }

       
           public function GetDeliveredReceiptList($DBId)
           {   
             try
             {
               $dataRows= array();
               $Query= "SELECT rec.ReceiptId, rec.Priority, rec.Total, rec.Date, hos.HospitalName, pat.FullName as 'PatName', doc.FullName as 'DocName' from receiptmaster as rec 
                        join hospital as hos on rec.HospitalId = hos.HospitalId 
                        join patientmaster as pat on rec.PatientId = pat.PatientId 
                        join doctor as doc on rec.DoctorId = doc.DoctorId
                        join staff as stf on rec.StaffId = stf.StaffId 
                        join pickup as pick on pick.ReceiptId = rec.ReceiptId
                        where rec.StaffId <> 0 and pick.PickUpId in (select  PickUpId  from delivery where DBId= $DBId)";
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