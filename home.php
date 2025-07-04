<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Ações Internacionais - Home</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <header>
    <h1 class="logo">AÇÕES INTERNACIONAIS</h1>
    <a href="login.php" class="login-btn">Login</a>
  </header>

  <main class="container">
    <!-- Painel de Ações -->
    <section class="content">
      <h2>Ativos em Destaque</h2>
      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>Ticker</th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Dividendos</th>
              <th>Variação</th>
            </tr>
          </thead>
          <tbody id="tabela-ativos">
            <!-- Dados serão preenchidos via JS -->
            <tr><td colspan="5">Carregando...</td></tr>
          </tbody>
        </table>
      </div>

      <!-- Gráfico de Preços -->
      <div class="graph box">
        <h3>Gráfico de Ações</h3>
        <canvas id="grafico-preco" width="400" height="200"></canvas>
      </div>
    </section>
<div style="margin: 10px 0;">
  <label for="filtro-periodo">Período:</label>
  <select id="filtro-periodo">
    <option value="daily" selected>Diário</option>
    <option value="weekly">Semanal</option>
    <option value="monthly">Mensal</option>
  </select>
</div>
<canvas id="grafico-preco" height="100"></canvas>

    <!-- Sidebar: Chat, Bio, Notícias -->
    <aside class="sidebar">
      <!-- Chat -->
      <div class="chat-box box">
        <h3>Chat ao Vivo</h3>
        <div id="chat-mensagens" style="height: 120px; overflow-y: auto;"></div>
        <input type="text" id="chat-input" placeholder="Digite sua mensagem...">
        <button onclick="enviarMensagem()">Enviar</button>
      </div>

      <!-- Bio -->
      <div class="bio-box box">
        <h3>Sobre o Usuário</h3>
        <p>Bem-vindo! Aqui você acompanha ativos internacionais com dados em tempo real.</p>
      </div>

      <!-- Notícias -->
      <div class="noticias-box box">
        <h3>Últimas Notícias</h3>
        <ul id="lista-noticias">
          <li>Carregando...</li>
        </ul>
      </div>
    </aside>
  </main>

  <footer>
    &copy; 2025 Ações Internacionais. Todos os direitos reservados.
  </footer>

  <!-- Scripts -->
  <script src="js/chat.js" defer></script>
  <script src="js/noticias.js" defer></script>
  <script src="js/ativos.js" defer></script> <!-- novo script que você pode criar para preencher a tabela -->
</body>
</html>
