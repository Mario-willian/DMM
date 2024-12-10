<?php
header('Content-Type: application/json');

// Configurar o fuso horário
date_default_timezone_set('America/Sao_Paulo'); // Fuso horário de Brasília

// Obter a data atual e hora
$today = date("d/m");
$current_time = date("H:i:s"); // Hora atual
$timestamp = time(); // Timestamp Unix (inteiro)

// Determinar o período do dia
$hour = (int) date("H"); // Converter a hora para inteiro

// Lógica para definir "manhã", "tarde" ou "noite"
if ($hour >= 5 && $hour < 12) {
    $period = "bom dia";
} elseif ($hour >= 12 && $hour < 19) { // Ajustado para incluir até 18:59
    $period = "boa tarde";
} else {
    $period = "boa noite";
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
