<?php
require'autoloader.php';
include('header.php');

use BD\Cervejaria\Model\Eventos;

$lucro = new Eventos();
$stmt = $lucro->lucrosEventos();
?>


<div id="band" class="container text-center">

	<h2>Eventos e Lucros</h2>

	<table class="table table-striped">
		<tr>
			<th>Nome do Evento</th>
			<th>Data</th>
			<th>Público Total</th>
			<th>Valor Ingresso</th>
			<th>Custos Evento</th>
			<th>Patrocínio</th>
			<th>Vendas de Cerveja</th>
			<th>Lucro Total Evento</th>

		</tr>
		<?php while($row = $stmt->fetch(PDO::FETCH_OBJ)){
			?>
		<tr>
			<td><?php echo $row->nome?></td>
			<td><?php echo $row->data?></td>
			<td><?php echo $row->publico?></td>
			<td><?php echo "R$" + $row->ingresso?></td>
			<td><?php echo "R$" + $row->custo?></td>
			<td><?php echo "R$" + $row->dinheiro?></td>
			<td><?php echo "R$" + $row->soma?></td>
			<?php
				$lucroingresso = $row->publico*$row->ingresso;
				$somatotal = array_sum(array($lucroingresso, -$row->custo, -$row->dinheiro, $row->soma));
			?>
			<td><?php echo "R$" + $somatotal?></td>
		</tr>
		<?php
		}
		?>
	</table>


</div>
</body>
</html>