<?php
require'autoloader.php';

use BD\Cervejaria\Model\Cervejaria;

$cervejaria = new Cervejaria();

if(isset($_POST['edit'])){
	$cervejaria->setCnpj($_POST['cnpj']);
	$cervejaria->setNome($_POST['nome']);
	$cervejaria->setEndereco($_POST['endereco']);
	$cervejaria->setCidade($_POST['cidade']);
	$cervejaria->setEstado($_POST['estado']);
	$cervejaria->setEmail($_POST['email']);
	$cervejaria->setTelefone($_POST['telefone']);
	$cervejaria->setSite($_POST['site']);

	/*$row = $cervejaria->view();

	if($_FILES['logo']['error'] != 4){
		$file = md5(uniqid(rand(), true));
		$ext = explode("/", $_FILES['logo']['type']);
		$file .= "." . $ext[1];

		if(!move_uploaded_file($_FILES['logo']['tmp_name'], '/images' . $file)){
			die('Erro ao salvar o arquivo.');
		}else{
			$dir = '/images';
			$file2 = $row->foto;
			chmod($dir ."/". $file2, 0755);
			unlink($dir.$file2);
		}
	}else{
		$file = $row->logo;
	}		
	$cervejaria->setLogo($file);*/

	if($cervejaria->edit() == 1){
		$result = "Editado com sucesso!";
	}else{
		$error = "Erro ao editar, tente novamente!";
	}
}

if(isset($_POST['delete'])){
	$cervejaria->setCnpj($_POST['cnpj']);
	if($cervejaria->delete() == 1){
		$result = "Deletado com sucesso!";
	}else{
		$error = "Erro ao deletar, tente novamente!";
	}
}

if (isset($_GET['cnpj'])) {
	$cervejaria->setCnpj($_GET['cnpj']);
	$row = $cervejaria->view();
	if (isset($result)) {
		echo "A cervejaria ID(" . $result . ") foi editada<br>";
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
			<h2>Cervejaria</h2>	
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
						<th>CNPJ</th>
						<th>Nome</th>
						<th>Endereço</th>
						<th>Cidade</th>
						<th>Estado</th>
						<th>E-mail</th>
						<th>Telefone</th>
						<th>Site</th>
						<!--<th>Logotipo</th>-->
						<th class="actions">Ações</th>
					</tr>
				</thead>
				
				<?php
				$id = 0;
				$stmt = $cervejaria->index();
				while($row = $stmt->fetch(PDO::FETCH_OBJ)){
					$id += 1;
					?>
					<tbody>
						<tr class="<?php echo $id ?>">
							<form method="post" action="editarCervejaria.php" enctype="multipart/form-data">
								<td class="td_cnpj"><?php echo $row->cnpj ;?></td>
								<td class="td_nome"><?php echo $row->nome ;?></td>
								<td class="td_endereco"><?php echo $row->endereco ;?></td>
								<td class="td_cidade"><?php echo $row->cidade ;?></td>
								<td class="td_estado"><?php echo $row->estado ;?></td>
								<td class="td_email"><?php echo $row->email ;?></td>
								<td class="td_telefone"><?php echo $row->telefone ;?></td>
								<td class="td_site"><?php echo $row->site ;?></td>
								<!--<td class="td_logo"><?php echo $row->logo ;?></td>-->
								<td class="actions">
									<a id="abuttontomodal" class="btn btn-warning btn-xs href="#" data-toggle="modal" data-target="#edit-modal" >Editar</a>

									<input type="hidden" name="cnpj" value="<?php echo $row->cnpj; ?>">
									<button type="submit" name="delete" class="btn btn-danger btn-sm">Excluir</button>
								</td>
							</form>
							<?php
						}
						?>
					</tr>
				</tbody>
			</table>

			<!-- Modal Editar-->
			<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header" style="padding: 10px 65px;">
							<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="modalLabel">Editar Cervejaria</h4>
						</div>
						<div class="modal-content">
							<?php
							$stmt = $cervejaria->view();
							?>
							<form action="editarCervejaria.php" method="post" class="cervejaria" id='cervejaria' enctype="multipart/form-data">
								<div class="form-group">	
									<label for="cnpj">CNPJ:</label>
									<input type="text" name="cnpj" id="cnpj" class="form-text" value="" required><br>
									<label for="nome">Nome:</label>
									<input type="text" name="nome" id="nome" class="form-text" value="" required><br>
									<label for="endereco">Endereco:</label>
									<input type="text" name="endereco" id="endereco" class="form-text" value="" required><br>
									<label for="cidade">Cidade:</label>
									<input type="text" name="cidade" id="cidade" class="form-text" value="" required><br>
									<label for="estado">Estado:</label>
									<input type="text" name="estado" id="estado" class="form-text" value="" required><br>
									<label for="email">E-mail:</label>
									<input type="text" name="email" id="email" class="form-text" value="" required><br>
									<label for="telefone">Telefone:</label>
									<input type="text" name="telefone" id="telefone" class="form-text" value="" required><br>
									<label for="site">Site:</label>
									<input type="text" name="site" id="site" class="form-text" value=">">
									<!--<br><label for="logo">Logotipo:</label>
									<input type="file" name="logo" id="logo" value="">-->

									<!--<br><input type="text" name="cnpj" id="cnpj" value="">-->
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
			var cnpj =  $row.find('.td_cnpj').text();
			var nome =  $row.find('.td_nome').text();
			var endereco =  $row.find('.td_endereco').text();
			var cidade =  $row.find('.td_cidade').text();
			var estado =  $row.find('.td_estado').text();
			var email =  $row.find('.td_email').text();
			var telefone =  $row.find('.td_telefone').text();
			var site =  $row.find('.td_site').text();
			//var logo =  $row.find('.td_logo').text();
			$('#cnpj').val(cnpj);
			$('#nome').val(nome);
			$('#endereco').val(endereco);
			$('#cidade').val(cidade);
			$('#estado').val(estado);
			$('#email').val(email);
			$('#telefone').val(telefone);
			$('#site').val(site);
			//$('#logo').val(logo);
			
		});
	});

</script>
