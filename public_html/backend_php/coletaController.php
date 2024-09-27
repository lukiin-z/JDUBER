<?php
function coletarDados($dados) {
    global $pdo;

    // Logica de coleta de dados
    try {
        $stmt = $pdo->prepare("INSERT INTO coleta (data, valor) VALUES (:data, :valor)");
        $stmt->execute(['data' => $dados['data'], 'valor' => $dados['valor']]);
        echo json_encode(['success' => true, 'message' => 'Dados coletados com sucesso']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erro ao coletar dados: ' . $e->getMessage()]);
    }
}
?>