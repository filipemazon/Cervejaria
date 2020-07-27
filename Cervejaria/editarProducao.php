<?php
require'autoloader.php';

use BD\Cervejaria\Model\Producao;
use BD\Cervejaria\Model\Cervejaria;
use BD\Cervejaria\Model\Fabricas;
use BD\Cervejaria\Model\Cerveja;


$producao = new Producao();
$cervejaria = new Cervejaria();
$fabrica = new Fabricas();
$cerveja = new Cerveja();

if(isset($_POST['edit'])){
	$producao->setData($_POST['data']);
	$producao->setQuantidade($_POST['quantidade']);
	if($producao->edit() == 1){
		$result = "Editado com sucesso!";
	}else{
		$error = "Erro ao editar, tente novamente!";
	}
}

if(isset($_POST['delete'])){
	$producao->setData($_POST['data']);
	if($producao->delete() == 1){
		$result = "Deletado com sucesso!";
	}else{
		$error = "Erro ao deletar, tente novamente!";
	}
}

if (isset($_GET['data'])) {
	$producao->setdata($_GET['data']);
	$row = $producao->view();
	if (isset($result)) {
		echo "O producao ID(" . $result . ") foi editado<br>";
	}
}

/*if(isset($_POST['select'])){
    $producao->setCervejaria_cnpj($_POST['cnpj']);
    $producao->setFabricas($_POST['idFabricas']);
    $producao->setCerveja_idCerveja($_POST['cerveja_idCerveja']);
}*/



include('header.php');
?>

<div class="container">
	<div class="row">
		<h2>Produção</h2>
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
					<th>Data</th>
					<th>Quantidade</th>
					<th>Cervejaria</th>
					<th>Fábrica</th>
					<th>Cerveja</th>
					<th class="actions">Ações</th>
				</tr>
			</thead>
			<?php
			$id = 0;
			$stmt = $producao->index();
			while($row = $stmt->fetch(PDO::FETCH_OBJ)){
				$id += 1;
				?>
				<tbody>
					<tr class="<?php echo $id ?>">
						<form method="post" action="editarproducao.php">
							<td class="td_data"><?php echo $row->data ;?></td>
							<td class="td_quantidade"><?php echo $row->quantidade ;?></td>


							<?php
							$cervejaria->setCnpj($row->Cervejaria_cnpj);
							$stmtCervejaria = $cervejaria->view();
							?>
							<td class="cervejaria_view"><?php echo $stmtCervejaria->nome ;?></td>

							<?php
							$fabrica->setIdFabricas($row->Fabricas_idFabricas);
							$stmtFabrica = $fabrica->view();
							?>
							<td class="fabricas_view"><?php echo $stmtFabrica->cidade ;?></td>


							<?php
							$cerveja->setIdCerveja($row->Cerveja_idCerveja);
							$stmtCerveja = $cerveja->view();
							?>
							<td class="cerveja_view"><?php echo $stmtCerveja->nome ;?></td>

								<td class="actions">
									<a id="abuttontomodal" class="btn btn-warning btn-xs href="#" data-toggle="modal" data-target="#edit-modal" >Editar</a>
									<input type="hidden" name="data" value="<?php echo $row->data; ?>">
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
							<h4 class="modal-title" id="modalLabel">Editar Producao</h4>
						</div>
						<div class="modal-content">
							<?php
							$stmt = $producao->view();
							?>
							<form action="editarproducao.php" method="post" class="producao" id='producao'>
								<div class="form-group"  style="text-align: center;">	
									<label for="data">Data:</label>
									<input type="text" name="data" id="data" class="form-text" value="" required><br>
									<label for="quantidade">Quantidade:</label>
									<input type="text" name="quantidade" id="quantidade" class="form-text" value="" required><br>
									<label for="cervejaria">Cervejaria:</label>
									<select id="select" name="Cervejaria_cnpj" action="editarProducao.php"> 
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
									</select>
									<br><label for="fabrica">Fábrica:</label>
									<select id="select" name="Fabricas_idFabricas" action="editarProducao.php"> 
                    				<option value="select"> Selecione </option>
					                        <?php 
					                        $stmt = $fabrica->index(); 
					                        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
					                        ?>
					                        <option id= "<?php echo $row->idFabricas; ?>" value="<?php echo $row->idFabricas; ?>"> <?php echo $row->cidade; ?>   
					                         </option> 
					                    		<?php
					                    		}
					                    		?> 
					                    	</select>
									<br><label for="cerveja">Cerveja:</label>
									<select id="select" name="Cerveja_idCerveja" action="editarProducao.php"> 
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

									<!--<br><input type="text" id="data" name="data" value="">-->
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
				var data =  $row.find('.td_data').text();
				var quantidade =  $row.find('.td_quantidade').text();
				var cervejaria =  $row.find('.cerveja_view').text();
				var fabrica =  $row.find('.fabricas_view').text();
				var cerveja =  $row.find('.cerveja_view').text();
				$('#data').val(data);
				$('#quantidade').val(quantidade);
				$('#cervejaria').val(cervejaria);
				$('#fabrica').val(fabrica);
				$('#cerveja').val(cerveja);
			});
		});

	</script>