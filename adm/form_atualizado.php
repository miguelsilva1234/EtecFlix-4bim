<?php
require '../conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $data_lancamento = $_POST['data_lancamento'];
    $tempo_filme = $_POST['tempo_filme'];

    $sql = "UPDATE filmes 
            SET nome = :nome, descricao = :descricao, data_lancamento = :data_lancamento, tempo_filme = :tempo_filme 
            WHERE idFilmes = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':data_lancamento', $data_lancamento);
    $stmt->bindParam(':tempo_filme', $tempo_filme);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: listar.php?updated=1");
        exit;
    } else {
        echo "Erro ao atualizar filme.";
    }
}

$sql = "SELECT * FROM filmes WHERE idFilmes = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$filme = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$filme) {
    echo "Filme não encontrado.";
    exit;
}
?>

<body>
    <link rel="stylesheet" href="../css/style_atualizado.css">
    <div class="container">
        <h2>ATUALIZAÇÃO DE FILMES</h2>

        <form method="POST">
            <div class="mb-3">
                Nome:<input value="<?php echo htmlspecialchars($filme['nome']); ?>" type="text" name="nome" class="form-control" required>
            </div>

            <div class="mb-3">
                Descrição:<input value="<?php echo htmlspecialchars($filme['descricao']); ?>" type="text" name="descricao" class="form-control" required>
            </div>

            <div class="mb-3">
                Ano de Lançamento:<input value="<?php echo htmlspecialchars($filme['data_lancamento']); ?>" type="text" name="data_lancamento" class="form-control" required>
            </div>

            <div class="mb-3">
                Duração:<input value="<?php echo htmlspecialchars($filme['tempo_filme']); ?>" type="text" name="tempo_filme" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="listar.php" class="btn btn-warning">Voltar</a>
        </form>
    </div>

    <?php include '../includes/rodape.php'; ?>
</body>
</html>
