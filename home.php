<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>AÇÕES INTERNACIONAIS</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <header>
    <div class="header-container">
      <h1>AÇÕES INTERNACIONAIS</h1>
      <div class="login-section">
        <?php
        session_start();
        if (isset($_SESSION['usuario'])) {
          echo '<a href="logout.php">Logout</a>';
        } else {
          echo '<a href="login.php">Login</a>';
        }
        ?>
      </div>
    </div>
  </header>

  <main>
    <section class="ads-section">
      <h2>ADS</h2>
      <div class="ads-container">
        <div class="ad">Anúncio 1</div>
        <div class="ad">Anúncio 2</div>
        <div class="ad">Anúncio 3</div>
      </div>
    </section>

    <section class="acoes-section">
      <h2>Ações</h2>
      <table class="acoes-table">
        <thead>
          <tr>
            <th>Ação</th>
            <th>Preço</th>
            <th>Dividendo</th>
            <th>Variação</th>
          </tr>
        </thead>
        <tbody id="tabela-ativos">
          <!-- Conteúdo será inserido por ativos.js -->
        </tbody>
      </table>
      <canvas id="graficoAcoes" width="400" height="200"></canvas>
    </section>

    <section class="chat-section">
      <h2>Chat</h2>
      <div id="chat-box"></div>
      <input type="text" id="chat-input" placeholder="Digite sua mensagem...">
      <button onclick="enviarMensagem()">Enviar</button>
    </section>

    <section class="noticias-section">
      <h2>Notícias</h2>
      <div id="noticias-container" class="noticias-container">
        <!-- Notícias com imagens via noticias.js -->
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Ações Internacionais</p>
  </footer>

  <script src="ativos.js"></script>
  <script src="chat.js"></script>
  <script src="noticias.js"></script>
</body>
</html>
