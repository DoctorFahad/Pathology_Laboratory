<?php
  require_once "DBConfig.php";
  class ManageReceipt
  {
      private $DBObject;
      private $Con;
      public function __construct()
      {
          $this->DBObject = new DBConfig();
          $this->Con = $this->DBObject->getconnection();
      }
      public function AddReceipt($Model)
      {
          $Query="INSERT INTO `receiptmaster` (`ReceiptId`, `PatientId`, `DoctorId`, `HospitalId`, `PaymentMode`, `ReferenceNo`, `Date`, `Total`, `Priority`, `StaffId`) 
                                      VALUES (NULL,'$Model->PatientId', '$Model->DoctorId', '$Model->HospitalId', '$Model->PaymentMode', '$Model->ReferenceNo',
                                                    '$Model->Date', '$Model->Total', '$Model->Priority', '$Model->StaffId');";

          if(mysqli_query($this->Con ,$Query))
          {
              
          }
          else
          {
              echo mysqli_error($this->Con);
          }
      }


      public function insertRecDetail($Model)
      {
          $Query = "INSERT INTO `receiptdetail` (`RecDetailId`, `TestId`, `ReceiptId`, `Cost`) VALUES (NULL, $Model->TestId, $Model->ReceiptId, '$Model->Cost');";
          if (!mysqli_query($this->Con ,$Query))
          {
            echo mysqli_error($this->Con);
          }
      }

      public function GetReceiptList()
        {   
          try
          {
            $dataRows= array();
            $Query= "select * from receiptmaster";
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

        public function GetReceiptDetails($Id)
        {   
          try
          {
            $dataRows= array();
            $Query= "select * from receiptdetail as a join testdetails as b on a.TestId=b.TestId and a.ReceiptId = $Id";
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

      public function GetOnlyReceipt($Id)
      {
        $Query ="select rec.*, hos.HospitalName, doc.FullName as 'Doctor', pat.FullName as 'Patient'  
                        from receiptmaster as rec 
                        join hospital as hos on rec.HospitalId = hos.HospitalId 
                        join doctor as doc on rec.DoctorId = doc.DoctorId 
                        join patientmaster as pat on rec.PatientId = pat.PatientId 
                        where rec.ReceiptId=$Id";
        $Result = mysqli_query($this->Con , $Query);
        $Data = mysqli_fetch_assoc($Result);
        return json_encode($Data);
      }

      public function getReceiptNo()
      {
        $Query ="select (COALESCE(max(ReceiptId), 0) + 1) as 'ReceiptNo' from receiptmaster";
        $Result = mysqli_query($this->Con , $Query);
        $Data = mysqli_fetch_assoc($Result);
        return $Data["ReceiptNo"];
      }

      public function DeleteReceipt($Id)
        {
          $Query ="Delete from receiptmaster where ReceiptId=$Id";
          if (mysqli_query($this->Con , $Query))
          {
              return "Record Successfully Deleted";
          }
          else
          {
              return mysqli_error($this->Con);
          }
        }    

      public function UpdateReceiptDetail($Model)
        {  
          $Query="Update receiptmaster set `PatientId`='$Model->PatientId', `DoctorId`='$Model->DoctorId', `HospitalId`='$Model->HospitalId',
                                            `PaymentMode`='$Model->PaymentMode', `ReferenceNo`'$Model->ReferenceNo',
                                            `Date`='$Model->Date', `Total`= '$Model->Total',`Priority`= '$Model->Priority'
                                            where `ReceiptId`=$Model->ReceiptId";

            if (mysqli_query($this->Con,$Query))
            {
                  echo "Data was Updated successfully";
            }
            else
            {
                echo mysqli_error($this->Con);
            }
        }

        public function GetStaffReceiptList()
        {   
          try
          {
            $dataRows= array();
            $Query= "SELECT rec.ReceiptId, rec.Priority, rec.Total, rec.Date, hos.HospitalName, pat.FullName as 'PatName', doc.FullName as 'DocName' from receiptmaster as rec 
                      join hospital as hos on rec.HospitalId = hos.HospitalId 
                      join doctor as doc on rec.	DoctorId = doc.	DoctorId 
                      join patientmaster as pat on rec.PatientId = pat.PatientId 
                      join staff as stf on rec.StaffId = stf.StaffId 
                      where rec.StaffId <> 0 and rec.ReceiptId not in (select  ReceiptId from pickup)";
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


        public function GetReceiptReports($dtFrom, $dtTo)
        {   
          try
          {
            
            $dataRows= array();
            $Query= "select *, b.FullName as 'DocName' from receiptmaster as a join doctor as b on a.DoctorId = b.DoctorId 
            join patientmaster as c on a.PatientId = c.PatientId where a.Date >= '$dtFrom' and a.Date <= '$dtTo'";
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

        public function GetReceipts()
        {   
          try
          {
            $dataRows= array();
            $Query= "select *, b.FullName as 'DocName' from receiptmaster as a join doctor as b on a.DoctorId = b.DoctorId 
            join patientmaster as c on a.PatientId = c.PatientId";
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

      public function GetOnlyReceipts($Id)
      {
        $Query ="select *, b.FullName as 'DocName' from receiptmaster as a join doctor as b on a.DoctorId = b.DoctorId 
                join patientmaster as c on a.PatientId = c.PatientId join hospital as h on a.HospitalId = h.HospitalId
                where a.ReceiptId=$Id";
        $Result = mysqli_query($this->Con , $Query);
        $Data = mysqli_fetch_assoc($Result);
        return json_encode($Data);
      }

   }
?>