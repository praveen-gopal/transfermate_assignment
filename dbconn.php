<?php

define('DB_HOST','localhost');
define('DB_USER','test');
define('DB_PASSWORD','test@@1234');
define('DB_DATABASE','xml_data');

class DatabaseConnection
{
    public function __construct()
    {
        $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);

        if($conn->connect_error)
        {
            die ("<h1>Database Connection Failed</h1>");
        }
        
		//echo "Database Connected Successfully";
        return $this->conn = $conn;
    }
}

?>