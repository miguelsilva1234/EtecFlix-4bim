<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="../css/painel.css">
</head>
<body>

    <?php
    session_start();

    if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'admin@gmail.com') {
        header("Location: ../login.php");
        exit;
    }
    ?>

    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h1>Painel do administrador</h1>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <a href="form_cadastrar.php" type="button" class="btn btn-danger">Cadastrar</a>
            <a href="listar.php" type="button" class="btn btn-warning">Listar</a>
            <a href="../principal.php" type="button" class="btn btn-warning">principal</a>
        </div>
    </div>

    <?php include '../includes/rodape.php'; ?>
</body>
</html>