<?php
	require'autoloader.php';

	use BD\Cervejaria\Model\Cervejaria;
	use BD\Cervejaria\Model\Fabricas;

	$cervejaria = new Cervejaria();
	$fabrica = new Fabricas();

	if(isset($_POST['select'])){
    	$cervejaria->setIdFabricas($_POST['idFabricas']);
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
			<h2>Relatório das Cervejarias e Fábricas</h2>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Fabrica </th>
						<th>Cervejaria </th>
					</tr>
					<?php
					$id = 0;
					$stmt = $fabrica->index();
					$stmt2 = $cervejaria->index();
					
					while($row = $stmt->fetch(PDO::FETCH_OBJ)){
					
					?>
					<tbody>
						<tr>
							<td><?php echo $row->cidade ;?></td>
							<?php
							/*
								$fabrica->setCervejaria_cnpj($row->cnpj);
								$stmtCervejaria = $fabrica->view();
							*/

								$stmt2 = $cervejaria->index();
								while($row2 = $stmt2->fetch(PDO::FETCH_OBJ)){
									if($row2->cnpj == $row->Cervejaria_cnpj){
										?> 
										<td><?php echo $row2->nome ;?></td>
										<?php
									}
								
								}
							?>
							
						</tr>
					</tbody>
					<?php
					}
					?>
				</thead>
			</table>
		</div>
	</div>	
</body>
</html>
