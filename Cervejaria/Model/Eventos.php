<?php

namespace BD\Cervejaria\Model;

use \PDO;
use \PDOException;

class Eventos {
    
    private $idEventos;
    private $nome;
    private $data;
    private $publico;
    private $dinheiro;
    private $ingresso;
    private $custo;

    public function __construct() {        
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }
    
    function setIdEventos($value) {
        $this->idEventos = $value;
    }

    function setNome($value) {
        $this->nome = $value;
    }

    function setData($value) {
        $this->data = $value;
    }

    function setPublico($value) {
        $this->publico = $value;
    }

    function setDinheiro($value) {
        $this->dinheiro = $value;
    }

    function setIngresso($value) {
        $this->ingresso = $value;
    }

    function setCusto($value) {
        $this->custo = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `Eventos`(`nome`,`data`,`publico`,`dinheiro`,`ingresso`,`custo`) VALUES(:nome,:data,:publico,:dinheiro,:ingresso,:custo)");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":publico", $this->publico);
            $stmt->bindParam(":dinheiro", $this->dinheiro);         
            $stmt->bindParam(":ingresso", $this->ingresso);
            $stmt->bindParam(":custo", $this->custo);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }             
    }
    
    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `Eventos` SET `nome` = :nome, `data` = :data, `publico` = :publico, `dinheiro` = :dinheiro, `ingresso` = :ingresso, `custo` = :custo WHERE `idEventos` = :idEventos");
            $stmt->bindParam(":idEventos", $this->idEventos);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":publico", $this->publico);
            $stmt->bindParam(":dinheiro", $this->dinheiro);
            $stmt->bindParam(":ingresso", $this->ingresso);
            $stmt->bindParam(":custo", $this->custo);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `Eventos` WHERE `idEventos` = :idEventos");
            $stmt->bindParam(":idEventos", $this->idEventos);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `Eventos` WHERE `idEventos` = :idEventos");
        $stmt->bindParam(":idEventos", $this->idEventos);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    
    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `Eventos` WHERE 1");
        $stmt->execute();
        return $stmt;
    }

    public function order(){
        try{
            $stmt = $this->conn->prepare('SELECT * FROM `eventos` WHERE 1 ORDER BY data DESC');
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            return $e->getMessage();
        } 
    }

    public function lucrosEventos(){
        $stmt = $this->conn->prepare("SELECT `nome`, `data`, `dinheiro`, `ingresso`, `publico`, `custo`, SUM(`valorml`*`quantidade`) as `soma` FROM `eventos`, `vendasevento` WHERE `idEventos` = `Eventos_idEventos` GROUP BY `idEventos`");
        $stmt->execute();
        return $stmt;
    }
}