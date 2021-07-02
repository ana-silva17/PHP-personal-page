<?php include "config.php"; ?>
<?php
$ufcdCode = $ufcdDescription = $hours = "";

if (isset($_GET["id"])) {

    $sql = "SELECT ufcd_code, ufcd_description, hours FROM subjects WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {

                $line = mysqli_fetch_array($result);
                $ufcdCode = $line["ufcd_code"];
                $ufcdDescription = $line["ufcd_description"];
                $hours = $line["hours"];
            } else {
                echo "A tua pesquisa nÃo correu como esperado.";
            }
        }
    } else {
        echo "Alguma coisa correu mal, tentar mais tarde";
    }
} else {
    if (isset($_POST["id"])) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $sql = "UPDATE subjects SET ufcd_code=?, ufcd_description=?, hours=? WHERE id=?";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssi", $_POST["ufcd_code"], $_POST["ufcd_description"], $_POST["hours"], $_POST["id"]);

                if (mysqli_stmt_execute($stmt)) {
                    header("location: disciplinas.php");
                } else {
                    echo "AVISO. Não pode alterar o Código UFCD possivelmente por ter um trabalho associado.";
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <?php include 'head.php'; ?>
    <style>
        <?php include "styleContatos.css"  ?>
    </style>
    <meta charset="UTF-8">
    <title>Editar Disciplina</title>
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>
    <div id="container">
        <div class="form_title">
            <h1>Editar a disciplina: <?php echo $ufcdCode  . "-" . $ufcdDescription ?></h1>
        </div>
        <p>Por favor, edite os dados da disciplina</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form_settings">
                <div class="content">
                    <label>Código UFCD: </label>
                    <input type="text" value="<?php echo $ufcdCode; ?>" name="ufcd_code">
                </div>
                <div class="content">
                    <label>Descrição UFCD: </label>
                    <input type="text" value="<?php echo $ufcdDescription; ?>" name="ufcd_description">
                </div>
                <div class="content">
                    <label>Horas: </label>
                    <input type="text" value="<?php echo $hours; ?>" name="hours">
                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">

            <div class="buttonSubmitDiv">
                <input class="submit" type="submit" value="Submeter">
                <a href="disciplinas.php">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>