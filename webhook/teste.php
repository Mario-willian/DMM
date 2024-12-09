<?php
// Recebe o JSON enviado pelo Google Apps Script
$data = json_decode(file_get_contents('php://input'), true);

// Verifica se os dados foram enviados corretamente
if (!isset($data['data']) || !is_array($data['data'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Dados ausentes ou inválidos."
    ]);
    exit;
}

// Dados recebidos
$rows = $data['data'];
$aniversariantes = [];
$hoje = date("m-d"); // Formato mês-dia

// Filtra os aniversariantes do dia
foreach ($rows as $i => $row) {
    if ($i === 0) continue; // Ignora o cabeçalho
    list($telefone, $nome, $dataNascimento, $etiquetas) = $row;

    if (!$telefone || !$nome || !$dataNascimento) continue;

    // Extrai o mês e dia do nascimento
    $dataNascimentoFormatada = date("m-d", strtotime($dataNascimento));

    if ($dataNascimentoFormatada === $hoje) {
        $aniversariantes[] = [
            "phone" => $telefone,
            "name" => $nome,
            "tags" => $etiquetas
        ];
    }
}

// Remove duplicados (baseado no telefone)
$aniversariantes = array_unique($aniversariantes, SORT_REGULAR);

// Retorna os resultados
if (!empty($aniversariantes)) {
    echo json_encode([
        "status" => "success",
        "data" => $aniversariantes
    ]);
} else {
    echo json_encode([
        "status" => "not_found",
        "message" => "Nenhum aniversariante encontrado para hoje."
    ]);
}
?>
