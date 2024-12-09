<?php
// Recebe o JSON enviado pelo Google Apps Script
$data = json_decode(file_get_contents('php://input'), true);

// Verifica se os dados esperados foram enviados
if (isset($data['phone']) && isset($data['name']) && isset($data['tags'])) {
    $phone = $data['phone']; // Número de telefone
    $name = $data['name'];   // Nome do contato
    $tags = $data['tags'];   // Etiquetas associadas

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

    // Envia os dados ao webhook do BotConversa
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    // Retorna o resultado da requisição
    echo json_encode(["status" => "success", "response" => $response]);
} else {
    // Retorna um erro se os dados não estiverem completos
    echo json_encode(["status" => "error", "message" => "Dados inválidos. Campos obrigatórios: phone, name, tags"]);
}
?>
