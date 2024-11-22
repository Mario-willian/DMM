<?php
header('Content-Type: application/json');

// Obter a data atual e hora
$today = date("Y-m-d");
$current_time = date("H:i:s"); // Hora atual
$timestamp = time(); // Timestamp Unix (inteiro)

// Determinar o período do dia
$hour = date("H"); // Apenas a hora atual (em 24h)

// Lógica para definir "manhã", "tarde" ou "noite"
if ($hour >= 5 && $hour < 12) {
    $period = "dia";
} elseif ($hour >= 12 && $hour < 18) {
    $period = "tarde";
} else {
    $period = "noite";
}

// Retornar a resposta em JSON
echo json_encode([
    "success" => true,
    "data" => [
        "dataAtual" => $today,
        "horaAtual" => $current_time,
        "timestamp" => $timestamp, // Valor inteiro para comparações
        "periodo" => $period // Manhã, Tarde ou Noite
    ]
]);
?>
