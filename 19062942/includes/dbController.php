<?php

class DBController{
    private $servername = "localhost";
    private $user = "ck"; // change this if necessary
    private $pass = "ck"; // change this if necessary
    private $databaseName = "19062942";
    private $conn;

    function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->servername,$this->user,$this->pass,$this->databaseName);
		return $conn;
	}

    function getConn(){
        return $this->conn; // getter for the database connection
    }
}
?>