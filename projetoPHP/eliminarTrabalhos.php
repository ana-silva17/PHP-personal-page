<?php include "config.php" ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { //verifica se a submissão foi através do método POST
    $sql = "DELETE FROM works WHERE id=?";

    if ($stmt = mysqli_prepare($conn, $sql)) { //se consegui configurar corretamente a minha consulta pré-feita

        mysqli_stmt_bind_param($stmt, "i", $_POST["id"]);

        if (mysqli_stmt_execute($stmt)) { //se executei o INSERT
            header("location: trabalhos.php"); //reencaminha para uma dada página
        } else {
            echo "AVISO. Não pode apagar uma disciplina com trabalhos associados.";
        }
    }
    mysqli_stmt_close($stmt); //obriga a terminar o DELETE
}
mysqli_close($conn); //estamos a fechar a ligação à base de dados

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <?php include 'head.php'; ?>
    <style>
        <?php include 'styleCurso.css'; ?>
    </style>
    <meta charset="UTF-8">
    <title>Eliminar Trabalho</title>
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>
    <meta charset="UTF-8">
    <h2>Eliminar Trabalho</h2>
    <div id="block">
    
        <p>Está prestes a eliminar um trabalho</p>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
            <p>Tem a certeza qu quer eliminar a trabalho?</p>

            <input class="submit" type="submit" value="Sim">
            <a href="trabalhos.php">Não</a>
        </form>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>