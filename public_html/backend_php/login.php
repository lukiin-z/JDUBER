<?php
// Iniciar o buffer de saída para evitar problemas com header
ob_start();

// Incluir o arquivo de configuração para conectar ao banco de dados
include('config.php');

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para buscar o usuário pelo email
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário foi encontrado
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verifica se a senha está correta
        if (password_verify($password, $user['password'])) {
            // Verificar o papel do usuário (role)
            $role = $user['role'];

            // Redireciona para a página correta baseado na função
            if ($role == 'montador') {
                header('Location: montador_page.html');
            } elseif ($role == 'operador') {
                header('Location: operador_page.html');
            } elseif ($role == 'supervisor') {
                header('Location: supervisor_page.html');
            } else {
                echo "Função desconhecida!";
            }
            exit();
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
}

// Finalizar o buffer de saída
ob_end_flush();
?>
