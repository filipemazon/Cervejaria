<?php
  
require'autoloader.php';
  
use BD\Cervejaria\Model\MestreCervejeiro;
use BD\Cervejaria\Model\Cervejaria;
  
$mestre = new MestreCervejeiro();
$cervejaria = new Cervejaria(); 
  
  
if(isset($_POST['select'])){
    $mestre->setCervejaria_cnpj($_POST['Cervejaria_cnpj']);
}
  
  
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case "insert":
        $mestre->setCpf($_POST['cpf']);
        $mestre->setNome($_POST['nome']);
        $mestre->setCidade($_POST['cidade']);
        $mestre->setEstado($_POST['estado']);
        $mestre->setCervejaria_cnpj($_POST['Cervejaria_cnpj']);
  
  
        if($mestre->insert() == 1){
            $result = "Inserido com sucesso!";
        }else{
            $error = "Erro ao inserir, tente novamente!";
        }
    }
}
include('header.php');
?>
  
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <div class="container">
        <div class="row">
            <?php
            if (isset($result)) {
                ?>
                <div class="alert alert-success">
                    <?php echo $result; ?>
                </div>
                <?php
            }else if(isset($error)){
                ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
                <?php
            }
            ?>
  
            <h2>Formulário de Cadastro - Mestre Cervejeiro</h2>
            <form action="cadastrarMestre.php" method="post" class="mestre" id='mestre'>
                <div class="form-group">  
                    <label>CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="form-text" placeholder="XXX.XXX.XXX-XX" required>
                    <label>Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-text" placeholder="Nome do Cervejeiro" required>
                    <label>Cidade:</label>
                    <input type="text" name="cidade" id="cidade" class="form-text" placeholder="Cidade" required>
                    <label>Estado:</label>
                    <input type="text" name="estado" id="estado" class="form-text" placeholder="XX" required>
                    <br><br><label>Cervejaria:</label>
                    <select id="select" name="Cervejaria_cnpj" action="cadastrarMestre.php"> 
                    <option value="select"> Selecione </option>
                        <?php 
                        $stmt = $cervejaria->index(); 
                        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <option id= "<?php echo $row->cnpj; ?>" value="<?php echo $row->cnpj; ?>"> <?php echo $row->nome; ?>   
                         </option> 
                    <?php
                    }
                    ?>    
                    <option value=""> Cervejeiro Independente</option>
                      
                    </select>
  
                      
                      
                    <input type="hidden" name="action" value="insert">
                    <button type="submit" value="Cadastrar" class="btn btn-success btn-sm">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>    
</body>
</html>