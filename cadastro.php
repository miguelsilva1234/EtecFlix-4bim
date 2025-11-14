<?php
// cadastro.php
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>EtecFlix - Cadastro</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<?php session_start(); ?>

    <div class="container">
        <div class="login-card">
            <h1>Cadastre-se</h1>

            <!-- Mensagem de erro ou sucesso -->
            <?php
            if (isset($_SESSION['erro'])) {
                echo "<p style='color: red; text-align:center; margin-bottom:10px;'>".$_SESSION['erro']."</p>";
                unset($_SESSION['erro']);
            }
            if (isset($_SESSION['sucesso'])) {
                echo "<p style='color: green; text-align:center; margin-bottom:10px;'>".$_SESSION['sucesso']."</p>";
                unset($_SESSION['sucesso']);
            }
            ?>

            <!-- Formulário de cadastro -->
            <form action="processa_cadastro.php" method="POST">
                <input type="text" name="nome" placeholder="Nome completo" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <input type="password" name="confirmar_senha" placeholder="Confirmar senha" required>
                <button type="submit">Cadastrar</button>
            </form>

            <a class='login' href="login.php">Já tem conta? Faça login.</a>

        </div>
    </div>

    <?php include __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>