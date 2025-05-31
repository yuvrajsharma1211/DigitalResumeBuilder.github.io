<?php

class database{
    private $host = 'localhost:3306';
    private $username = 'root';
    private $database = 'resumebuilder';
    private $password = '';
    private $db = null;


    function __construct(){
        $this->db =  new mysqli($this->host,$this->username,$this->password,$this->database);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function connect(){
        return $this->db;
    }
}

$db = new Database();
$db = $db->connect();