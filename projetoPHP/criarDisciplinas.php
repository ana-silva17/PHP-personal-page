<?php include "config.php"; ?>
<?php include 'funcForm.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    $_POST["ufcd_code"] = sanitizeFields("ufcd_code");
    $_POST["ufcd_description"] = sanitizeFields("ufcd_description");
    $_POST["hours"] = sanitizeFields("hours");

    $sql = "INSERT INTO subjects (ufcd_code, ufcd_description, hours) VALUES (?, ?, ?)"; 

    if ($stmt = mysqli_prepare($conn, $sql)) { 
        mysqli_stmt_bind_param($stmt, "ssi", $_POST["ufcd_code"], $_POST["ufcd_description"], $_POST["hours"]); 


        if (mysqli_stmt_execute($stmt)) { 
            header("location: disciplinas.php"); 
        } else {
            echo "AVISO. Não foi possível adicionar disciplina. Esse código UFCD já existe.";
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
        <?php include "styleContatos.css"  ?>
    </style>
    <meta charset="UTF-8">
    <title>Adicionar Convidado</title>
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>
    <div id="container">
        <div class="form_title">
            <h1>Adicionar Disciplina</h1>
        </div>
        <p>Prencha o formulário para adicionar uma disciplina</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form_settings">
                <div class="content">
                    <label>Código UFCD: </label>
                    <input type="text" name="ufcd_code" required>
                </div>
                <div class="content">
                    <label>Descrição UFCD: </label>
                    <input type="text" name="ufcd_description" required>
                </div>
                <div class="content">
                    <label>Horas: </label>
                    <input type="text" name="hours" required>
                </div>
            </div>
            <div class="buttonSubmitDiv">
                <input class="submit" type="submit" value="Submeter">
                <a href="disciplinas.php">Cancelar</a>
            </div>
        </form>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>