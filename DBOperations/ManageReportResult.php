<?php
  require_once "DBConfig.php";
  class ManageReportResult
  {
      private $DBObject;
      private $Con;
      public function __construct()
      {
          $this->DBObject = new DBConfig();
          $this->Con = $this->DBObject->getconnection();
      }
          public function AddReportResult($Model)
          {

            $Query = "Select * from reportresult where TestId=$Model->TestId and ReceiptId=$Model->ReceiptId";
            $res = mysqli_query($this->Con, $Query);
            if ($row = mysqli_fetch_assoc($res))
            {
                $Query="Update `reportresult` set `TestId`='$Model->TestId', 
                                                  `Result`='$Model->Result', `ReceiptId`='$Model->ReceiptId' where `ReportId`=".$row["ReportId"];
                if(mysqli_query($this->Con ,$Query))
                {
                    echo "Reportresult Successfully Added";
                }
                else
                {
                  echo "Error: ".mysqli_error($this->Con);
                }
            }
            else
            {
                $Query="INSERT INTO `reportresult` (`ReportId`, `TestId`, `Result`, `ReceiptId`) VALUES 
                                                    (NULL, '$Model->TestId', '$Model->Result', '$Model->ReceiptId');";
                  if(mysqli_query($this->Con ,$Query))
                  {
                      echo "Reportresult Successfully Added";
                  }
                  else
                  {
                    echo "Error: ".mysqli_error($this->Con);
                  }
            }             
          }

       public function GetReportResultList($Id)
           {   
             try
             {
               $dataRows= array();
               $Query= "select *, (select Result from reportresult where TestId = a.TestId and ReceiptId=$Id)  as 'Result' 
                            from testdetails as a 
                            join receiptdetail as b on a.TestId = b.TestId 
                            where  ReceiptId=$Id";
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

       public function GetOnlyReportResult($Id)
           {
              $Query ="Select * from reportresult where ReportId=$Id";
              $Result = mysqli_query($this->Con , $Query);
              $Data = mysqli_fetch_assoc($Result);
              return json_encode($Data);
            }

       public function DeleteReportResult($Id)
           {
              $Query ="Delete from reportresult where ReportId=$Id";
              if (mysqli_query($this->Con , $Query))
              {
                 return "Record Successfully Deleted";
              }
              else
              {
                 return mysqli_error($this->Con);
              }
            }    

       public function UpdateReportResultDetail($Model)
           {  
              $Query="Update reportresult set  `TestId`='$Model->TestId',`Result`='$Model->Result'
                                          where `ReportId`=$Model->ReportId";

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