<?php

namespace BD\Cervejaria\Model;

use \PDO;
use \PDOException;

class VendasEvento {
    
    private $Eventos_idEventos;
    private $Cerveja_idCerveja;
    private $valorml;
    private $quantidade;

    public function __construct() {        
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }
    
    function setEventos_idEventos($value) {
        $this->Eventos_idEventos = $value;
    }

    function setCerveja_idCerveja($value) {
        $this->Cerveja_idCerveja = $value;
    }

    function setValorml($value) {
        $this->valorml = $value;
    }

    function setQuantidade($value) {
        $this->quantidade = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `VendasEvento`(`Eventos_idEventos`,`Cerveja_idCerveja`,`valorml`,`quantidade`) VALUES(:Eventos_idEventos,:Cerveja_idCerveja,:valorml,:quantidade)");
            $stmt->bindParam(":Eventos_idEventos", $this->Eventos_idEventos);
            $stmt->bindParam(":Cerveja_idCerveja", $this->Cerveja_idCerveja);
            $stmt->bindParam(":valorml", $this->valorml);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }             
    }
    
    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `VendasEvento` SET `valorml` = :valorml, `quantidade` = :quantidade WHERE `Eventos_idEventos` = :Eventos_idEventos AND `Cerveja_idCerveja` = :Cerveja_idCerveja");
            $stmt->bindParam(":Eventos_idEventos", $this->Eventos_idEventos);
            $stmt->bindParam(":Cerveja_idCerveja", $this->Cerveja_idCerveja);
            $stmt->bindParam(":valorml", $this->valorml);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `VendasEvento` WHERE `Eventos_idEventos` = :Eventos_idEventos AND `Cerveja_idCerveja` = :Cerveja_idCerveja");
            $stmt->bindParam(":Eventos_idEventos", $this->Eventos_idEventos);
            $stmt->bindParam(":Cerveja_idCerveja", $this->Cerveja_idCerveja);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `VendasEvento` WHERE `Eventos_idEventos` = :Eventos_idEventos AND `Cerveja_idCerveja` = :Cerveja_idCerveja");
        $stmt->bindParam(":Eventos_idEventos", $this->Eventos_idEventos);
        $stmt->bindParam(":Cerveja_idCerveja", $this->Cerveja_idCerveja);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    
    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `VendasEvento` WHERE 1");
        $stmt->execute();
        return $stmt;
    }
}