<?php include "config.php"; ?>
<?php
$ufcdCodeSubjects = $workName = $filework = "";

if (isset($_GET["id"])) {
    $sql = "SELECT ufcd_code_subjects, work_name, file_work FROM works WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $line = mysqli_fetch_array($result);
                $ufcdCodeSubjects = $line["ufcd_code_subjects"];
                $workName = $line["work_name"];
                $filework = $line["file_work"];
            } else {
                echo "A tua pesquisa não correu como esperado.";
            }
        }
    } else {
        echo "Alguma coisa correu mal, tentar mais tarde";
    }
} else {
    if (isset($_POST["id"])) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $sql = "UPDATE works SET ufcd_code_subjects=?, work_name=?, file_work=?  WHERE id=?"; //consulta prÃ©-feita

            if ($stmt = mysqli_prepare($conn, $sql)) { //se consegui configurar corretamente a minha consulta prÃ©-feita
                mysqli_stmt_bind_param($stmt, "sssi", $_POST["ufcd_code_subjects"], $_POST["work_name"], $_POST["file_work"], $_POST["id"]); //associa os campos do formulÃ¡rio com a minha consulta prÃ©-feita em sql ($sql)

                if (mysqli_stmt_execute($stmt)) { //se executei o UPDATE
                    header("location: trabalhos.php"); //reencaminha para uma dada pÃ¡gina
                } else {
                    echo "Aviso. Esse Código UFCD não existe.";
                }
            }
            mysqli_stmt_close($stmt); //obriga a terminar o UPDATE
            mysqli_close($conn); //estamos a fechar a ligaÃ§Ã£o Ã  base de dados
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
    <title>Editar Trabalho</title>
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>
    <div id="container">
        <div class="form_title">
            <h1>Editar o trabalho: <?php echo $ufcdCodeSubjects  . "-" . $workName ?></h1>
        </div>
        <p>Por favor, edite os dados do trabalho</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form_settings">

                <div class="content">
                    <label>Código UFCD: </label>
                    <input type="number" value="<?php echo $ufcdCodeSubjects; ?>" name="ufcd_code_subjects">
                </div>
                <div class="content">
                    <label>Nome Trabalho: </label>
                    <input type="text" value="<?php echo $workName; ?>" name="work_name">
                </div>
                <div class="content">
                    <label>Ficheiro Trabalho: </label>
                    <input type="text" value="<?php echo $filework; ?>" name="file_work">
                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">

            <div class="buttonSubmitDiv">
                <input class="submit" type="submit" value="Submeter">
                <a href="trabalhos.php">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>