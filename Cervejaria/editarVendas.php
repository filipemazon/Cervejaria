<?php
require'autoloader.php';

use BD\Cervejaria\Model\VendasEvento;
use BD\Cervejaria\Model\Cerveja;
use BD\Cervejaria\Model\Eventos;

$vendas = new VendasEvento();
$cerveja = new Cerveja();
$evento = new Eventos();

if(isset($_POST['edit'])){
	$vendas->setEventos_idEventos($_POST['Eventos_idEventos']);
	$vendas->setCerveja_idCerveja($_POST['Cerveja_idCerveja']);
	$vendas->setValorml($_POST['valorml']);
	$vendas->setQuantidade($_POST['quantidade']);
	if($vendas->edit() == 1){
		$result = "Editado com sucesso!";
	}else{
		$error = "Erro ao editar, tente novamente!";
	}
}

if(isset($_POST['delete'])){
	$vendas->setEventos_idEventos($_POST['Eventos_idEventos']);
	$vendas->setCerveja_idCerveja($_POST['Cerveja_idCerveja']);
	if($vendas->delete() == 1){
		$result = "Deletado com sucesso!";
	}else{
		$error = "Erro ao deletar, tente novamente!";
	}
}

if (isset($_GET['Eventos_idEventos']) AND isset($_GET['Cerveja_idCerveja'])) {
	$vendas->setEventos_idEventos($_POST['Eventos_idEventos']);
	$vendas->setCerveja_idCerveja($_POST['Cerveja_idCerveja']);
	$row = $vendas->view();
	if (isset($result)) {
		echo "A venda ID(" . $result . ") foi editada<br>";
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
			<h2>Vendas Evento</h2>	
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

			<table class="table table-striped">
				<thead>
					<tr>
						<th>Evento</th>
						<th>Cerveja</th>
						<th>Valor(ml)</th>
						<th>Quantidade</th>
						<th class="actions">Ações</th>
					</tr>
				</thead>
				<?php
				$id = 0;
				$stmt = $vendas->index();
				while($row = $stmt->fetch(PDO::FETCH_OBJ)){
					$id += 1;
					?>
					<tbody>
						<tr class="<?php echo $id ?>">
							<form method="post" action="editarVendas.php">
								<td class="td_nomeEvento"><?php $evento->setIdEventos($row->Eventos_idEventos);
									$stmtEventos = $evento->view(); echo $stmtEventos->nome;?></td>
									<td class="td_nomeFabrica"><?php $cerveja->setIdCerveja($row->Cerveja_idCerveja);
										$stmtFabrica = $cerveja->view(); echo $stmtFabrica->nome;?></td>
										<td class="td_valorml"><?php echo $row->valorml ;?></td>
										<td class="td_quantidade"><?php echo $row->quantidade ;?></td>
										<td class="actions">
											<a id="abuttontomodal" class="btn btn-warning btn-xs href="#" data-toggle="modal" data-target="#edit-modal" >Editar</a>

											<input type="hidden" name="idvendas" value="<?php echo $row->Eventos_idEventos && $row->Cerveja_idCerveja; ?>">
											<button type="submit" name="delete" class="btn btn-danger btn-sm">Excluir</button>
										</td>
									</form>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
					<!-- Modal Editar-->
					<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="modalLabel">Editar Vendas Evento</h4>
								</div>
								<div class="modal-content">
									<?php
									$stmt = $vendas->index();
										?>
										<form action="editarVendas.php" method="post" class="vendass" id='vendass'>
											<div class="form-group">	
												<label for="evento">Evento:</label>
												<select id="select" name="Eventos_idEventos" action="editarVendas.php"> 
													<option value="select"> Selecione </option>
													<?php 
													$stmt = $evento->index(); 
													while($row = $stmt->fetch(PDO::FETCH_OBJ)){
														?>
														<option id= "<?php echo $row->idEventos; ?>" value="<?php echo $row->idEventos; ?>"> <?php echo $row->nome; ?> </option> 
														<?php
													}
													?>    
												</select>
												<br><label for="cerveja">Cerveja:</label>
												<select id="select" name="Cerveja_idCerveja" action="editarVendas.php"> 
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
												<br><label for="valorml">Valor:</label>
												<input type="decimals" name="valorml" id="valorml" value="" required>
												<br><label for="quantidade">Quantidade:</label>
												<input type="number" name="quantidade" id="quantidade" value="" required>



												<!--<input type="hidden" name="idvendas" value="<?php echo $row->Eventos_idEventos && $row->Cerveja_idCerveja;  ?>">-->

												<button type="submit" name="edit" class="btn btn-success btn-sm">Editar</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
												
										</div>
									</form>
								</div>    
							</div>
						</div>
					</div>
				</div>
			</div>
		</body>
		</html>
<script>
	$(function(){
		$('a').click(function(){
			var $row = $(this).closest('tr');
			var rowID = $row.attr('class').split('_')[1];
			var evento =  $row.find('.td_nomeEvento').text();
			var fabrica =  $row.find('.td_nomeFabrica').text();
			var valorml =  $row.find('.td_valorml').text();
			var quantidade =  $row.find('.td_quantidade').text();
			$('#evento').val(evento);
			$('#fabrica').val(fabrica);
			$('#valorml').val(valorml);
			$('#quantidade').val(quantidade);
		});
	});

</script>