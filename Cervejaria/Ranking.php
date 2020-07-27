<?php
require'autoloader.php';
include('header.php');

use BD\Cervejaria\Model\MestreCervejeiro;

$mestre = new MestreCervejeiro();

?>

<div id="band" class="container text-center">
	<h2>RANKING </h2>
	<table class="table table-striped">
		<tr>
			<th>Mestre Cervejeiro</th>
			<th>Cervejas Feitas</th>
		</tr>
		<?php
			$stmt = $mestre->rankingMestre();

			while($row = $stmt->fetch(PDO::FETCH_OBJ)){
			?>
			<tr>
				<td><?php echo $row->nome ;?></td>
				<td><?php echo $row->CONT?></td>

			</tr>
		<?php
			}
		?>
	</table>
</div>
</body>
</html>


