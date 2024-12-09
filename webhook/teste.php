<?php
// Recebe o JSON enviado pelo Google Apps Script
$data = json_decode(file_get_contents('php://input'), true);

// Log para depurar
file_put_contents("log.txt", "JSON Recebido: " . print_r($data, true) . PHP_EOL, FILE_APPEND);

// Verifica se os dados foram recebidos
if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "Nenhum dado recebido ou formato inválido."
    ]);
    exit;
}

// Retorna os dados recebidos para teste
echo json_encode([
    "status" => "success",
    "message" => "Dados processados com sucesso.",
    "data" => $data
]);
?>
