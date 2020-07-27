<?php
require'autoloader.php';

use BD\Cervejaria\Model\Cerveja;
use BD\Cervejaria\Model\MestreCervejeiro;
use BD\Cervejaria\Model\Tipo;

$cerveja = new Cerveja();
$mestre = new MestreCervejeiro();
$tipo = new Tipo();

if(isset($_POST['edit'])){
	$cerveja->setIdCerveja($_POST['idCerveja']);
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
	if($cerveja->edit() == 1){
		$result = "Editado com sucesso!";
	}else{
		$error = "Erro ao editar, tente novamente!";
	}
}

/*if(isset($_POST['editToModal'])){
	echo "vsf";
	$cerveja->setIdCerveja($_POST['idCerveja']);
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
}*/

if(isset($_POST['delete'])){
	$cerveja->setIdCerveja($_POST['idCerveja_t']);
	if($cerveja->delete() == 1){
		$result = "Deletado com sucesso!";
	}else{
		$error = "Erro ao deletar, tente novamente!";
	}
}

if (isset($_GET['idCerveja'])) {
	$cerveja->setIdCerveja($_GET['idCerveja']);
	$row = $cerveja->view();
	if (isset($result)) {
		echo "A cerveja ID(" . $result . ") foi editada<br>";
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
			<h2>Cerveja</h2>	
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
						<th class="actions">Ações</th>
					</tr>
				</thead>
				<?php
				$id = 0;
				$stmt = $cerveja->index();
				while($row = $stmt->fetch(PDO::FETCH_OBJ)){
					$id += 1;
					?>

						<tr class="<?php echo $id ?>">
							<form method="post" action="editarCerveja.php">
								<td class="td_idCerveja"><?php echo $row->idCerveja ;?></td>
								<td class="td_nome"><?php echo $row->nome ;?></td>
								<td class="td_coloracao"><?php echo $row->coloracao ;?></td>
								<td class="td_ibu"><?php echo $row->ibu ;?></td>
								<td class="td_lupulo"><?php echo $row->lupulo ;?></td>
								<td class="td_malte"><?php echo $row->malte ;?></td>
								<td class="td_levedura"><?php echo $row->levedura ;?></td>
								<td class="td_extras"><?php echo $row->extras ;?></td>
								<td class="td_instrucoes"><?php echo $row->instrucoes ;?></td>
								<?php
								$mestre->setCpf($row->MestreCervejeiro_cpf);
								$stmtMestre = $mestre->view();
								?>
								<td class="td_MestreCervejeiro_cpf"><?php echo $stmtMestre->nome ;?></td>

								<?php
								$tipo->setIdTipo($row->Tipo_idTipo);
								$stmtTipo = $tipo->view();
								?>
								<td class="td_nomeTipo"><?php echo $stmtTipo->nometipo ;?></td>
								<td class="td_paisorigem"><?php echo $stmtTipo->paisorigem ;?></td>
								<td class="td_copo"><?php echo $stmtTipo->copo ;?></td>
								<td class="actions">
									<div class="table-responsive">
									<input type="hidden" id="idCerveja_t" name="idCerveja_t" value="<?php echo $row->idCerveja ?>">
									<a id="abuttontomodal" class="btn btn-warning btn-xs" href="#" data-toggle="modal" data-target="#edit-modal" >Editar</a>

									<button type="submit" name="delete" class="btn btn-danger btn-sm">Excluir</button>
									</div>
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
							<h4 class="modal-title" id="modalLabel">Editar Cerveja</h4>
						</div>
						<div class="modal-content">
							<?php
							$stmt = $cerveja->view();
							?>
							<form action="editarCerveja.php" method="post" class="cerveja" id='cerveja'>
								<div class="form-group">	
									<label for="nome">Nome:</label>
									<input type="text" name="nome" id="nome" class="form-text" value="" required>
									<br><label for="coloracao">Coloracao:</label>
									<input type="number" name="coloracao" id="coloracao" value="" required>
									<br><label for="ibu">Ibu:</label>
									<input type="number" name="ibu" id="ibu" value="" required>
									<br><label for="lupulo">Quantidade de Lupulo:</label>
									<input type="number" name="lupulo" id="lupulo" value="" required>
									<br><label for="malte">Quantidade de Malte:</label>
									<input type="number" name="malte" id="malte" value="" required>
									<br><label for="levedura">Levedura:</label>
									<input type="number" name="levedura" id="levedura" value="" required>
									<br><label for="extras">Ingredientes especiais:</label>
									<input type="textarea" name="extras" id="extras" value="">
									<br><label for="instrucoes">Instruções da fabricação:</label>
									<input type="textarea" name="instrucoes" id="instrucoes" value="" required>
									<br><label for="MestreCervejeiro_cpf">Mestre Cervejeiro:</label>
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

									<br><label for="Tipo_idTipo">Tipo:</label>
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

								<br><input type="text" id="idCerveja" name="idCerveja" value="">

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
			var idCerveja =  $row.find('.td_idCerveja').text();
			var nome =  $row.find('.td_nome').text();
			var coloracao =  $row.find('.td_coloracao').text();
			var ibu =  $row.find('.td_ibu').text();
			var lupulo =  $row.find('.td_lupulo').text();
			var malte =  $row.find('.td_malte').text();
			var levedura =  $row.find('.td_levedura').text();
			var extras =  $row.find('.td_extras').text();
			var instrucoes =  $row.find('.td_instrucoes').text();
			var MestreCervejeiro_cpf =  $row.find('.td_MestreCervejeiro_cpf').text();
			var Tipo_idTipo =  $row.find('.td_Tipo_idTipo').text();
			//$('#id').val(rowID);
			$('#idCerveja').val(idCerveja);
			$('#nome').val(nome);
			$('#coloracao').val(coloracao);
			$('#ibu').val(ibu);
			$('#lupulo').val(lupulo);
			$('#malte').val(malte);
			$('#levedura').val(levedura);
			$('#extras').val(extras);
			$('#instrucoes').val(instrucoes);
			$('#MestreCervejeiro_cpf').val(MestreCervejeiro_cpf);
			$('#Tipo_idTipo').val(Tipo_idTipo);
			//$('#myModal').modal('show');
			//alert("Passou");
		});
	});

</script>
