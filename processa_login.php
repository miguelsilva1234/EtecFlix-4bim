<?php 
session_start();
include_once 'conexao.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Buscar usuário apenas pelo email
$sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() == 1) {

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar senha usando password_verify()
    if (password_verify($senha, $resultado['senha'])) {

        // Criar sessão
        $_SESSION['idUsuario'] = $resultado['idUsuario'];
        $_SESSION['nome'] = $resultado['nome'];
        $_SESSION['email'] = $resultado['email'];

        // Se for admin → painel
        if ($resultado['email'] === 'admin@gmail.com') {
            header('Location: adm/painel.php');
            exit;
        } 
        // Usuário normal → principal
        else {
            header('Location: principal.php');
            exit;
        }

    } else {
        // Senha incorreta
        $_SESSION['erro'] = "E-mail ou senha incorretos!";
        header('Location: login.php');
        exit;
    }

} else {
    // Email não encontrado
    $_SESSION['erro'] = "E-mail ou senha incorretos!";
    header('Location: login.php');
    exit;
}
?>
