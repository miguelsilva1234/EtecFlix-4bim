<?php
session_start();
include_once 'conexao.php';

if (!isset($_SESSION['idUsuario'])) {
    header('Location: login.php');
    exit;
}

$idFilme = $_GET['id'] ?? null;
if (!$idFilme || !is_numeric($idFilme)) {
    header('Location: principal.php');
    exit;
}

// Buscar filme
$sqlFilme = "SELECT * FROM filmes WHERE idFilmes = ?";
$stmtFilme = $pdo->prepare($sqlFilme);
$stmtFilme->execute([$idFilme]);
$filme = $stmtFilme->fetch(PDO::FETCH_ASSOC);

if (!$filme) {
    echo "Filme não encontrado.";
    exit;
}

// Buscar reviews do filme (opcional: para exibir abaixo, se quiser)
$sqlReviews = "SELECT r.nota, r.descricao, u.nome FROM review r JOIN usuarios u ON r.idUsuario = u.idUsuario WHERE r.idFilmes = ?";
$stmtReviews = $pdo->prepare($sqlReviews);
$stmtReviews->execute([$idFilme]);
$reviews = $stmtReviews->fetchAll(PDO::FETCH_ASSOC);

// Processar nova review (se enviada)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nota = $_POST['nota'] ?? null;  // Nota das estrelas (1-5, mas converter para 1-10 se necessário)
    $descricao = $_POST['descricao'];
    $idUsuario = $_SESSION['idUsuario'];

    if ($nota && is_numeric($nota) && $nota >= 1 && $nota <= 5) {
        // Converter estrelas (1-5) para nota (1-10), ex.: 1 estrela = 2/10, 5 estrelas = 10/10
        $notaConvertida = $nota * 2;

        $sqlInsert = "INSERT INTO review (idUsuario, idFilmes, nota, descricao) VALUES (?, ?, ?, ?)";
        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->execute([$idUsuario, $idFilme, $notaConvertida, $descricao]);

        header("Location: filme.php?id=$idFilme");
        exit;
    } else {
        $erro = "Selecione uma nota válida.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($filme['nome']); ?> - EtecFlix</title>
    <link rel="stylesheet" href="css/filmes1.css">
</head>
<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="avaliacao-container">
        <div class="filme-card">
            <img src="<?php echo htmlspecialchars($filme['imagem'] ?? 'img/default.jpg'); ?>" alt="Capa do Filme" class="filme-capa">
            <div class="filme-info">
                <h2><?php echo htmlspecialchars($filme['nome']); ?></h2>
                <p class="sinopse">
                    <?php echo htmlspecialchars($filme['descricao']); ?>
                    <?php if ($filme['data_lancamento']): ?>
                        <br><strong>Data de Lançamento:</strong> <?php echo htmlspecialchars($filme['data_lancamento']); ?>
                    <?php endif; ?>
                    <?php if ($filme['tempo_filme']): ?>
                        <br><strong>Tempo:</strong> <?php echo htmlspecialchars($filme['tempo_filme']); ?>
                    <?php endif; ?>
                </p>

                <form method="POST">
                    <div class="avaliacao-estrelas">
                        <span class="estrela" data-value="1">★</span>
                        <span class="estrela" data-value="2">★</span>
                        <span class="estrela" data-value="3">★</span>
                        <span class="estrela" data-value="4">★</span>
                        <span class="estrela" data-value="5">★</span>
                        <input type="hidden" name="nota" id="nota-hidden" value="">
                    </div>

                    <textarea name="descricao" placeholder="Deixe sua opinião sobre o filme..." required></textarea>
                    <?php if (isset($erro)): ?>
                        <p style="color: red;"><?php echo $erro; ?></p>
                    <?php endif; ?>
                    <button type="submit" class="btn-enviar">Enviar Avaliação</button>
                </form>
            </div>
        </div>

        <!-- Seção opcional para exibir reviews existentes (não no exemplo, mas útil) -->
        <?php if (!empty($reviews)): ?>
            <div class="reviews-section">
                <h3>Avaliações Anteriores</h3>
                <?php foreach ($reviews as $review): ?>
                    <div class="review">
                        <strong><?php echo htmlspecialchars($review['nome']); ?>:</strong> Nota <?php echo htmlspecialchars($review['nota']); ?>/10
                        <p><?php echo htmlspecialchars($review['descricao']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <a href="principal.php" class="btn-voltar">Voltar</a>
    </main>

    <?php include __DIR__ . '/includes/rodape.php'; ?>

    <script>
        // Sistema simples de estrelas
        const estrelas = document.querySelectorAll('.estrela');
        const notaHidden = document.getElementById('nota-hidden');
        estrelas.forEach(estrela => {
            estrela.addEventListener('click', () => {
                const value = estrela.getAttribute('data-value');
                notaHidden.value = value;  // Atualiza o input hidden com a nota
                estrelas.forEach(e => e.classList.remove('ativo'));
                estrela.classList.add('ativo');
                let prev = estrela.previousElementSibling;
                while (prev) {
                    prev.classList.add('ativo');
                    prev = prev.previousElementSibling;
                }
            });
        });
    </script>
</body>
</html>
