<?php
class db
{
	public $servername;
	public $username;
	public $password;
	public $dbname;
	
	public $conn;

    function __construct()
    {
    	$this->conn=new mysqli("localhost", "root", "","CedHosting");
    	if($this->conn->connect_error)
        {
    		die("Could not connect".$this->conn->connect_error);
    	}
    	
    }
}
?>