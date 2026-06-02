<?php

class DB
{
    private $host = "127.0.0.1";
    private $port = "3306";
    private $db_name = "68pm34";
    private $username = "root";
    private $password = "14122005";
    public $conn;

    public function __construct()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            die("Database Connection failed: " . $exception->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
