<?php
header('Content-Type: application/json');

// Obter a data atual
$today = date("Y-m-d");
$current_time = date("H:i:s"); // Hora atual
$timestamp = time(); // Timestamp Unix (inteiro)

// Retornar a resposta em JSON
echo json_encode([
    "success" => true,
    "data" => [
        "dataAtual" => $today,
        "horaAtual" => $current_time,
        "timestamp" => $timestamp // Valor inteiro para comparações
    ]
]);
?>
