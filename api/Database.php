<?php
// classes/Database.php

class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'edoc';
    protected $connection;

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }

    // Add other methods as needed
}
?>
