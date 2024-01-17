<?php

namespace core;
use mysqli;

class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '123456789';
    private $dbname = 'rexx';

    public function connect()
    {
        $mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($mysqli->connect_error) {
            die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }

        return $mysqli;
    }
}