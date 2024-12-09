<?php
// Recebe o JSON enviado pelo BotConversa
$data = json_decode(file_get_contents('php://input'), true);

// Log para depuração
file_put_contents("log.txt", "Dados recebidos: " . print_r($data, true) . PHP_EOL, FILE_APPEND);

// Verifica se o JSON contém os campos obrigatórios
if (!isset($data['phone']) || !isset($data['name'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Campos obrigatórios ausentes: phone, name"
    ]);
    exit;
}

// Retorna sucesso para teste
echo json_encode([
    "status" => "success",
    "message" => "Webhook processado com sucesso!",
    "data" => $data
]);
?>
