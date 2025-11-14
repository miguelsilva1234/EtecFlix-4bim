<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>EtecFlix</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<?php session_start(); ?>

    <div class="container">
        <div class="login-card">
            <h1>Entrar</h1>

            <!-- Mensagem de erro -->
            <?php
            if (isset($_SESSION['erro'])) {
                echo "<p style='color: red; text-align:center; margin-bottom:10px;'>".$_SESSION['erro']."</p>";
                unset($_SESSION['erro']); // remove depois de mostrar
            }
            ?>

            <!-- Formulário de login -->
            <form action="processa_login.php" method="POST">
                <input type="text" name="email" placeholder="Email ou número de telefone" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <button type="submit">Entrar</button>
            </form>

            <a class='cadastro' href="cadastro.php">Novo por aqui? Cadastre-se agora.</a>

        </div>
    </div>

    <?php include __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>
