<?php
	require'autoloader.php';

	use BD\Cervejaria\Model\Cervejaria;
	use BD\Cervejaria\Model\Cerveja;
	use BD\Cervejaria\Model\Producao;

	$cervejaria = new Cervejaria();
	$cerveja = new Cerveja();
	$producao = new Producao();

	if(isset($_POST['select'])){
    	$cervejaria->setIdCerveja($_POST['idCerveja']);
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
			<h2>Relatório das Cervejarias e Cervejas</h2>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Cervejaria</th>
						<th>Cerveja</th>
					</tr>
					<?php
					$stmt = $producao->index();
					
					while($row = $stmt->fetch(PDO::FETCH_OBJ)){
					?>
					<tbody>
						<tr>
							<?php 
							$cervejaria->setCnpj($row->Cervejaria_cnpj); 
							$stmtMestre = $cervejaria->view();
							?>
							<td><?php echo $stmtMestre->nome ;?></td>
							<?php 
							$cerveja->setIdCerveja($row->Cerveja_idCerveja); 
							$stmtMestre = $cerveja->view();
							?>
							<td><?php echo $stmtMestre->nome ;?></td>

						<?php 
						}
						?>  
						</tr>
						</tbody>
				</thead>
			</table>
		</div>
	</div>	
</body>
</html>
