<?php
require'autoloader.php';

use BD\Cervejaria\Model\Fabricas;
use BD\Cervejaria\Model\Cervejaria;

$fabrica = new Fabricas();
$cervejaria = new Cervejaria();


if(isset($_POST['select'])){
    $fabrica->setCervejaria_cnpj($_POST['Cervejaria_cnpj']);
}

if(isset($_POST['edit'])){
	$fabrica->setIdFabricas($_POST['idFabricas']);
	$fabrica->setCidade($_POST['cidade']);
	$fabrica->setEstado($_POST['estado']);
	$fabrica->setQuantestoque($_POST['quantestoque']);
	$fabrica->setCervejaria_cnpj($_POST['Cervejaria_cnpj']);
	if($fabrica->edit() == 1){
		$result = "Editado com sucesso!";
	}else{
		$error = "Erro ao editar, tente novamente!";
	}
}

if(isset($_POST['delete'])){
	$fabrica->setIdFabricas($_POST['idFabricas']);
	if($fabrica->delete() == 1){
		$result = "Deletado com sucesso!";
	}else{
		$error = "Erro ao deletar, tente novamente!";
	}
}

if (isset($_GET['idFabricas'])) {
	$fabrica->setIdFabricas($_GET['idFabricas']);
	$row = $fabrica->view();
	if (isset($result)) {
		echo "A fábrica ID(" . $result . ") foi editada<br>";
	}
}
include('header.php');
?>

	<div class="container">
		<div class="row">
			<h2>Fábrica</h2>
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
						<th>Cidade</th>
						<th>Estado</th>
						<th>Quantidade em estoque</th>
						<th>Cervejaria</th>
						<th class="actions">Ações</th>
					</tr>
				</thead>
				<?php
				$id = 0;
				$stmt = $fabrica->index();
				while($row = $stmt->fetch(PDO::FETCH_OBJ)){
					$id += 1;
					$stmt_cervejaria = $fabrica->index2();
					$row_cervejaria = $stmt_cervejaria->fetch(PDO::FETCH_OBJ);
					?>
					<tbody>
						<tr class="<?php echo $id ?>">
							<form method="post" action="editarFabricas.php">
								<td class="td_idFabricas"><?php echo $row->idFabricas ;?></td>
								<td class="td_cidade"><?php echo $row->cidade ;?></td>
								<td class="td_estado"><?php echo $row->estado ;?></td>
								<td class="td_quantestoque"><?php echo $row->quantestoque ;?></td>
								<td class="td_cervejaria"><?php echo $row_cervejaria->nome; ?></td>
								<td class="actions">
									<a id="abuttontomodal" class="btn btn-warning btn-xs href="#" data-toggle="modal" data-target="#edit-modal" >Editar</a>

									<input type="hidden" name="idFabricas" value="<?php echo $row->idFabricas; ?>">
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
							<h4 class="modal-title" id="modalLabel">Editar Fábrica</h4>
						</div>
						<div class="modal-content">
							<?php
							$stmt = $fabrica->view();
							?>
							<form action="editarFabricas.php" method="post" class="fabrica" id='fabrica'>
								<div class="form-group"  style="text-align: center;">	
									<label for="cidade">Cidade:</label>
									<input type="text" name="cidade" id="cidade" class="form-text" value="" required>
									<br><label for="estado">Estado:</label>
									<input type="text" name="estado" id="estado" class="form-text" value="" required>
									<br><label for="quantestoque">Quantidade em estoque:</label>
									<input type="number" name="quantestoque" id="quantestoque" value="">
									<br><label for="nome">Cervejaria:</label>
									<select id="select" name="Cervejaria_cnpj" action="editarFabricas.php"> 
                    				<option value="select"> Selecione </option>
					                        <?php 
					                        $stmt = $cervejaria->index(); 
					                        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
					                        ?>
					                        <option id= "<?php echo $row->cnpj; ?>" value="<?php echo $row->cnpj; ?>"> <?php echo $row->nome; ?>   
					                         </option> 
					                    		<?php
					                    		}
					                    		?>    
					                    	<option id= "<?php NULL ?> " value=" "> Fábrica Independente</option>
					                    	</select>
									<br><input type="text" id="idFabricas" name="idFabricas" value="">
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
			var idFabricas =  $row.find('.td_idFabricas').text();
			var cidade =  $row.find('.td_cidade').text();
			var estado =  $row.find('.td_estado').text();
			var quantestoque =  $row.find('.td_quantestoque').text();
			$('#idFabricas').val(idFabricas);
			$('#cidade').val(cidade);
			$('#estado').val(estado);
			$('#quantestoque').val(quantestoque);
			
		});
	});

</script>
