<?php
// Caminho do arquivo de log
$log_file = 'log_esp32.txt';

// Função para registrar no log
function registrar_log($mensagem) {
    global $log_file;
    $data_atual = date("Y-m-d H:i:s");
    $log_entry = $data_atual . " - " . $mensagem . "\n";
    file_put_contents($log_file, $log_entry, FILE_APPEND);
}

// Registrar que o script foi acessado
registrar_log("Script acessado.");

// Verifica se o conteúdo do POST é JSON
$inputJSON = file_get_contents('php://input');
registrar_log("Dados brutos recebidos: " . $inputJSON);

// Decodifica os dados JSON
$data_decoded = json_decode($inputJSON, true);

// Verifica se o JSON foi decodificado corretamente
if (json_last_error() !== JSON_ERROR_NONE) {
    registrar_log("Erro ao decodificar JSON: " . json_last_error_msg());
    echo json_encode(["status" => "error", "message" => "Dados inválidos. Certifique-se de que os dados estão no formato JSON."]);
    exit;
}

// Verifica se os dados necessários estão presentes
if (!isset($data_decoded['username']) || !isset($data_decoded['kit']) || !isset($data_decoded['x']) || !isset($data_decoded['y'])) {
    registrar_log("Erro: Dados incompletos ou ausentes.");
    echo json_encode(["status" => "error", "message" => "Dados incompletos."]);
    exit;
}

// Registrar dados decodificados válidos
registrar_log("Dados válidos recebidos: " . print_r($data_decoded, true));

// Configuração do banco de dados (ajuste conforme necessário)
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "u192822332_coordenadas";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    registrar_log("Erro ao conectar ao banco de dados: " . $conn->connect_error);
    echo json_encode(["status" => "error", "message" => "Erro ao conectar ao banco de dados."]);
    exit;
}

// Prepara os dados para inserção no banco
$usuario = $conn->real_escape_string($data_decoded['username']);
$kit = $conn->real_escape_string($data_decoded['kit']);
$x = $conn->real_escape_string($data_decoded['x']);
$y = $conn->real_escape_string($data_decoded['y']);
$timestamp = date("Y-m-d H:i:s");

// SQL para inserir os dados na tabela
$sql = "INSERT INTO montadores (username, kit, coordenada_x, coordenada_y, timestamp) 
        VALUES ('$usuario', '$kit', '$x', '$y', '$timestamp')";

// Verificar se a inserção foi bem-sucedida
if ($conn->query($sql) === TRUE) {
    registrar_log("Dados inseridos com sucesso.");
    echo json_encode(["status" => "success", "message" => "Dados inseridos com sucesso."]);
} else {
    registrar_log("Erro ao inserir no banco de dados: " . $conn->error);
    echo json_encode(["status" => "error", "message" => "Erro ao inserir no banco de dados: " . $conn->error]);
}

// Fechar conexão
$conn->close();

?>
