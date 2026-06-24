<?php

class Database {
    private $connection = null;

    public function __construct() {
        $this->connection = new SQLite3('../database/tfli.db');
    }

    public function db() {
        return $this->connection;
    }
}

