<?php include "config.php"; ?>

<?php
$result;
$line;

$sql = "SELECT works.* FROM works INNER JOIN subjects ON works.ufcd_code_subjects = subjects.ufcd_code WHERE subjects.id = ?";

if ($stmt = mysqli_prepare($conn, $sql)) {

	mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);

	if (mysqli_stmt_execute($stmt)) {
		$result = mysqli_stmt_get_result($stmt);
	}
} else {
	echo "Alguma coisa correu mal, tentar mais tarde";
}

?>

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
		<h1>Trabalho</h1>
	</div>

	<?php
	if ($result) { //se foi possível executar a consulta SQL

		if (mysqli_num_rows($result) > 0) { //se tenho resultados para apresentar
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

			while ($line = mysqli_fetch_array($result)) { //enquanto eu tiver dados
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
		mysqli_stmt_close($stmt); 
		mysqli_close($conn); 
	}
	?>

	<footer>
		<?php include 'footer.php'; ?>
	</footer>
</body>

</html>