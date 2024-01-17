<?php

namespace Model;

use mysqli;

class Model
{
    protected $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

}