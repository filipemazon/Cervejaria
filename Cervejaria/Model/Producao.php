<?php

namespace BD\Cervejaria\Model;

use \PDO;
use \PDOException;

class Producao {
    
    private $idProducao;
    private $data;
    private $quantidade;
    private $cervejaria_cnpj;
    private $fabricas_idFabricas;
    private $cerveja_idCerveja; 
    
    public function __construct() {        
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }
    
    function setIdProducao($value) {
        $this->idProducao = $value;
    }

    function setData($value) {
        $this->data = $value;
    }

    function setQuantidade($value) {
        $this->quantidade = $value;
    }

    function setCervejaria_cnpj($value){ 
        $this->cervejaria_cnpj = $value; 
    }

    function setFabricas_idFabricas($value){ 
        $this->fabricas_idFabricas = $value; 
    }

    function setcerveja_idCerveja($value){ 
        $this->cerveja_idCerveja = $value; 
    }


    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `Producao`(`data`,`quantidade`, `cervejaria_cnpj`, `fabricas_idFabricas`, `cerveja_idCerveja`) VALUES(:data,:quantidade, :cervejaria_cnpj, :fabricas_idFabricas, :cerveja_idCerveja)");
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":cervejaria_cnpj", $this->cervejaria_cnpj);
            $stmt->bindParam(":fabricas_idFabricas", $this->fabricas_idFabricas);
            $stmt->bindParam(":cerveja_idCerveja", $this->cerveja_idCerveja);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }             
    }
    
    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `Producao` SET `data` = :data, `quantidade` = :quantidade, `cerveja_idCerveja`= :cervejaria_cnpj, `fabricas_idFabricas` = :fabricas_idFabricas, `cerveja_idCerveja`= :cerveja_idCerveja WHERE `idProducao` = :idProducao");
            $stmt->bindParam(":idProducao", $this->idProducao);
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":cervejaria_cnpj", $this->cervejaria_cnpj);
            $stmt->bindParam(":fabricas_idFabricas", $this->fabricas_idFabricas);
            $stmt->bindParam(":cerveja_idCerveja", $this->cerveja_idCerveja);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `Producao` WHERE `idProducao` = :idProducao");
            $stmt->bindParam(":idProducao", $this->idProducao);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `Producao` WHERE `idProducao` = :idProducao");
        $stmt->bindParam(":idProducao", $this->idProducao);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    
    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `Producao` WHERE 1");
        $stmt->execute();
        return $stmt;
    }
}