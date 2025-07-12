<?php
$layoutFile = __DIR__ . '/../backend/layout.json';
$ordem = file_exists($layoutFile) ? json_decode(file_get_contents($layoutFile), true) : [];

foreach ($ordem as $bloco) {
  switch ($bloco) {
    case 'Tabela de Ações':
      include 'components/tabela_acoes.php';
      break;
    case 'Gráficos':
      include 'components/graficos.php';
      break;
    case 'Notícias':
      include 'components/noticias.php';
      break;
    case 'Chat':
      include 'components/chat.php';
      break;
  }
}
?>