<!-- header.php -->
<header>
  <nav class="navbar">
    <h1 class="logo">EtecFlix</h1>
    <ul class="menu">
      <?php
      if (isset($_SESSION['idUsuario'])) {
          // Usuário logado: mostra primeiro nome e "Sair"
          $primeiroNome = explode(' ', $_SESSION['nome'])[0];
          echo '<li>Olá, ' . htmlspecialchars($primeiroNome) . '</li>';
      }
      ?>

      <li><a href="/Etec4bim/principal.php" class="active">Início</a></li>
      <li><a href="/Etec4bim/sobre.php">Sobre</a></li>

      <?php
      if (isset($_SESSION['idUsuario'])) {
          // Caminho absoluto funcionando em qualquer lugar
          echo '<li><a href="/Etec4bim/logout.php">Sair</a></li>';
      } else {
          echo '<li><a href="/Etec4bim/login.php">Login</a></li>';
      }
      ?>
    </ul>
  </nav>
</header>
