<?php
// Exibir erros para fins de desenvolvimento
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Definir as credenciais do banco de dados
$host = 'localhost';
$db = 'u192822332_bancojduber';
$user = 'u192822332_bolla_x';
$pass = 'Luke582279'; // Recomendado: mover esta senha para um local seguro, como variáveis de ambiente

try {
    // Conectar ao banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Definir o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em caso de falha, exibir um erro amigável
    echo "Falha na conexão com o banco de dados.";
    // Para fins de depuração, você pode usar json_encode em um contexto de API
    // echo json_encode(['error' => 'Falha na conexão: ' . $e->getMessage()]);
    exit;
}
?>
