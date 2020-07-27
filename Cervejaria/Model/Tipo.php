<?php

namespace BD\Cervejaria\Model;

use \PDO;
use \PDOException;

class Tipo {
    
    private $idTipo;
    private $nometipo;
    private $paisorigem;
    private $copo;

    public function __construct() {        
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }
    
    function setIdTipo($value) {
        $this->idTipo = $value;
    }

    function setNometipo($value) {
        $this->nometipo = $value;
    }

    function setPaisorigem($value) {
        $this->paisorigem = $value;
    }

    function setCopo($value) {
        $this->copo = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `Tipo`(`nometipo`,`paisorigem`,`copo`) VALUES(:nometipo,:paisorigem,:copo)");
            $stmt->bindParam(":nometipo", $this->nometipo);
            $stmt->bindParam(":paisorigem", $this->paisorigem);
            $stmt->bindParam(":copo", $this->copo);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }             
    }
    
    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `Tipo` SET `nometipo` = :nometipo, `paisorigem` = :paisorigem, `copo` = :copo WHERE `idTipo` = :idTipo");
            $stmt->bindParam(":idTipo", $this->idTipo);
            $stmt->bindParam(":nometipo", $this->nometipo);
            $stmt->bindParam(":paisorigem", $this->paisorigem);
            $stmt->bindParam(":copo", $this->copo);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `Tipo` WHERE `idTipo` = :idTipo");
            $stmt->bindParam(":idTipo", $this->idTipo);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `Tipo` WHERE `idTipo` = :idTipo");
        $stmt->bindParam(":idTipo", $this->idTipo);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    
    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `Tipo`");
        $stmt->execute();
        return $stmt;
    }

}