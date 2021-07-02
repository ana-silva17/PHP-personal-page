<?php include "config.php" ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM subjects WHERE id=?";

    if ($stmt = mysqli_prepare($conn, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $_POST["id"]);

        if (mysqli_stmt_execute($stmt)) {
            header("location: disciplinas.php");
        } else {
            echo "AVISO. Não pode apagar uma disciplina com trabalhos associados.";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <?php include 'head.php'; ?>
    <style>
        <?php include 'styleCurso.css'; ?>
    </style>
    <meta charset="UTF-8">
    <title>Eliminar Disciplina</title>
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>

    <h2>Eliminar Disciplina</h2>
    <div id="block">
        <p>Está prestes a eliminar uma disciplina</p>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">

            <p>Tem a certeza que quer <u>eliminar</u> a disciplina?</p>

            <input class="submit" type="submit" value="Sim">
            <a href="disciplinas.php">Não</a>
        </form>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>