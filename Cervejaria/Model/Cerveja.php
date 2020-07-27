<?php

namespace BD\Cervejaria\Model;

use \PDO;
use \PDOException;

class Cerveja {
    
    private $idCerveja;
    private $nome;
    private $coloracao;
    private $ibu;
    private $lupulo;
    private $malte;
    private $levedura;
    private $extras;
    private $instrucoes;
    private $MestreCervejeiro_cpf;
    private $Tipo_idTipo;

    public function __construct() {        
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }
    
    function setIdCerveja($value) {
        $this->idCerveja = $value;
    }

    function setNome($value) {
        $this->nome = $value;
    }

    function setColoracao($value) {
        $this->coloracao = $value;
    }

    function setIbu($value) {
        $this->ibu = $value;
    }

    function setLupulo($value) {
        $this->lupulo = $value;
    }

    function setMalte($value) {
        $this->malte = $value;
    }

    function setLevedura($value) {
        $this->levedura = $value;
    }

    function setExtras($value) {
        $this->extras = $value;
    }

    function setInstrucoes($value) {
        $this->instrucoes = $value;
    }

    function setMestreCervejeiro($value){
        $this->MestreCervejeiro_cpf = $value;
    }

    function setTipo($value){
        $this->Tipo_idTipo = $value;
    }    

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `Cerveja`(`nome`,`coloracao`,`ibu`,`lupulo`,`malte`,`levedura`,`extras`,`instrucoes`,`MestreCervejeiro_cpf`,`Tipo_idTipo`) VALUES(:nome,:coloracao,:ibu,:lupulo,:malte,:levedura,:extras,:instrucoes,:MestreCervejeiro_cpf,:Tipo_idTipo)");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":coloracao", $this->coloracao);
            $stmt->bindParam(":ibu", $this->ibu);
            $stmt->bindParam(":lupulo", $this->lupulo);
            $stmt->bindParam(":malte", $this->malte);
            $stmt->bindParam(":levedura", $this->levedura);
            $stmt->bindParam(":extras", $this->extras);
            $stmt->bindParam(":instrucoes", $this->instrucoes);
            $stmt->bindParam(":MestreCervejeiro_cpf", $this->MestreCervejeiro_cpf);
            $stmt->bindParam(":Tipo_idTipo", $this->Tipo_idTipo);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }             
    }
    
    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `Cerveja` SET `nome` = :nome, `coloracao` = :coloracao, `ibu` = :ibu, `lupulo` = :lupulo, `malte` = :malte, `levedura` = :levedura, `extras` = :extras, `instrucoes` = :instrucoes, `MestreCervejeiro_cpf` = :MestreCervejeiro_cpf WHERE `idCerveja` = :idCerveja");
            $stmt->bindParam(":idCerveja", $this->idCerveja);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":coloracao", $this->coloracao);
            $stmt->bindParam(":ibu", $this->ibu);
            $stmt->bindParam(":lupulo", $this->lupulo);
            $stmt->bindParam(":malte", $this->malte);
            $stmt->bindParam(":levedura", $this->levedura);
            $stmt->bindParam(":extras", $this->extras);
            $stmt->bindParam(":instrucoes", $this->instrucoes);
            $stmt->bindParam(":MestreCervejeiro_cpf", $this->MestreCervejeiro_cpf);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
        
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `Cerveja` WHERE `idCerveja` = :idCerveja ");
            $stmt->bindParam(":idCerveja", $this->idCerveja);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `Cerveja` WHERE `idCerveja` = :idCerveja");
        $stmt->bindParam(":idCerveja", $this->idCerveja);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    
    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `Cerveja` WHERE 1");
        $stmt->execute();
        return $stmt;
    }
}