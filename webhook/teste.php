<?php
// Recebe o JSON enviado pelo Google Apps Script
$data = json_decode(file_get_contents('php://input'), true);

// Log do payload recebido (para depuração)
file_put_contents("log.txt", "Payload recebido: " . print_r($data, true) . PHP_EOL, FILE_APPEND);

// Validação simples e retorno de status
if ($data && isset($data['phone']) && isset($data['name']) && isset($data['tags'])) {
    echo json_encode([
        "status" => "success",
        "message" => "Dados recebidos com sucesso",
        "data" => $data // Retorna os dados recebidos
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Dados inválidos ou incompletos. Campos obrigatórios: phone, name, tags"
    ]);
}
?>
