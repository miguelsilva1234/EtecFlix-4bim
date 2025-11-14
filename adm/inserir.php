<?php
require '../conexao.php'; // ajusta o caminho conforme sua estrutura

// Pega os dados do formulário
$nome = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$data_lancamento = $_POST['data_lancamento'] ?? '';
$tempo_filme = $_POST['tempo_filme'] ?? '';
$imagem = null;

// Verifica se o usuário enviou imagem
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $nomeArquivo = basename($_FILES['imagem']['name']);
    // Use um nome único com timestamp para evitar conflitos
    $nomeUnico = time() . '_' . $nomeArquivo;
    $caminhoDestino = "../uploads/" . $nomeUnico;

    // Cria a pasta de uploads caso não exista
    if (!is_dir("../uploads")) {
        mkdir("../uploads", 0755, true);
    }

    // Move o arquivo para a pasta
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
        // Salva o caminho relativo à raiz (sem ../)
        $imagem = "uploads/" . $nomeUnico;
    }
}

// Prepara e executa o INSERT
$sql = "INSERT INTO filmes (nome, descricao, data_lancamento, tempo_filme, imagem)
        VALUES (:nome, :descricao, :data_lancamento, :tempo_filme, :imagem)";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':descricao', $descricao);
$stmt->bindParam(':data_lancamento', $data_lancamento);
$stmt->bindParam(':tempo_filme', $tempo_filme);
$stmt->bindParam(':imagem', $imagem);

if ($stmt->execute()) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Filme Inserido</title>
        <link rel="stylesheet" href="../css/style_inserir.css">
    </head>
    <body>
        <div class="card">
            <h2>Filme inserido com sucesso!</h2>
            <a href="form_cadastrar.php" class="btn">Cadastrar outro</a>
            <a href="listar.php" class="btn">Ver Lista</a>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "Erro ao inserir filme.";
}
?>
