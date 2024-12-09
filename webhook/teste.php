<?php
// Recebe o JSON enviado pelo BotConversa
$data = json_decode(file_get_contents('php://input'), true);

// Verifica se o JSON contém os campos obrigatórios
if (!isset($data['phone']) || !isset($data['name'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Campos obrigatórios ausentes: phone, name"
    ]);
    exit;
}

// Dados recebidos
$phone = $data['phone'];
$name = $data['name'];

// Caminho do arquivo log.txt para simular a planilha
$logFile = "log.txt";

// Verifica se o arquivo log.txt existe
if (file_exists($logFile)) {
    // Lê o conteúdo do log
    $logContent = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Procura por uma entrada que corresponda ao telefone e nome
    foreach ($logContent as $line) {
        // Decodifica cada linha como JSON
        $entry = json_decode($line, true);

        // Verifica se o telefone e nome correspondem
        if ($entry && $entry['phone'] == $phone && $entry['name'] == $name) {
            // Retorna os dados da pessoa que faz aniversário
            echo json_encode($entry);
            exit;
        }
    }

    // Se nenhuma correspondência for encontrada
    echo json_encode([
        "status" => "not_found",
        "message" => "Nenhum registro encontrado para o telefone e nome fornecidos."
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Arquivo de log não encontrado."
    ]);
}
?>
