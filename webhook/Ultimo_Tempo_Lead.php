<?php
header('Content-Type: application/json');

// Obter a data atual
$today = date("Y-m-d");

// Retornar a resposta em JSON
echo json_encode([
    "success" => true,
    "data" => [
        "dataAtual" => $today
    ]
]);
?>
