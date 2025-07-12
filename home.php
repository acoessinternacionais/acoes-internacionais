<?php
session_start();
$isLoggedIn = isset($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ações Internacionais</title>
  <link rel="stylesheet" href="style.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<header>
  <h1>AÇÕES INTERNACIONAIS</h1>
  <a href="<?= $isLoggedIn ? 'logout.php' : 'login.php' ?>">
    <?= $isLoggedIn ? 'Logout' : 'Login' ?>
  </a>
</header>

<main>

  <!-- Área de anúncios -->
  <section class="ads-section">
    ADS
  </section>

  <?php include 'render_layout_blocks.php'; ?>

  <!-- Tabela de Ações -->
  <section class="acoes-section">
    <table class="acoes-table">
      <thead>
        <tr>
          <th>Ação</th>
          <th>Preço</th>
          <th>Dividendo</th>
          <th>Vari.</th>
        </tr>
      </thead>
      <tbody id="ativos-tabela">
        <!-- Dados serão preenchidos via ativos.js -->
      </tbody>
    </table>
  </section>

  <!-- Chat e Gráfico -->
  <section class="chat-grafico-container">

    <div class="chat-section">
      <h2>Chat</h2>
      <div id="chat-box"></div>
      <input type="text" id="chat-input" placeholder="Digite sua mensagem..." />
      <button onclick="enviarMensagem()">Enviar</button>
    </div>

    <div class="grafico-section">
      <canvas id="grafico-dividendos"></canvas>
    </div>

  </section>

  <!-- Seção de Notícias -->
  <section class="noticias-section">
    <h2>Notícias</h2>
    <div class="noticias-container" id="noticias-container">
      <!-- Notícias com imagem carregadas via noticias.js -->
    </div>
    <button class="botao-noticias">Mais Notícias</button>
  </section>

</main>

<script src="ativos.js"></script>
<script src="chat.js"></script>
<script src="noticias.js"></script>
<script>
  // Gráfico exemplo (não usa chat.js)
  const ctx = document.getElementById('grafico-dividendos');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
      datasets: [{
        label: 'Dividendos',
        data: [0.3, 0.5, 0.4, 0.7, 0.6],
        borderColor: '#2693dc',
        tension: 0.3,
        fill: false
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
</script>

</body>
</html>
