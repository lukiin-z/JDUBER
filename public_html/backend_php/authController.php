<?php
// Iniciar sessão para armazenar informações do usuário
session_start();
require 'config.php'; // Arquivo de configuração do banco de dados

// Função de login
function login($login, $password) {
    global $pdo;

    try {
        // Verificar se o login é um e-mail ou nome de usuário
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            // Se for um e-mail, buscar pelo e-mail
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :login");
        } else {
            // Se for um nome de usuário, buscar pelo username
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :login");
        }

        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar se a senha é válida
        if ($user && password_verify($password, $user['password'])) {
            // Armazenar informações do usuário na sessão
            $_SESSION['user'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Retornar sucesso e redirecionar para a página apropriada
            return ['success' => true, 'message' => 'Login bem-sucedido', 'redirect' => redirectBasedOnRole($user['role'])];
        } else {
            return ['success' => false, 'message' => 'Nome de usuário/E-mail ou senha incorretos'];
        }
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Erro ao realizar login: ' . $e->getMessage()];
    }
}

// Função auxiliar para redirecionar dependendo da função do usuário
function redirectBasedOnRole($role) {
    switch ($role) {
        case 'montador':
            return 'montador_page.html';
        case 'operador':
            return 'operador_page.html';
        case 'supervisor':
            return 'supervisor_page.html';
        default:
            return 'index.html'; // Padrão
    }
}

// Função de registro
function register($name, $email, $password, $role) {
    global $pdo;

    try {
        // Verificar se o email já está registrado
        $stmt = $pdo->prepare("SELECT 1 FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            return ['success' => false, 'message' => 'Email já registrado'];
        }

        // Criptografar a senha antes de salvar no banco
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Inserir o novo usuário no banco de dados, incluindo a função (role)
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashed_password,
            'role' => $role
        ]);

        // Retornar sucesso em formato JSON
        return ['success' => true, 'message' => 'Cadastro realizado com sucesso'];
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Erro ao registrar: ' . $e->getMessage()];
    }
}

// Verificar se a requisição é POST e tratar login ou registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['action']) && $data['action'] === 'login') {
        // Processo de login
        $login = $data['login']; // Agora pode ser tanto e-mail quanto nome de usuário
        $password = $data['password'];

        // Chamar a função de login
        $result = login($login, $password);

        // Retornar a resposta como JSON
        echo json_encode($result);
        exit(); // Finaliza o script após o retorno do JSON
    } elseif (isset($data['name'], $data['email'], $data['password'], $data['role'])) {
        // Processo de registro
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $role = $data['role'];

        // Chamar a função de registro
        $result = register($name, $email, $password, $role);

        // Retornar a resposta como JSON
        echo json_encode($result);
        exit(); // Finaliza o script após o retorno do JSON
    } else {
        echo json_encode(['success' => false, 'message' => 'Ação não definida ou dados insuficientes.']);
        exit(); // Finaliza o script após o retorno do JSON
    }
}
?>
