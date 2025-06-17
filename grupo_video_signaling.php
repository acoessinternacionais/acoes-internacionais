
<?php
$sala = $_GET['sala'] ?? 'padrao';
$id = $_GET['id'] ?? null;

$arquivo = sys_get_temp_dir() . "/sala_{$sala}.json";

if (!file_exists($arquivo)) file_put_contents($arquivo, json_encode([]));
$lista = json_decode(file_get_contents($arquivo), true);

if ($id) {
    if (!in_array($id, $lista)) {
        $lista[] = $id;
        file_put_contents($arquivo, json_encode($lista));
    }
    echo "OK";
} else {
    header('Content-Type: application/json');
    echo json_encode($lista);
}
?>
