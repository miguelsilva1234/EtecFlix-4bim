<?php
session_start();
include_once 'conexao.php';

// Verificar se o usuário está logado (opcional)
if (!isset($_SESSION['idUsuario'])) {
    header('Location: login.php');
    exit;
}

// Buscar filmes do banco
$sql = "SELECT idFilmes, nome, descricao, imagem FROM filmes ORDER BY idFilmes DESC";  // Ordena por mais recente
$stmt = $pdo->prepare($sql);
$stmt->execute();
$filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EtecFlix - Principal</title>
    <link rel="stylesheet" href="css/principal.css">
</head>
<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="main-content">
        <h2>Filmes em Destaque</h2>
        <hr>
        <div class="movie-grid">
            <?php if (empty($filmes)): ?>
                <div class="empty-state">
                    <div class="empty-state-content">
                        <h3>Nenhum filme cadastrado ainda</h3>
                        <p>Compartilhe sua primeira resenha!</p>
                        <a href="adm/form_cadastrar.php" class="btn-add-film">+ Adicionar Filme</a>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($filmes as $filme): ?>
                    <div class="movie-card">
                        <div class="movie-image">
                            <img src="<?php echo htmlspecialchars($filme['imagem'] ?? 'img/default.jpg'); ?>" alt="<?php echo htmlspecialchars($filme['nome']); ?>">
                        </div>
                        <h3><?php echo htmlspecialchars($filme['nome']); ?></h3>
                        <p><?php echo htmlspecialchars(substr($filme['descricao'], 0, 100)) . '...'; ?></p>  <!-- Resumo da descrição -->
                        <a href="filme.php?id=<?php echo $filme['idFilmes']; ?>" class="active">Avaliar</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <?php include __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>