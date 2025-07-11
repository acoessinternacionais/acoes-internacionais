<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Início - Ações Internacionais</title>
  <style>
    body {
      font-family: Impact, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #1e90ff;
      color: white;
      padding: 20px 0;
      text-align: center;
      font-size: 26px;
      border-bottom: 4px solid #1473cc;
    }

    main {
      text-align: center;
      padding: 50px 20px;
    }

    .buttons {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 30px;
    }

    .buttons a {
      background-color: #add8e6;
      color: #000;
      padding: 12px 24px;
      border-radius: 5px;
      text-decoration: none;
      font-size: 18px;
      transition: background-color 0.3s;
    }

    .buttons a:hover {
      background-color: #9ccbe0;
    }

    footer {
      margin-top: 60px;
      padding: 15px;
      text-align: center;
      color: #666;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <header>
    Ações Internacionais - Página Inicial
  </header>

  <main>
    <h2>Seja bem-vindo ao painel de investimentos!</h2>
    <p>Explore os recursos disponíveis abaixo:</p>

    <div class="buttons">
      <a href="home.php">Página Inicial</a>
      <a href="painel-ativos/index.html">Painel de Ativos</a>
      <a href="noticias.php">Notícias</a>
      <a href="chat.php">Chat</a>
      <a href="grupo_video.php">Vídeo Conferência</a>
    </div>
  </main>

  <footer>
    &copy; <?php echo date("Y"); ?> - Projeto Ações Internacionais
  </footer>

</body>
</html>
