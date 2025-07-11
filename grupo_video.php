<?php
// group_video.php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Vídeos Informativos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css"> <!-- Certifique-se que o arquivo CSS está corretamente linkado -->
  <style>
    body {
      font-family: Impact, sans-serif;
      background-color: #f4f7fa;
      margin: 0;
      padding: 0;
    }

    .video-section {
      padding: 30px;
      text-align: center;
    }

    .video-section h2 {
      color: #003366;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .video-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
      padding: 0 20px;
    }

    .video-wrapper {
      position: relative;
      padding-bottom: 56.25%; /* 16:9 ratio */
      height: 0;
      overflow: hidden;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .video-wrapper iframe {
      position: absolute;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      border: none;
    }
  </style>
</head>
<body>

  <div class="video-section">
    <h2>Vídeos Informativos</h2>

    <div class="video-grid">
      <div class="video-wrapper">
        <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY" allowfullscreen></iframe>
      </div>
      <div class="video-wrapper">
        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
      </div>
      <div class="video-wrapper">
        <iframe src="https://www.youtube.com/embed/ScMzIvxBSi4" allowfullscreen></iframe>
      </div>
    </div>
  </div>

</body>
</html>
