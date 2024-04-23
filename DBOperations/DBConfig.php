<?php
class DBConfig
{
    public function getconnection()
    {
        return mysqli_connect("localhost","root","","PathologyLab_db");
    }
}
?>


