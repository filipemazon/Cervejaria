<?php

require'autoloader.php';

use BD\Cervejaria\Model\Cervejaria;

$cervejaria = new Cervejaria();

if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case "insert":
		$cervejaria->setCnpj($_POST['cnpj']);
		$cervejaria->setNome($_POST['nome']);
		$cervejaria->setEndereco($_POST['endereco']);
		$cervejaria->setCidade($_POST['cidade']);
		$cervejaria->setEstado($_POST['estado']);
		$cervejaria->setEmail($_POST['email']);
		$cervejaria->setTelefone($_POST['telefone']);
		$cervejaria->setSite($_POST['site']);
		//$cervejaria->setLogo($_POST['logo']);

	/*	if($_FILES['logo']['error'] != 4){
		$file = md5(uniqid(rand(), true));
		$ext = explode("/", $_FILES['logo']['type']);
		$file .= "." . $ext[1];

		if(!move_uploaded_file($_FILES['logo']['tmp_name'], '/images' . $file)){
			die('Erro ao salvar imagem.');
		}
	}else{
		$cervejaria->setId($_POST['id']);
		$row = $cervejaria->view();
			$file = $row->logo;
		}		
		$cervejaria->setLogo($file);*/

		if($cervejaria->insert() == 1){
			$result = "Inserido com sucesso!";
		}else{
			$error = "Erro ao inserir, tente novamente!";
		}
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

			<h2>Formulário de Cadastro - Cervejaria</h2>
			<form action="cadastrarCervejaria.php" method="post" class="cervejaria" id='cervejaria' enctype="multipart/form-data">
				<div class="form-group">	
					<label>CNPJ:</label>
					<input type="text" name="cnpj" id="cnpj" class="form-text" placeholder="XX.XXX.XXX/0001-ZZ" required>
					<label>Nome:</label>
					<input type="text" name="nome" id="nome" class="form-text" placeholder="Nome da Cervejaria" required>
					<label>Endereco:</label>
					<input type="text" name="endereco" id="endereco" class="form-text" placeholder="Rua xxx, numero X, Bairro Y" required>
					<label>Cidade:</label>
					<input type="text" name="cidade" id="cidade" class="form-text" placeholder="Cidade" required>
					<label>Estado:</label>
					<input type="text" name="estado" id="estado" class="form-text" placeholder="XX" required>
					<label>E-mail:</label>
					<input type="text" name="email" id="email" class="form-text" placeholder="mail@mail.com" required>
					<label>Telefone:</label>
					<input type="text" name="telefone" id="telefone" class="form-text" placeholder="(DDD)XXXX-XXXX" required>
					<label>Site:</label>
					<input type="text" name="site" id="site" class="form-text" placeholder="www.site.com.br">
					<!--<label>Logotipo:</label>
					<input type="file" name="logo" id="logo">-->

					<input type="hidden" name="action" value="insert">
					<button type="submit" value="Cadastrar" class="btn btn-success btn-sm">Cadastrar</button>
				</div>
			</form>	
		</div>
	</div>
</body>
</html>
