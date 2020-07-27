<?php

require'autoloader.php';

use BD\Cervejaria\Model\Cerveja;
use BD\Cervejaria\Model\MestreCervejeiro;
use BD\Cervejaria\Model\Tipo;

$cerveja = new Cerveja();
$mestre = new MestreCervejeiro();
$tipo = new Tipo();

if(isset($_POST['select'])){
	$cerveja->setMestreCervejeiro($_POST['MestreCervejeiro_cpf']);
    $cerveja->setTipo($_POST['Tipo_idTipo']);
}

if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case "insert":
		$cerveja->setNome($_POST['nome']);
		$cerveja->setColoracao($_POST['coloracao']);
		$cerveja->setIbu($_POST['ibu']);
		$cerveja->setLupulo($_POST['lupulo']);
		$cerveja->setMalte($_POST['malte']);
		$cerveja->setLevedura($_POST['levedura']);
		$cerveja->setExtras($_POST['extras']);
		$cerveja->setInstrucoes($_POST['instrucoes']);
		$cerveja->setMestreCervejeiro($_POST['MestreCervejeiro_cpf']);
		$cerveja->setTipo($_POST['Tipo_idTipo']);
		if($cerveja->insert() == 1){
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

			<h2>Formulário de Cadastro - Cerveja</h2>
			<form action="cadastrarCerveja.php" method="post" class="cerveja" id='cerveja'>
				<div class="form-group">	
					<label>Nome:</label>
					<input type="text" name="nome" id="nome" class="form-text" placeholder="Nome da cerveja" required>
					<br><label>Coloração:</label>
					<input type="number" name="coloracao" id="coloracao" placeholder="3" required>
					<br><label>IBU:</label>
					<input type="number" name="ibu" id="ibu" placeholder="15" required>
					<br><label>Quantidade de Lupulo:</label>
					<input type="number" name="lupulo" id="lupulo" placeholder="Lupulo em gramas por Litro" required>
					<br><label>Quantidade de Malte:</label>
					<input type="number" name="malte" id="malte" placeholder="Malte em Kg por Litro" required>
					<br><label>Levedura:</label>
					<input type="number" name="levedura" id="levedura" placeholder="Levedo em mg por Litro" required>
					<br><label>Ingredientes especiais:</label>
					<input type="textarea" name="extras" id="extras" placeholder="Levedo em mg por Litro">
					<br><label>Instruções da fabricação:</label>
					<input type="textarea" name="instrucoes" id="instrucoes" placeholder="Levedo em mg por Litro" required>
					<br><label>Mestre Cervejeiro:</label>
					<select id="select" name="MestreCervejeiro_cpf" action="cadastrarCerveja.php"> 
                    <option value="select"> Selecione </option>
                        <?php 
                        $stmt = $mestre->index(); 
                        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <option id= "<?php echo $row->cpf; ?>" value="<?php echo $row->cpf; ?>"> <?php echo $row->nome; ?>   
                         </option> 
                    <?php
                    }
                    ?>
                    </select>
					<br><label>Tipo:</label>
                    <select id="select" name="Tipo_idTipo" action="cadastrarCerveja.php"> 
                    <option value="select"> Selecione </option>
                        <?php 
                        $stmt = $tipo->index(); 
                        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <option id= "<?php echo $row->idTipo; ?>" value="<?php echo $row->idTipo; ?>"> <?php echo $row->nometipo; ?>   
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
