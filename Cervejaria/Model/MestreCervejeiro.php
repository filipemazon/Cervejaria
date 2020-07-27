<?php

namespace BD\Cervejaria\Model;

use \PDO;
use \PDOException;

class MestreCervejeiro {
    
    private $cpf;
    private $nome;
    private $cidade;
    private $estado;
    private $cervejaria_cnpj;
    
    public function __construct() {        
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }
    
    function setCpf($value) {
        $this->cpf = $value;
    }

    function setNome($value) {
        $this->nome = $value;
    }

    function setCidade($value) {
        $this->cidade = $value;
    }

    function setEstado($value) {
        $this->estado = $value;
    }

    function setCervejaria_cnpj($value) {
        if(strlen($value)==0){
            $value = NULL;
        }
        $this->cervejaria_cnpj = $value;
    }


    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `MestreCervejeiro`(`cpf`,`nome`,`cidade`,`estado`, `cervejaria_cnpj`) VALUES(:cpf,:nome,:cidade,:estado, :cervejaria_cnpj)");
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":cidade", $this->cidade);
            $stmt->bindParam(":estado", $this->estado);
            $stmt->bindParam(":cervejaria_cnpj", $this->cervejaria_cnpj);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }             
    }
    
    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `MestreCervejeiro` SET `nome` = :nome, `cidade` = :cidade, `estado`  = :estado, `cervejaria_cnpj` = :cervejaria_cnpj WHERE `cpf` = :cpf");
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":cidade", $this->cidade);
            $stmt->bindParam(":estado", $this->estado);
            $stmt->bindParam(":cervejaria_cnpj", $this->cervejaria_cnpj);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
        
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `MestreCervejeiro` WHERE `cpf` = :cpf");
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `MestreCervejeiro` WHERE `cpf` = :cpf");
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    
    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `MestreCervejeiro` WHERE 1");
        $stmt->execute();
        return $stmt;
    }

    public function rankingMestre(){
        try{
            $stmt = $this->conn->prepare('SELECT ALL cpf, mestrecervejeiro.nome, COUNT(*) AS CONT FROM `mestrecervejeiro`, `cerveja` WHERE cerveja.MestreCervejeiro_cpf = mestrecervejeiro.cpf GROUP BY cpf ORDER BY CONT DESC');
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            return $e->getMessage();
        } 
    }
}