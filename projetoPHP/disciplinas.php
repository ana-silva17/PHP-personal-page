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
	<h1>Detalhes disciplinas</h1>
	<button onclick="window.location='criarDisciplinas.php'">Adicionar Disciplina</button>
	<!--<a href="criarDisciplinas.php">Adicionar Disciplina</a> -->
	</div>
	<?php
	$sql = "SELECT * FROM subjects"; 

	$result = mysqli_query($conn, $sql); 

	if ($result) { 
		$numberOfLines = mysqli_num_rows($result);

		if ($numberOfLines > 0) {
			echo "<div>";
			echo "<table>";
			echo "<tr>";
			echo "<th>ID</th>";
			echo "<th>Código UFCD</th>";
			echo "<th>Descrição UFCD</th>";
			echo "<th>Horas</th>";
			echo "<th>Editar</th>";
			echo "<th>Eliminar</th>";
			echo "</tr>";

			while ($line = mysqli_fetch_array($result)) { 
				echo "<tr>";
				echo "<td>" . $line['id'] . "</td>";
				echo "<td><a href='ligacaoDiscTrab.php?id=" . $line['id'] . "'>" . $line['ufcd_code'] . "</a></td>";
				echo "<td>" . $line['ufcd_description'] . "</td>";
				echo "<td>" . $line['hours'] . "</td>";
				echo "<td><a href='editarDisciplinas.php?id=" . $line['id'] . "'>Editar disciplina</a></td>";
				echo "<td><a href='eliminarDisciplinas.php?id=" . $line['id'] . "'>Eliminar disciplina</a></td>";
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