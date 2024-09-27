<?php
header('Content-Type: application/json');

// Montador cria um chamado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do corpo da requisição
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Valida e processa os dados
    $location = $data['location'];
    $userId = $data['userId'];
    
    // Insere chamado no banco de dados
    createChamado($userId, $location);
    
    // Resposta JSON de sucesso
    echo json_encode(['status' => 'success']);
}
?>
