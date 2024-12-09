<?php
// Caminho do arquivo de log
$logFile = "log.txt";

// Verifica se o arquivo de log existe
if (file_exists($logFile)) {
    // Lê o conteúdo do log
    $logContent = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Obtém a última linha do log, que deve conter o último payload recebido
    $lastEntry = end($logContent);

    // Verifica se a última entrada é válida (não está vazia)
    if ($lastEntry) {
        // Tenta decodificar o JSON da última linha (caso seja JSON)
        $jsonData = json_decode($lastEntry, true);

        if ($jsonData) {
            // Retorna o último payload como JSON
            echo json_encode($jsonData);
        } else {
            // Se a última linha não for JSON, retorna o texto como está
            echo json_encode(["status" => "success", "message" => $lastEntry]);
        }
    } else {
        // Log está vazio
        echo json_encode(["status" => "error", "message" => "Log vazio. Nenhum dado disponível."]);
    }
} else {
    // Arquivo de log não encontrado
    echo json_encode(["status" => "error", "message" => "Arquivo de log não encontrado."]);
}
?>
