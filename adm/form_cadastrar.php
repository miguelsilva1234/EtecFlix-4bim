
<body>
    <link rel="stylesheet" href="../css/style_cadastro.css">
    <div class="container">
        <div class="card-content">
            <h2>CADASTRO DE FILMES</h2>
            <?php if (isset($_SESSION['erro'])): ?>
                <p class="error-msg"><?= htmlspecialchars($_SESSION['erro']) ?></p>
                <?php unset($_SESSION['erro']); ?>
            <?php endif; ?>
            <form action="inserir.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" name="nome" class="form-control" placeholder="Digite o nome do filme" required>
            </div>

            <div class="mb-3">
                <input type="text" name="descricao" class="form-control" placeholder="Digite a descrição do filme" required>
            </div>

            <div class="mb-3">
                <input type="text" name="data_lancamento" class="form-control" placeholder="Digite o ano de lançamento" required>
            </div>

            <div class="mb-3">
                <input type="text" name="tempo_filme" class="form-control" placeholder="Digite a duração do filme" required>
            </div>

            <div class="mb-3">
                <input type="file" name="imagem" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="painel.php" type="button" class="btn btn-warning">Voltar</a>
            </form>
        </div>
    </div>

</body>
</html>
 