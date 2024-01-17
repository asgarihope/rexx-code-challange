<?php
class Database {
    private $host = 'localhost';
    private $user = 'root'; // Replace with your database username
    private $pass = '123456789'; // Replace with your database password
    private $dbname = 'rexx'; // Replace with your database name

    public function connect() {
        $mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($mysqli->connect_error) {
            die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }

        return $mysqli;
    }
}