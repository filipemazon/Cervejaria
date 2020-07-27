<?php

require'autoloader.php';

use BD\Cervejaria\Model\VendasEvento;
use BD\Cervejaria\Model\Cerveja;
use BD\Cervejaria\Model\Eventos;

$vendas = new VendasEvento();
$cerveja = new Cerveja();
$eventos = new Eventos();

if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case "insert":
		$vendas->setEventos_idEventos($_POST['Eventos_idEventos']);
		$vendas->setCerveja_idCerveja($_POST['Cerveja_idCerveja']);
		$vendas->setValorml($_POST['valorml']);
		$vendas->setQuantidade($_POST['quantidade']);
		if($vendas->insert() == 1){
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

			<h2>Formulário de Cadastro - Vendas Evento</h2>
			<form action="cadastrarVendas.php" method="post" class="vendas" id='vendas'>
				<div class="form-group">	
					<label>Evento:</label>
					<select id="select" name="Eventos_idEventos"> 
						<?php
							$stmt = $eventos->index();
							while($row = $stmt->fetch(PDO::FETCH_OBJ)){ 
						?>
							<option id="<?php echo $row->idEventos ?>" value="<?php echo $row->idEventos ?>">
								<?php echo $row->nome ?>
							</option>
						<?php
							}
						?>
					</select>
					<br><label>Cerveja:</label>
					<select id="select" name="Cerveja_idCerveja">
						<?php
							$stmt = $cerveja->index();
							while($row = $stmt->fetch(PDO::FETCH_OBJ)){
								?>
							<option id="<?php echo $row->idCerveja ?>" value="<?php echo $row->idCerveja ?>">
								<?php echo $row->nome ?>								
							</option>
						<?php
							}						
						?>
					</select>
					<br><label>Valor unitário:</label>
					<input type="decimals" name="valorml" id="valorml" placeholder="10.50" required>
					<br><label>Quantidade:</label>
					<input type="number" name="quantidade" id="quantidade" placeholder="10" required>

					<input type="hidden" name="action" value="insert">
					<button type="submit" value="Cadastrar" class="btn btn-success btn-sm">Cadastrar</button>
				</div>
			</form>	
		</div>
	</div>
</body>
</html>
