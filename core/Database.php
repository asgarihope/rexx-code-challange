<?php

namespace core;

use mysqli;

class Database
{
    private $host = Config::DB_HOST;
    private $user = Config::DB_USER;
    private $pass = Config::DB_PASSWORD;
    private $dbname = Config::DB_NAME;

    public function connect()
    {
        $mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($mysqli->connect_error) {
            die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }

        return $mysqli;
    }
}