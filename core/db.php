<?php

class DatabaseConnector {

    private $conn;

    public function __construct($host, $username, $password, $database, $port) {
        $this->conn = new mysqli($host, $username, $password, $database, $port);
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    public function execute($sql) {
        return $this->conn->query($sql);
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function getVersion() {
        $result = $this->execute('SELECT version()');
        $version = null;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $version = $row['version()'];
        }
        return $version;
    }

}

$host = 'localhost';
$port = 3306;
$username = 'root';
$password = '';
$database = 'webtechproject';

$db = new DatabaseConnector($host, $username, $password, $database, $port);
$GLOBALS['db'] = $db;