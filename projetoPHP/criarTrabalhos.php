<?php include "config.php"; ?>
<?php include 'funcForm.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_POST["ufcd_code_subjects"] = sanitizeFields("ufcd_code_subjects");
    $_POST["work_name"] = sanitizeFields("work_name");
    $_POST["file_work"] = sanitizeFields("file_work");

    $sql = "INSERT INTO works (ufcd_code_subjects, work_name, file_work) VALUES (?, ?, ?)"; 

    if ($stmt = mysqli_prepare($conn, $sql)) { 
        mysqli_stmt_bind_param($stmt, "sss", $_POST["ufcd_code_subjects"], $_POST["work_name"], $_POST["file_work"]); 

        if (mysqli_stmt_execute($stmt)) {
            header("location: trabalhos.php"); 
        } else {
            echo "AVISO.Não pode adicionar um trabalho num Código UFCD inexistente. .";
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
    <title>Adicionar trabalho</title>
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>
    <div id="container">
        <div class="form_title">
            <h1>Adicionar Trabalho</h1>
        </div>
        <p>Prencha o formulário para adicionar um trabalho</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form_settings">
                <div class="content">
                    <label>Código UFCD: </label>
                    <input type="text" name="ufcd_code_subjects" required>
                </div>
               
                <div class="content">
                    <label>Nome Trabalho: </label>
                    <input type="text" name="work_name" required>
                </div>
                <div class="content">
                    <label>Ficheiro Trabalho: </label>
                    <input type="text" name="file_work" required>
                </div>
            </div>
            <div class="buttonSubmitDiv">
                <input class="submit" type="submit" value="Submeter">
                <a href="trabalhos.php">Cancelar</a>

            </div>
        </form>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>