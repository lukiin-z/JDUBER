<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Função que conecta ao banco de dados
function connectDB() {
            $host = 'localhost';  // Host do banco de dados
            $dbname = 'u192822332_bancojduber';  // Nome do banco de dados
            $username = 'u192822332_bolla_x';  // Usuário do banco de dados
            $password = 'Luke582279';  // Senha do banco de dados




    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro de conexão com o banco de dados: ' . $e->getMessage()]);
        exit;
    }
}

// Função que obtém as localizações dos usuários
function getAllUserLocations() {
    $pdo = connectDB();
    
    try {
        $stmt = $pdo->prepare("SELECT latitude, longitude, role FROM users"); // Ajuste o nome da tabela e colunas
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro ao buscar localizações: ' . $e->getMessage()]);
        exit;
    }
}

// Retorna a localização de todos os operadores e montadores
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $locations = getAllUserLocations();
    
    // Retorna as localizações em JSON
    echo json_encode($locations);
}
?>
