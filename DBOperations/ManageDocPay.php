<?php
  require_once "DBConfig.php";
  class ManageDocPay
  {
      private $DBObject;
      private $Con;
      public function __construct()
      {
          $this->DBObject = new DBConfig();
          $this->Con = $this->DBObject->getconnection();
      }
          public function AddDocPay($Model)
          {
             $Query="INSERT INTO `doctorpay` (`DocPayId`, `DoctorId`, `Amount`, `PaidDate`, `PayMode`, `RefNo`) VALUES 
                                          (NULL, '$Model->DoctorId', '$Model->Amount', '$Model->PaidDate', '$Model->PayMode','$Model->RefNo');";
              if(mysqli_query($this->Con ,$Query))
              {
                  echo "DocPay Successfully Added";
              }
              else
              {
                 echo mysqli_error($this->Con);
              }
          }

       public function GetDocPayList()
           {   
             try
             {
               $dataRows= array();
               $Query= "select docpay.*, doc.FullName from doctorpay as docpay join doctor as doc on docpay.DoctorId = doc.DoctorId";
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

       public function GetOnlyDocPay($Id)
           {
              $Query ="Select * from doctorpay where DocPayId=$Id";
              $Result = mysqli_query($this->Con , $Query);
              $Data = mysqli_fetch_assoc($Result);
              return json_encode($Data);
            }

       public function DeleteDocPay($Id)
           {
              $Query ="Delete from doctorpay where DocPayId=$Id";
              if (mysqli_query($this->Con , $Query))
              {
                 return "Record Successfully Deleted";
              }
              else
              {
                 return mysqli_error($this->Con);
              }
            }  
            
            public function GetDoctorPayReports($dtFrom, $dtTo)
            {   
              try
              {
                
                $dataRows= array();
                $Query= "select * from doctorpay as a join doctor as b on a.DoctorId = b.DoctorId where a.PaidDate >= '$dtFrom' and a.PaidDate <= '$dtTo'";
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
        

       public function UpdateDocPay($Model)
           {  
              $Query="Update doctorpay set  `DoctorId`='$Model->DoctorId',`Amount`='$Model->Amount',`PaidDate`='$Model->PaidDate',`PayMode`='$Model->PayMode',`RefNo`='$Model->RefNo'
                                        where `DocPayId`=$Model->DocPayId";

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