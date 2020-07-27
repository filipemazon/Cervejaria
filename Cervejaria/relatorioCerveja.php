<?php
require'autoloader.php';

use BD\Cervejaria\Model\Cerveja;
use BD\Cervejaria\Model\MestreCervejeiro;
use BD\Cervejaria\Model\Tipo;

$cerveja = new Cerveja();
$mestre = new MestreCervejeiro();
$tipo = new Tipo();

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
			<h2>Relatório Cerveja</h2>	
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Coloração</th>
						<th>IBU</th>
						<th>Lúpulo</th>
						<th>Malte</th>
						<th>Levedura</th>
						<th>Extras</th>
						<th>Instruções</th>
						<th>Mestre</th>
						<th>Tipo</th>
						<th>País Origem</th>
						<th>Copo Ideal</th>
					</tr>
				</thead>
				<?php
				$stmt = $cerveja->index();
				while($row = $stmt->fetch(PDO::FETCH_OBJ)){
					?>
					<tbody>
						<tr>
							<form method="post" action="editarCerveja.php">
								<td><?php echo $row->idCerveja ;?></td>
								<td><?php echo $row->nome ;?></td>
								<td><?php echo $row->coloracao ;?></td>
								<td><?php echo $row->ibu ;?></td>
								<td><?php echo $row->lupulo ;?></td>
								<td><?php echo $row->malte ;?></td>
								<td><?php echo $row->levedura ;?></td>
								<td><?php echo $row->extras ;?></td>
								<td><?php echo $row->instrucoes ;?></td>
								<?php
									$mestre->setCpf($row->MestreCervejeiro_cpf);
									$stmtMestre = $mestre->view();
								?>
								<td><?php echo $stmtMestre->nome ;?></td>

								<?php
									$tipo->setIdTipo($row->Tipo_idTipo);
									$stmtTipo = $tipo->view();
								?>
								<td><?php echo $stmtTipo->nometipo ;?></td>
								<td><?php echo $stmtTipo->paisorigem ;?></td>
								<td><?php echo $stmtTipo->copo ;?></td>
							</form>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>