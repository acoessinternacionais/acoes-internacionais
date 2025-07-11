<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Home - Painel de Ativos</title>
  <style>
    body {
      font-family: Impact, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
      text-align: center;
    }

    header {
      background-color: #1e90ff;
      color: white;
      padding: 20px 0;
      font-size: 28px;
      border-bottom: 5px solid #1473cc;
    }

    main {
      margin-top: 40px;
    }

    .nav-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap;
      margin-top: 30px;
    }

    .nav-buttons a {
      background-color: #add8e6;
      color: black;
      text-decoration: none;
      padding: 12px 25px;
      border-radius: 5px;
      font-size: 18px;
      transition: background-color 0.3s;
    }

    .nav-buttons a:hover {
      background-color: #9ccbe0;
    }

    footer {
      margin-top: 60px;
      padding: 15px;
      font-size: 14px;
      color: #666;
    }
  </style>
</head>
<body>
  <header>
    Painel de Ativos Internacionais
  </header>

  <main>
    <h2>Bem-vindo!</h2>
    <p>Escolha uma das opções abaixo para navegar pelo site:</p>

    <div class="nav-buttons">
      <a href="painel-ativos/index.html">Ver Painel de Ativos</a>
      <a href="noticias.php">Notícias</a>
      <a href="chat.php">Chat</a>
      <a href="grupo_video.php">Vídeo Conferência</a>
    </div>
  </main>

  <footer>
    &copy; <?php echo date("Y"); ?> - Seu Nome ou Projeto
  </footer>
</body>
</html>
