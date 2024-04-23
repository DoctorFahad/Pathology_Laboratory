<?php
    require_once "DBConfig.php";
    class ManageTest
    {
        private $DBObject;
        private $Con;
        public function __construct()
        {
            $this->DBObject = new DBConfig();
            $this->Con = $this->DBObject->getconnection();
        }
            public function AddTest($Model)
            {
               $Query="INSERT INTO `testdetails` (`TestId`, `TestName`, `NormalRange`, `Unit`, `Cost`) VALUES 
                                                 (NULL, '$Model->TestName', ' $Model->NormalRange', '$Model->Unit', '$Model->Cost');";
                if(mysqli_query($this->Con ,$Query))
                {
                    echo "Test Successfully Add";
                }
                else
                {
                   echo mysqli_error($this->Con);
                }
            }
  
         public function GetTestList()
          {   
            try
            {
              $dataRows= array();
              $Query= "select * from testdetails";
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
  
         public function GetOnlyTest($Id)
             {
                $Query ="Select * from testdetails where TestId=$Id";
                $Result = mysqli_query($this->Con , $Query);
                $Data = mysqli_fetch_assoc($Result);
                return json_encode($Data);
              }
  
         public function DeleteTest($Id)
             {
                $Query ="Delete from testdetails where TestId=$Id";
                if (mysqli_query($this->Con , $Query))
                {
                   return "Record Successfully Deleted";
                }
                else
                {
                   return mysqli_error($this->Con);
                }
              }    
  
         public function UpdateTestDetail($Model)
             {  
                $Query="Update testdetails set `TestName`='$Model->TestName', `NormalRange`= ' $Model->NormalRange',  `Unit`='$Model->Unit', `Cost`='$Model->Cost'
                                                  where `TestId`=$Model->TestId";
  
                 if (mysqli_query($this->Con,$Query))
                 {
                       echo "Data was Updated successfully";
                 }
                 else
                 {
                      echo mysqli_error($this->Con);
                 }
             }

             public function GetTestReports()
             {   
               try
               {
                 $dataRows= array();
                 $Query= "select a.*, (select count(*) from receiptdetail where TestId = a.TestId) as 'Count' from testdetails as a";
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