<?php

require'autoloader.php';

use BD\Cervejaria\Model\Producao;
use BD\Cervejaria\Model\Cerveja;
use BD\Cervejaria\Model\Cervejaria;
use BD\Cervejaria\Model\Fabricas;

$producao = new Producao();
$cerveja = new Cerveja(); 
$fabrica =  new Fabricas(); 
$cervejaria = new Cervejaria(); 


if(isset($_POST['select'])){
    $producao->setCervejaria_cnpj($_POST['Cervejaria_cnpj']);
    $producao->setFabricas_idFabricas($_POST['Fabricas_idFabricas']);
    $producao->setCerveja_idCerveja($_POST['setCerveja_idCerveja']); 

}

if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case "insert":
		$producao->setData($_POST['data']);
		$producao->setQuantidade($_POST['quantidade']);
		$producao->setCervejaria_cnpj($_POST['Cervejaria_cnpj']);
    	$producao->setFabricas_idFabricas($_POST['Fabricas_idFabricas']);
    	$producao->setCerveja_idCerveja($_POST['setCerveja_idCerveja']); 
		if($producao->insert() == 1){
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

			<h2>Formulário de Cadastro - Produção</h2>
			<form action="cadastrarProducao.php" method="post" class="producao" id='producao'>
				<div class="form-group">	
					<label>Data:</label>
					<input type="date" name="data" id="data" placeholder="DD/MM/AAAA" required>
					<br><label>Quantidade:</label>
					<input type="number" name="quantidade" id="quantidade" placeholder="100" required>
					

					<br><label>Cervejaria:</label>
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
                   
                     
                    </select>
					
					<br><label>Fábrica:</label>
					<select id="select" name="Fabricas_idFabricas" action="cadastrarMestre.php"> 
                    <option value="select"> Selecione </option>
                        <?php 
                        $stmt = $fabrica->index(); 
                        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <option id= "<?php echo $row->idFabricas; ?>" value="<?php echo $row->idFabricas; ?>"> <?php echo $row->cidade; ?>   
                         </option> 
                    <?php
                    }
                    ?>    
                     
                    </select>
					
					<br><label>Cerveja:</label>
					<select id="select" name="setCerveja_idCerveja" action="cadastrarMestre.php"> 
                    <option value="select"> Selecione </option>
                        <?php 
                        $stmt = $cerveja->index(); 
                        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <option id= "<?php echo $row->idCerveja; ?>" value="<?php echo $row->idCerveja; ?>"> <?php echo $row->nome; ?>   
                         </option> 
                    <?php
                    }
                    ?>    
                     
                    </select>
					
					<input type="hidden" name="action" value="insert">
					<br><button type="submit" value="Cadastrar" class="btn btn-success btn-sm">Cadastrar</button>
				</div>
			</form>
		</div>
	</div>	
</body>
</html>
