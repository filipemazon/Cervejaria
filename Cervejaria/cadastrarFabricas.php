<?php
 
require'autoloader.php';
 
use BD\Cervejaria\Model\Fabricas;
use BD\Cervejaria\Model\Cervejaria;
 
$fabrica = new Fabricas();
$cervejaria = new Cervejaria(); 
 
if(isset($_POST['select'])){
    $fabrica->setCervejaria_cnpj($_POST['Cervejaria_cnpj']);
}
  
 
 
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case "insert":
        $fabrica->setCidade($_POST['cidade']);
        $fabrica->setEstado($_POST['estado']);
        $fabrica->setQuantestoque($_POST['quantestoque']);
        $fabrica->setCervejaria_cnpj($_POST['Cervejaria_cnpj']);
        if($fabrica->insert() == 1){
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
 
            <h2>Formulário de Cadastro - Fábricas</h2>
            <form action="cadastrarfabricas.php" method="post" class="fabrica" id='fabrica'>
                <div class="form-group">  
                    <label>Cidade:</label>
                    <input type="text" name="cidade" id="cidade" class="form-text" placeholder="Cidade" required>
                    <label>Estado:</label>
                    <input type="text" name="estado" id="estado" class="form-text" placeholder="XX" required>
                    <label>Quantidade em estoque:</label>
                    <input type="number" name="quantestoque" id="quantestoque" placeholder="Digite 0, caso não haja estocagem">
                    <br><label>Cervejaria</label>
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
                    <option value=""> Fábrica Independente</option>
                      
                    </select>
                     
                     
                    <input type="hidden" name="action" value="insert">
                    <button type="submit" value="Cadastrar" class="btn btn-success btn-sm">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>    
</body>
</html>