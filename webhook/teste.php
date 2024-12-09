<?php
// Caminho do arquivo de log
$logFile = "log.txt";

// Verifica se o arquivo de log existe
if (file_exists($logFile)) {
    // Lê o conteúdo do log
    $logContent = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Procura a última linha válida que contenha dados estruturados
    for ($i = count($logContent) - 1; $i >= 0; $i--) {
        $line = $logContent[$i];

        // Tenta decodificar a linha como JSON
        $jsonData = json_decode($line, true);

        if ($jsonData) {
            // Retorna o último JSON válido
            echo json_encode($jsonData);
            exit;
        }
    }

    // Se não encontrar JSON válido, retorna mensagem de erro
    echo json_encode(["status" => "error", "message" => "Nenhum dado JSON válido encontrado no log."]);
} else {
    // Arquivo de log não encontrado
    echo json_encode(["status" => "error", "message" => "Arquivo de log não encontrado."]);
}
?>
