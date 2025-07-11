<?php
session_start();
$logado = isset($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Ações Internacionais</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="cabecalho">
  <div class="logo">🌐 AÇÕES INTERNACIONAIS</div>
  <nav>
    <?php if ($logado): ?>
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <a href="login.php">Login</a>
    <?php endif; ?>
  </nav>
</header>

<main class="container">

  <!-- ADS -->
  <section class="ads">
    <h2>ADS</h2>
    <div class="ads-placeholder">Espaço reservado para anúncios</div>
  </section>

  <!-- Tabela de Ações -->
  <section class="acoes">
    <h2>Ações</h2>
    <table>
      <thead>
        <tr>
          <th>Ação</th>
          <th>Preço</th>
          <th>Dividendo</th>
          <th>Variação</th>
        </tr>
      </thead>
      <tbody id="tabela-ativos">
        <!-- Conteúdo dinâmico pelo ativos.js -->
      </tbody>
    </table>
  </section>

  <!-- Gráfico + Chat -->
  <section class="graficos-e-chat">
    <div class="grafico">
      <h3>Gráfico de Ativo</h3>
      <canvas id="graficoAtivo"></canvas>
    </div>
    <div class="chat-global">
      <h3>Chat Global</h3>
      <div id="chat-box"></div>
      <form id="chat-form">
        <input type="text" id="chat-input" placeholder="Digite sua mensagem...">
        <button type="submit">Enviar</button>
      </form>
    </div>
  </section>

  <!-- Notícias -->
  <section class="noticias">
    <h2>Notícias</h2>
    <div id="noticias-container" class="noticias-grid">
      <!-- Notícias inseridas dinamicamente via noticias.js -->
    </div>
  </section>

</main>

<script src="ativos.js"></script>
<script src="chat.js"></script>
<script src="noticias.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>
