<?php

class DB{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "quanlydetai";
    public $conn;
    function __construct(){
        // Create connection
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password,$this->dbname);
        mysqli_query($this->conn, "SET NAMES ''utf-8");
        
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>