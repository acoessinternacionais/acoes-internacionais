<?php
// home.php – Página principal do site
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

    <!-- Seção de Ativos -->
    <section id="ativos">
      <h2 class="titulo-secao">Ativos em Tempo Real</h2>
      <div class="ativos-container" id="ativos-container">
        <!-- Ativos carregados dinamicamente via ativos.js -->
        <p>Carregando ativos...</p>
      </div>
    </section>

    <!-- Gráfico de Ativos -->
    <section id="grafico">
      <h2 class="titulo-secao">Evolução de Preços</h2>
      <div class="grafico-container">
        <canvas id="graficoCanvas"></canvas>
      </div>
    </section>

    <!-- Tabela de Ativos -->
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
          <!-- Conteúdo preenchido via ativos.js -->
        </tbody>
      </table>
    </section>

    <!-- Notícias Recentes -->
    <section id="noticias">
      <h2 class="titulo-secao">Notícias Recentes</h2>
      <div class="noticias-container" id="noticias-container">
        <p>Carregando notícias...</p>
      </div>
    </section>

    <!-- Chat -->
    <section id="chat">
      <h2 class="titulo-secao">Chat</h2>
      <div id="chat-box" style="background:#fff; padding:10px; border-radius:8px; height:300px; overflow-y:auto;">
        <!-- Mensagens do chat -->
      </div>
      <form id="chat-form" style="margin-top:10px; display:flex; gap:8px;">
        <input type="text" id="chat-input" placeholder="Digite sua mensagem..." style="flex:1; padding:8px;" />
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
