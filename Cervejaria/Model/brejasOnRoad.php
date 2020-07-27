<?php

namespace BD\Cervejaria\Model;

abstract class brejasOnRoad
{

    protected $conn;

    public function __construct()
    {
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

}
