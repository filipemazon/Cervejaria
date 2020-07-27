<?php

namespace BD\Cervejaria\Model;

use \PDO;
use \PDOException;

class Cervejaria {
    
    private $cnpj;
    private $nome;
    private $endereco;
    private $cidade;
    private $estado;
    private $email;
    private $telefone;
    private $site;
    private $logo;

    public function __construct() {        
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }
    
    function setCnpj($value) {
        $this->cnpj = $value;
    }

    function setNome($value) {
        $this->nome = $value;
    }

    function setEndereco($value) {
        $this->endereco = $value;
    }

    function setCidade($value) {
        $this->cidade = $value;
    }

    function setEstado($value) {
        $this->estado = $value;
    }

    function setEmail($value) {
        $this->email = $value;
    }

    function setTelefone($value) {
        $this->telefone = $value;
    }

    function setSite($value) {
        $this->site = $value;
    }

    function setLogo($value) {
        $this->logo = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `Cervejaria`(`cnpj`,`nome`,`endereco`,`cidade`,`estado`,`email`,`telefone`,`site`,`logo`) VALUES(:cnpj,:nome,:endereco,:cidade,:estado,:email,:telefone,:site,:logo)");
            $stmt->bindParam(":cnpj", $this->cnpj);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":endereco", $this->endereco);
            $stmt->bindParam(":cidade", $this->cidade);
            $stmt->bindParam(":estado", $this->estado);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":telefone", $this->telefone);
            $stmt->bindParam(":site", $this->site);
            $stmt->bindParam(":logo", $this->logo);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }             
    }
    
    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `Cervejaria` SET `cnpj` = :cnpj, `nome` = :nome, `endereco` = :endereco, `cidade` = :cidade, `estado` = :estado, `email` = :email, `telefone` = :telefone, `site` = :site, `logo` = :logo WHERE `cnpj` = :cnpj");
            $stmt->bindParam(":cnpj", $this->cnpj);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":endereco", $this->endereco);
            $stmt->bindParam(":cidade", $this->cidade);
            $stmt->bindParam(":estado", $this->estado);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":telefone", $this->telefone);
            $stmt->bindParam(":site", $this->site);
            $stmt->bindParam(":logo", $this->logo);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }   
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `Cervejaria` WHERE `cnpj` = :cnpj");
            $stmt->bindParam(":cnpj", $this->cnpj);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `Cervejaria` WHERE `cnpj` = :cnpj");
        $stmt->bindParam(":cnpj", $this->cnpj);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    
    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `Cervejaria` WHERE 1");
        $stmt->execute();
        return $stmt;
    }

}