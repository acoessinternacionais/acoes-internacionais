<?php
// home.php – Página principal do dashboard financeiro
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Financeiro</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <header>
    <h1 class="titulo-secao">Dashboard Financeiro</h1>
  </header>

  <main>

    <!-- Ativos -->
    <section id="ativos">
      <h2 class="titulo-secao">Ativos em Tempo Real</h2>
      <div class="ativos-container" id="ativos-container">
        <p>Carregando ativos...</p>
      </div>
    </section>

    <!-- Gráfico -->
    <section id="grafico">
      <h2 class="titulo-secao">Gráfico de Variação</h2>
      <div class="grafico-container">
        <canvas id="graficoCanvas" width="400" height="200"></canvas>
      </div>
    </section>

    <!-- Tabela -->
    <section id="tabela">
      <h2 class="titulo-secao">Tabela de Cotações</h2>
      <table class="tabela-ativos" id="tabela-ativos">
        <thead>
          <tr>
            <th>Ativo</th>
            <th>Valor</th>
            <th>Variação</th>
          </tr>
        </thead>
        <tbody>
          <!-- Dados carregados via ativos.js -->
        </tbody>
      </table>
    </section>

    <!-- Notícias -->
    <section id="noticias">
      <h2 class="titulo-secao">Notícias Recentes</h2>
      <div class="noticias-container" id="noticias-container">
        <p>Carregando notícias...</p>
      </div>
    </section>

    <!-- Chat -->
    <section id="chat">
      <h2 class="titulo-secao">Chat</h2>
      <div id="chat-box" class="chat-box"></div>
      <form id="chat-form" class="chat-form">
        <input type="text" id="chat-input" placeholder="Digite sua mensagem..." />
        <button type="submit" class="botao">Enviar</button>
      </form>
    </section>

  </main>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="js/ativos.js"></script>
  <script src="js/noticias.js"></script>
  <script src="js/chat.js"></script>

</body>
</html>
