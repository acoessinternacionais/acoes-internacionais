<?php
// Página principal
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Ações Internacionais</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <header>
    <div class="logo">AÇÕES INTERNACIONAIS</div>
    <a href="#" class="auth-link">Login</a>
  </header>

  <main>
    <section class="busca">
      <input type="text" id="ticker-input" placeholder="Ticker (ex: PETR4)">
      <button onclick="buscarAtivo()">Pesquisar</button>
    </section>

    <section class="ads">ADS</section>

    <section class="tabela-grafico">
      <table class="dados-ativos">
        <thead>
          <tr>
            <th>Ação</th><th>Preço</th><th>Dividendo</th><th>Vari.</th>
          </tr>
        </thead>
        <tbody id="resultado-tabela">
        </tbody>
      </table>

      <canvas id="grafico" height="150"></canvas>
    </section>

    <aside class="sidebar">
      <div class="chat">Chat</div>
      <div class="noticias">Notícias</div>
    </aside>
  </main>

  <script src="script.js"></script>
</body>
</html>
