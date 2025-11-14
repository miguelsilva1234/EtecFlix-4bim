<?php
require '../conexao.php'; // ajusta o caminho conforme sua estrutura de pastas

// Pega o ID do filme pela URL e valida
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: listar.php');
    exit;
}

// Deleta o filme
$sql = "DELETE FROM filmes WHERE idFilmes = :id";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([':id' => $id]);
    header('Location: listar.php?deleted=1');
    exit;
} catch (PDOException $e) {
    die("Erro ao apagar filme: " . $e->getMessage());
}
?>
