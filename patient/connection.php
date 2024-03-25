<?php

class DatabaseManager {
    private $servername = "localhost";
    private $username = "root"; // Replace with your database username
    private $password = ""; // Replace with your database password
    private $database = "edoc"; // Replace with your database name
    private $connection;

    public function __construct() {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}

$database = new DatabaseManager();
$database = $database->getConnection();

?>
