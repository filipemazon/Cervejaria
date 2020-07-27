<?php

namespace BD\Cervejaria\Model;

use \PDO;
use \PDOException;

class Fabricas {
    
    private $idFabricas;
    private $cidade;
    private $estado;
    private $quantestoque;
    private $cervejaria_cnpj;
    
    public function __construct() {        
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }
    
    function setIdFabricas($value) {
        $this->idFabricas = $value;
    }

    function setCidade($value) {
        $this->cidade = $value;
    }

    function setEstado($value) {
        $this->estado = $value;
    }

    function setQuantestoque($value) {
        $this->quantestoque = $value;
    }

   function setCervejaria_cnpj($value) {
        if(strlen($value)==0){
            $value = NULL;
        }
        $this->cervejaria_cnpj = $value;
    }


    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `Fabricas`(`cidade`,`estado`,`quantestoque`, `cervejaria_cnpj`) VALUES(:cidade,:estado,:quantestoque, :cervejaria_cnpj)");
            $stmt->bindParam(":cidade", $this->cidade);
            $stmt->bindParam(":estado", $this->estado);
            $stmt->bindParam(":quantestoque", $this->quantestoque);
            $stmt->bindParam(":cervejaria_cnpj", $this->cervejaria_cnpj);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }             
    }
    
    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `Fabricas` SET `cidade` = :cidade, `estado` = :estado, `quantestoque` = :quantestoque, `cervejaria_cnpj` = :cervejaria_cnpj WHERE `idFabricas` = :idFabricas");
            $stmt->bindParam(":idFabricas", $this->idFabricas);
            $stmt->bindParam(":cidade", $this->cidade);
            $stmt->bindParam(":estado", $this->estado);
            $stmt->bindParam(":quantestoque", $this->quantestoque);
            $stmt->bindParam(":cervejaria_cnpj", $this->cervejaria_cnpj);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
        
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `Fabricas` WHERE `idFabricas` = :idFabricas");
            $stmt->bindParam(":idFabricas", $this->idFabricas);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `Fabricas` WHERE `idFabricas` = :idFabricas");
        $stmt->bindParam(":idFabricas", $this->idFabricas);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    
    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `Fabricas` WHERE 1");
        $stmt->execute();
        return $stmt;
    }

    public function index2(){ 
        $stmt = $this->conn->prepare("SELECT * FROM `Cervejaria` WHERE 1");
        $stmt->execute();
        return $stmt;
    }
}