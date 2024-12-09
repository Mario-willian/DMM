<?php
// Recebe o JSON enviado pelo Google Apps Script
$data = json_decode(file_get_contents('php://input'), true);

// Log do payload recebido
file_put_contents("log.txt", "Payload recebido: " . print_r($data, true) . PHP_EOL, FILE_APPEND);

// Retorna exatamente o payload recebido em JSON, como no log
if ($data && isset($data['phone']) && isset($data['name']) && isset($data['tags'])) {
    echo json_encode($data); // Retorna os dados recebidos no formato JSON
} else {
    // Retorna erro se os campos obrigatórios estiverem ausentes
    echo json_encode([
        "status" => "error",
        "message" => "Dados inválidos ou incompletos. Campos obrigatórios: phone, name, tags"
    ]);
}
?>
