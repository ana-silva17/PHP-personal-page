<?php include "config.php"; ?>
<!DOCTYPE html>
<html>

<head>
	<?php include 'head.php'; ?>
	<style>
		<?php include "styleDisciplinas.css"; ?>
	</style>
</head>

<body>
	<header>
		<?php include 'header.php'; ?>
	</header>

	<div class="title">
		<h1>Detalhes trabalhos</h1>
		<button onclick="window.location='criarTrabalhos.php'">Adicionar Trabalho</button>
	</div>

	<?php
	$sql = "SELECT * FROM works";

	$result = mysqli_query($conn, $sql);

	if ($result) {
		$numberOfLines = mysqli_num_rows($result);

		if ($numberOfLines > 0) {
			echo "<div>";
			echo "<table>";
			echo "<tr>";
			echo "<th>ID</th>";
			echo "<th>Código UFCD</th>";
			echo "<th>Nome Trabalho</th>";
			echo "<th>Ficheiro Trabalho</th>";
			echo "<th>Editar</th>";
			echo "<th>Eliminar</th>";
			echo "</tr>";

			while ($line = mysqli_fetch_array($result)) {
				$filework = $line["file_work"];
				echo "<tr>";
				echo "<td>" . $line['id'] . "</td>";
				echo "<td>" . $line['ufcd_code_subjects'] . "</td>";
				echo "<td>" . $line['work_name'] . "</td>";
				echo "<td><a href='/projetoPHP/works/$filework'>" . $line['file_work'] . "</a></td>";
				echo "<td><a href='editarTrabalhos.php?id=" . $line['id'] . "'>Editar Trabalho</a></td>";
				echo "<td><a href='eliminarTrabalhos.php?id=" . $line['id'] . "'>Eliminar Trabalho</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "</div>";
		} else {
			echo "<div>";
			echo "Não existem dados a apresentar";
			echo "</div>";
		}
	} else {
		echo "ERRO! Não consegui executar a consulta SQL! " . mysqli_error($conn);
	}
	?>

	<footer>
		<?php include 'footer.php'; ?>
	</footer>
</body>

</html>