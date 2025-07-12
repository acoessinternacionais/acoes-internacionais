<?php
// index.php – Página de entrada do site
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Início - Dashboard Financeiro</title>
  <link rel="stylesheet" href="style.css">
<section id="acoes" class="secao-ativos">
  <h2 class="titulo-secao">Tabela de Ações</h2>
  <div id="acoes-table" class="tabela-container"></div>
  <canvas id="acoes-chart" class="grafico-ativo"></canvas>
</section>
<script src="/js/ativos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

  <?php
    // Inclui a home diretamente
    include('home.php');
  ?>

</body>
</html>
