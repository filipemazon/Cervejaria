<?php
require'autoloader.php';

use BD\Cervejaria\Model\Eventos;

$evento = new Eventos();

if(isset($_POST['edit'])){
	$evento->setIdEventos($_POST['idEventos']);
	$evento->setNome($_POST['nome']);
	$evento->setData($_POST['data']);
	$evento->setPublico($_POST['publico']);
	$evento->setDinheiro($_POST['dinheiro']);
	$evento->setIngresso($_POST['ingresso']);
	$evento->setCusto($_POST['custo']);
	if($evento->edit() == 1){
		$result = "Editado com sucesso!";
	}else{
		$error = "Erro ao editar, tente novamente!";
	}
}

if(isset($_POST['delete'])){
	$evento->setIdEventos($_POST['idEventos']);
	if($evento->delete() == 1){
		$result = "Deletado com sucesso!";
	}else{
		$error = "Erro ao deletar, tente novamente!";
	}
}

if (isset($_GET['idEventos'])) {
	$evento->setIdEventos($_GET['idEventos']);
	$row = $evento->view();
	if (isset($result)) {
		echo "O evento ID(" . $result . ") foi editado<br>";
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
			<h2>Eventos</h2>	
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
						<th>ID</th>
						<th>Nome</th>
						<th>Data</th>
						<th>Público</th>
						<th>Dinheiro</th>
						<th>Ingresso</th>
						<th>Custo</th>
						<th class="actions">Ações</th>
					</tr>
				</thead>
				<?php
				$id = 0;
				$stmt = $evento->index();
				while($row = $stmt->fetch(PDO::FETCH_OBJ)){
					$id += 1;
					?>
					<tbody>
						<tr class="<?php echo $id ?>">
							<form method="post" action="editarEventos.php">
								<td class="td_idEventos"><?php echo $row->idEventos ;?></td>
								<td class="td_nome"><?php echo $row->nome ;?></td>
								<td class="td_data"><?php echo $row->data ;?></td>
								<td class="td_publico"><?php echo $row->publico ;?></td>
								<td class="td_dinheiro"><?php echo $row->dinheiro ;?></td>
								<td class="td_ingresso"><?php echo $row->ingresso ;?></td>
								<td class="td_custo"><?php echo $row->custo ;?></td>
								<td class="actions">
									<a id="abuttontomodal" class="btn btn-warning btn-xs href="#" data-toggle="modal" data-target="#edit-modal" >Editar</a>


									<input type="hidden" name="idEventos" value="<?php echo $row->idEventos; ?>">
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
							<h4 class="modal-title" id="modalLabel">Editar Eventos</h4>
						</div>
						<div class="modal-content">
							<?php
							$stmt = $evento->view();
								?>
								<form action="editarEventos.php" method="post" class="eventos" id='eventos'>
									<div class="form-group">	
										<label for="nome">Nome:</label>
										<input type="text" name="nome" id="nome" class="form-text" value="" required>
										<br><label for="data">Data:</label>
										<input type="date" name="data" id="data" value="" required>
										<br><label for="publico">Público:</label>
										<input type="number" name="publico" id="publico" value="" required>
										<br><label for="dinheiro">Dinheiro:</label>
										<input type="decimals" name="dinheiro" id="dinheiro" class="form-text" value="" required>
										<br><label for="ingresso">Ingresso:</label>
										<input type="decimals" name="ingresso" id="ingresso" class="form-text" value="" required>
										<br><label for="custo">Custo:</label>
										<input type="decimals" name="custo" id="custo" class="form-text" value="" required>

										<br><input type="text" name="idEventos" id="idEventos" value="">
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
			var idEventos =  $row.find('.td_idEventos').text();
			var nome =  $row.find('.td_nome').text();
			var data =  $row.find('.td_data').text();
			var publico =  $row.find('.td_publico').text();
			var dinheiro =  $row.find('.td_dinheiro').text();
			var ingresso =  $row.find('.td_ingresso').text();
			var custo =  $row.find('.td_custo').text();
			$('#idEventos').val(idEventos);
			$('#nome').val(nome);
			$('#data').val(data);
			$('#publico').val(publico);
			$('#dinheiro').val(dinheiro);
			$('#ingresso').val(ingresso);
			$('#custo').val(custo);
			
		});
	});

</script>
