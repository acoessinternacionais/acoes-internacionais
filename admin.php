<?php
// admin.php — Estrutura inicial do painel de administrador
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header('Location: index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel do Administrador</title>
  <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
  <h1>Painel do Administrador</h1>

  <section>
    <h2>Gerenciar Ativos</h2>
    <button onclick="abrirModal('ativo')">Adicionar Novo Ativo</button>
    <div id="lista-ativos"></div>
  </section>

  <section>
    <h2>Editar Estilo do Site</h2>
    <label for="corFundo">Cor de fundo:</label>
    <input type="color" id="corFundo">
    <label for="fonte">Fonte:</label>
    <select id="fonte">
      <option value="Impact">Impact</option>
      <option value="Arial">Arial</option>
      <option value="Roboto">Roboto</option>
    </select>
    <button onclick="aplicarEstilo()">Aplicar Estilo</button>
  </section>

  <section>
    <h2>Reorganizar Seções</h2>
    <p>Arraste os blocos abaixo para reorganizar o layout do site:</p>
    <div id="blocos-layout">
      <div draggable="true" class="bloco">Tabela de Ações</div>
      <div draggable="true" class="bloco">Gráficos</div>
      <div draggable="true" class="bloco">Notícias</div>
      <div draggable="true" class="bloco">Chat</div>
    </div>
  </section>

  <script src="/js/admin.js"></script>
</body>
</html>
