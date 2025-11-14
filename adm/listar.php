<?php
require('../conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Filmes</title>
    <link rel="stylesheet" href="../css/style_listagem.css"> <!-- caminho ajustado -->
</head>
<body>

<div class="container">

    <?php if (isset($_GET['created'])): ?>
        <div class="alert alert-success">Filme cadastrado com sucesso.</div>
    <?php endif; ?>
    <?php if (isset($_GET['updated'])): ?>
        <div class="alert alert-success">Filme atualizado com sucesso.</div>
    <?php endif; ?>
    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success">Filme apagado com sucesso.</div>
    <?php endif; ?>

    <h1>Lista de Filmes</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOME</th>
                <th scope="col">DESCRIÇÃO</th>
                <th scope="col">ANO</th>
                <th scope="col">DURAÇÃO</th>
                <th scope="col">IMAGEM</th>
                <th scope="col">OPÇÕES</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM filmes ORDER BY idFilmes ASC";
            $stmt = $pdo->query($sql);

            while ($filme = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($filme['idFilmes']) . "</td>";
                echo "<td>" . htmlspecialchars($filme['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($filme['descricao']) . "</td>";
                echo "<td>" . htmlspecialchars($filme['data_lancamento']) . "</td>";
                echo "<td>" . htmlspecialchars($filme['tempo_filme']) . "</td>";

                // Exibe imagem se existir
                if (!empty($filme['imagem'])) {
                    echo "<td><img src='../" . htmlspecialchars($filme['imagem']) . "' alt='Capa' width='80'></td>";
                } else {
                    echo "<td>—</td>";
                }

                // Botões de ação
                echo "<td>
                        <div class='btn-group' role='group'>
                            <a href='form_atualizado.php?id=" . urlencode($filme['idFilmes']) . "' class='btn btn-success'>Atualizar</a>
                            <a href='apagar.php?id=" . urlencode($filme['idFilmes']) . "' class='btn btn-danger' onclick=\"return confirm('Deseja realmente apagar este filme?');\">Apagar</a>
                        </div>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="painel.php" class="btn btn-warning">Voltar</a>
</div>
</body>
</html>
