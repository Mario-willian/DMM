<?php
// Recebe o JSON enviado pelo Google Apps Script ou outro serviço
$data = json_decode(file_get_contents('php://input'), true);

// Verifica se os dados foram enviados corretamente
if (isset($data['phone']) && isset($data['message'])) {
    $phone = $data['phone'];
    $message = $data['message'];

    // Monta o JSON para enviar ao BotConversa
    $botconversaData = [
        "phone" => $phone,
        "message" => $message
    ];

    // URL do webhook do BotConversa
    $url = "https://api.botconversa.com/webhook";

    // Envia os dados ao BotConversa
    $options = [
        "http" => [
            "header" => "Content-Type: application/json\r\n",
            "method" => "POST",
            "content" => json_encode($botconversaData),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    // Retorna o resultado para o Google Apps Script
    echo json_encode(["status" => "success", "response" => $response]);
} else {
    echo json_encode(["status" => "error", "message" => "Dados inválidos."]);
}
?>
