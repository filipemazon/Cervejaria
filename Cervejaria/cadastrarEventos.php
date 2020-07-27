<?php

require'autoloader.php';

use BD\Cervejaria\Model\Eventos;

$evento = new Eventos();

if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case "insert":
		$evento->setNome($_POST['nome']);
		$evento->setData($_POST['data']);
		$evento->setPublico($_POST['publico']);
		$evento->setDinheiro($_POST['dinheiro']);
		$evento->setIngresso($_POST['ingresso']);
		$evento->setCusto($_POST['custo']);
		if($evento->insert() == 1){
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

			<h2>Formulário de Cadastro - Eventos</h2>
			<form action="cadastrarEventos.php" method="post" class="evento" id='evento'>
				<div class="form-group">	
					<label>Nome:</label>
					<input type="text" name="nome" id="nome" class="form-text" placeholder="Nome da evento" required>
					<br><label>Data:</label>
					<input type="date" name="data" id="data" required>
					<br><label>Público:</label>
					<input type="number" name="publico" id="publico" placeholder="1000" required>
					<br><label>Dinheiro  injetado:</label>
					<input type="decimals" name="dinheiro" id="dinheiro" placeholder="1500.00" required>
					<br><label>Ingresso:</label>
					<input type="decimals" name="ingresso" id="ingresso" placeholder="50.00" required>
					<br><label>Custo:</label>
					<input type="decimals" name="custo" id="custo" class="form-text" placeholder="5000.00" required>

					<input type="hidden" name="action" value="insert">
					<br><button type="submit" value="Cadastrar" class="btn btn-success btn-sm">Cadastrar</button>
				</div>
			</form>	
		</div>
	</div>
</body>
</html>
