<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Ações Internacionais</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script defer src="js/ativos.js"></script>
</head>
<body>
  <h1>Painel de Ativos</h1>

  <div class="abas">
    <button onclick="mudarAba('acoes')">Ações</button>
    <button onclick="mudarAba('fiis')">FIIs</button>
    <button onclick="mudarAba('etfs')">ETFs</button>
  </div>

  <div id="acoes" class="aba ativa">
    <h2>Ações</h2>
    <table id="tabela-ativos" class="tabela"></table>
  </div>

  <div id="fiis" class="aba">
    <h2>FIIs</h2>
    <table id="tabela-fiis" class="tabela"></table>
  </div>

  <div id="etfs" class="aba">
    <h2>ETFs</h2>
    <table id="tabela-etfs" class="tabela"></table>
  </div>

  <div style="margin: 10px 0;">
    <label for="filtro-periodo">Período:</label>
    <select id="filtro-periodo">
      <option value="daily" selected>Diário</option>
      <option value="weekly">Semanal</option>
      <option value="monthly">Mensal</option>
    </select>
  </div>

  <canvas id="grafico-preco" height="100"></canvas>
</body>
</html>