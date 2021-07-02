<?php include "config.php" ?>

<!DOCTYPE html>
<html>

<head>
	<?php include 'head.php'; ?>
	<style>
		<?php include "styleContatos.css"  ?>
	</style>
</head>

<body>
	<header>
		<?php include 'header.php'; ?>
	</header>
	<div id="container">
		<div class="form_title">
			<h1>Fale Comigo</h1>
		</div>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form_settings">
				<span class="error">* campos obrigatórios</span>
				<br><br>
				<div class="content">
					<label class="label_settings">Nome:*</label>
					<input type="text" name="nome" required>
				</div>

				<div class="content">
					<label class="label_settings">Email:*</label>
					<input type="email" name="email" required>
				</div>

				<div class="content">
					<label class="label_settings">Telefone: </label>
					<input type="number" name="telefone">
				</div>

				<div class="content">
					<label class="label_settings">Mensagem:* </label>
					<textarea class="contact_textarea" name="mensagem" required></textarea>
				</div>

				<?php include 'funcForm.php'; ?>
				<?php

				if ($_SERVER["REQUEST_METHOD"] == "POST") { //verifica se a submissão foi efetuada através do método POST

					$_POST["nome"] = sanitizeFields("nome");
					$_POST["email"] = sanitizeFields("email");
					$_POST["telefone"] = sanitizeFields("telefone");
					$_POST["mensagem"] = sanitizeFields("mensagem");

					$sql = "INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)"; //consulta pré-feita

					if ($stmt = mysqli_prepare($conn, $sql)) { //se consegui configurar corretamente a minha consulta pré-feita

						mysqli_stmt_bind_param($stmt, "ssis", $_POST["nome"], $_POST["email"], $_POST["telefone"], $_POST["mensagem"]); //associa os campos do formulário com a minha consulta pré-feita em sql ($sql)

						if (mysqli_stmt_execute($stmt)) { //se executei o INSERT

							header("location:contatos.php"); //reencaminha para uma dada página
						} else {
							echo "Alguma coisa não correu direito.";
						}
					}
					mysqli_stmt_close($stmt); //obriga a terminar o INSERT
				}
				mysqli_close($conn); //estamos a fechar a ligação à base de dados
				?>

				<div class="buttonSubmitDiv">
					<input class="submit" type="submit">
				</div>
			</div>
		</form>
	</div>

	<footer>
		<?php include 'footer.php'; ?>
	</footer>
</body>

</html>