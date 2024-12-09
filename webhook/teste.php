<?php
// Recebe o JSON enviado pelo Google Apps Script
$data = json_decode(file_get_contents('php://input'), true);

// Log do payload recebido (para depuração, remova em produção)
file_put_contents("log.txt", print_r($data, true) . PHP_EOL, FILE_APPEND);

// Verifica se os campos esperados foram enviados
if (isset($data['phone']) && isset($data['name']) && isset($data['tags'])) {
    $phone = $data['phone'];
    $name = $data['name'];
    $tags = $data['tags'];

    // Monta o JSON para enviar ao BotConversa
    $botconversaData = [
        "phone" => $phone,
        "name" => $name,
        "tags" => $tags
    ];

    // URL do webhook do BotConversa
    $url = "https://api.botconversa.com/webhook";

    // Configurações da requisição HTTP
    $options = [
        "http" => [
            "header" => "Content-Type: application/json\r\n",
            "method" => "POST",
            "content" => json_encode($botconversaData),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    // Retorna o resultado da requisição
    echo json_encode(["status" => "success", "response" => $response]);
} else {
    // Log de erro para depuração
    file_put_contents("log.txt", "Erro: Dados inválidos: " . print_r($data, true) . PHP_EOL, FILE_APPEND);
    echo json_encode(["status" => "error", "message" => "Dados inválidos. Campos obrigatórios: phone, name, tags"]);
}
?>
