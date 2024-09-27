<?php
// Credenciais de conexão
$servername = "localhost";
$username = "u192822332_bolla_x2";  // Nome de usuário do MySQL
$password = "Luke582279";  // Senha do MySQL
$dbname = "u192822332_coordenadas";  // Nome da base de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Capturar os dados enviados via POST
$data = json_decode(file_get_contents("php://input"), true);

// Verificar se os dados foram recebidos corretamente
if (isset($data['id']) && isset($data['x']) && isset($data['y']) && isset($data['mode'])) {
    
    // Limpar os dados recebidos para evitar problemas com caracteres especiais
    $id = htmlspecialchars($data['id']);
    $x = filter_var($data['x'], FILTER_VALIDATE_FLOAT);
    $y = filter_var($data['y'], FILTER_VALIDATE_FLOAT);
    $mode = htmlspecialchars($data['mode']);

    // Verificar se as coordenadas são válidas
    if ($x === false || $y === false) {
        echo "Coordenadas inválidas.";
    } else {
        // Preparar a query com prepared statements para evitar injeção de SQL
        $stmt = $conn->prepare("REPLACE INTO kits (id, x, y, mode) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdds", $id, $x, $y, $mode);  // 's' para string, 'd' para double

        // Executar a query e verificar se foi bem-sucedida
        if ($stmt->execute()) {
            echo "Dados inseridos/atualizados com sucesso na tabela kits";
        } else {
            echo "Erro: " . $stmt->error;
        }

        // Fechar a declaração
        $stmt->close();
    }
} else {
    echo "Dados incompletos.";
}

// Fechar conexão
$conn->close();
?>
