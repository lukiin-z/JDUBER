<?php
// Inclui a conexão com o banco de dados
include 'config.php'; // Certifique-se de ajustar para o caminho correto do seu arquivo de configuração

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $data = json_decode(file_get_contents("php://input"));

    $username = trim($data->username);
    $name = trim($data->name);
    $email = trim($data->email);
    $password = trim($data->password);
    $role = trim($data->role);

    // Validações básicas
    if (empty($username) || empty($name) || empty($email) || empty($password) || empty($role)) {
        echo json_encode(["success" => false, "message" => "Por favor, preencha todos os campos."]);
        exit;
    }

    // Verificar se o nome de usuário já existe
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["success" => false, "message" => "Nome de usuário já existe. Por favor, escolha outro."]);
        exit;
    }

    // Verifica se o email já está em uso
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["success" => false, "message" => "E-mail já está em uso."]);
        exit;
    }

    // Hash da senha
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insere o novo usuário no banco de dados
    $sql = "INSERT INTO users (username, name, email, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$username, $name, $email, $hashed_password, $role])) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Ocorreu um erro ao realizar o cadastro."]);
    }
}
?>
