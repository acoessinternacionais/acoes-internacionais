<?php
// grupo_video_signaling.php

session_start();
header("Content-Type: application/json");

// Caminho para salvar as mensagens temporariamente (poderia ser substituído por Redis ou WebSocket)
$signalingFile = __DIR__ . '/signaling_data.json';

// Inicializa o arquivo se ele não existir
if (!file_exists($signalingFile)) {
    file_put_contents($signalingFile, json_encode([]));
}

// Carrega as mensagens
$messages = json_decode(file_get_contents($signalingFile), true);

// Verifica a ação solicitada
$action = $_POST['action'] ?? $_GET['action'] ?? null;
$peerId = $_POST['peer_id'] ?? $_GET['peer_id'] ?? null;
$targetId = $_POST['target_id'] ?? $_GET['target_id'] ?? null;
$data = $_POST['data'] ?? null;

switch ($action) {
    case 'send':
        // Enviar uma mensagem para outro peer
        if ($peerId && $targetId && $data) {
            $messages[$targetId][] = [
                'from' => $peerId,
                'data' => $data,
                'timestamp' => time()
            ];
            file_put_contents($signalingFile, json_encode($messages));
            echo json_encode(['status' => 'ok']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Dados incompletos']);
        }
        break;

    case 'receive':
        // Obter mensagens destinadas a esse peer
        if ($peerId && isset($messages[$peerId])) {
            echo json_encode($messages[$peerId]);
            unset($messages[$peerId]);
            file_put_contents($signalingFile, json_encode($messages));
        } else {
            echo json_encode([]);
        }
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Ação inválida']);
        break;
}
?>
