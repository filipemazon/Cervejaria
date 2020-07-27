<?php
require'autoloader.php';

use BD\Cervejaria\Model\MestreCervejeiro;

$mestre = new MestreCervejeiro();

if(isset($_POST['edit'])){
	$mestre->setCpf($_POST['cpf']);
	$mestre->setNome($_POST['nome']);
	$mestre->setCidade($_POST['cidade']);
	$mestre->setEstado($_POST['estado']);
	if($mestre->edit() == 1){
		$result = "Editado com sucesso!";
	}else{
		$error = "Erro ao editar, tente novamente!";
	}
}

if(isset($_POST['delete'])){
	$mestre->setCpf($_POST['cpf']);
	if($mestre->delete() == 1){
		$result = "Deletado com sucesso!";
	}else{
		$error = "Erro ao deletar, tente novamente!";
	}
}

if (isset($_GET['cpf'])) {
	$mestre->setCpf($_GET['cpf']);
	$row = $mestre->view();
	if (isset($result)) {
		echo "O mestre ID(" . $result . ") foi editado<br>";
	}
}



include('header.php');
?>

	<div class="container">
		<div class="row">
			<h2>Mestre Cervejeiro</h2>
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
						<th>CPF</th>
						<th>Nome</th>
						<th>Cidade</th>
						<th>Estado</th>
						<!--<th>Cervejaria</th>-->
						<th class="actions">Ações</th>
					</tr>
				</thead>
				<?php
				$id = 0;
				$stmt = $mestre->index();
				while($row = $stmt->fetch(PDO::FETCH_OBJ)){
					$id += 1;
					?>
					<tbody>
						<tr class="<?php echo $id ?>">
							<form method="post" action="editarMestre.php">
								<td class="td_cpf"><?php echo $row->cpf ;?></td>
								<td class="td_nome"><?php echo $row->nome ;?></td>
								<td class="td_cidade"><?php echo $row->cidade ;?></td>
								<td class="td_estado"><?php echo $row->estado ;?></td>
								<td class="actions">
									<a id="abuttontomodal" class="btn btn-warning btn-xs href="#" data-toggle="modal" data-target="#edit-modal" >Editar</a>
									<input type="hidden" name="cpf" value="<?php echo $row->cpf; ?>">
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
						<div class="modal-header" style="padding: 10px 65px;">
							<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="modalLabel">Editar Mestre Cervejeiro</h4>
						</div>
						<div class="modal-content">
							<?php
							$stmt = $mestre->view();
								?>
								<form action="editarMestre.php" method="post" class="mestre" id='mestre'>
									<div class="form-group"  style="text-align: center;">	
										<label for="cpf">CPF:</label>
										<input type="text" name="cpf" id="cpf" class="form-text" value="" required><br>
										<label for="nome">Nome:</label>
										<input type="text" name="nome" id="nome" class="form-text" value="" required><br>
										<label for="cidade">Cidade:</label>
										<input type="text" name="cidade" id="cidade" class="form-text" value="" required><br>
										<label for="estado">Estado:</label>
										<input type="text" name="estado" id="estado" class="form-text" value="" required><br>

										<!--<br><input type="text" id="cpf" name="cpf" value="">-->
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
	
	<script>
	$(function(){
		$('a').click(function(){
			var $row = $(this).closest('tr');
			var rowID = $row.attr('class').split('_')[1];
			var cpf =  $row.find('.td_cpf').text();
			var nome =  $row.find('.td_nome').text();
			var cidade =  $row.find('.td_cidade').text();
			var estado =  $row.find('.td_estado').text();
			$('#cpf').val(cpf);
			$('#nome').val(nome);
			$('#cidade').val(cidade);
			$('#estado').val(estado);
		});
	});

</script>
