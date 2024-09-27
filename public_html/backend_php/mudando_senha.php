<?php
require 'config.php'; // Inclui a conexão com o banco de dados

// Função para exibir mensagens de erro/sucesso em formato de pop-up
function exibirMensagemPopup($mensagem, $tipo = 'erro') {
    $cor = ($tipo == 'sucesso') ? '#28a745' : '#dc3545'; // Verde para sucesso, vermelho para erro
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                const popup = document.createElement('div');
                popup.innerHTML = '<p>$mensagem</p>';
                popup.style.position = 'fixed';
                popup.style.top = '50%';
                popup.style.left = '50%';
                popup.style.transform = 'translate(-50%, -50%)';
                popup.style.backgroundColor = '$cor';
                popup.style.color = '#fff';
                popup.style.padding = '20px';
                popup.style.borderRadius = '10px';
                popup.style.zIndex = '1000';
                popup.style.textAlign = 'center';
                popup.style.opacity = '0'; // Inicialmente invisível
                popup.style.transition = 'opacity 0.5s'; // Animação de transição
                document.body.appendChild(popup);
                setTimeout(function() {
                    popup.style.opacity = '1'; // Aparecer suavemente
                }, 10);
                setTimeout(function() {
                    popup.style.opacity = '0'; // Desaparecer suavemente
                    setTimeout(function() {
                        popup.remove(); // Remove o pop-up após o desaparecimento
                    }, 500);
                }, 3000);
            });
          </script>";
}

// Verifica se o token foi passado via URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verifica se o token é válido no banco de dados
    $query = "SELECT * FROM users WHERE token = :token";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Se o formulário de nova senha foi enviado
        if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            // Verifica se as senhas são iguais
            if ($new_password === $confirm_password) {
                // Hash da nova senha
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Atualiza a senha no banco de dados e remove o token
                $query = "UPDATE users SET password = :password, token = NULL WHERE token = :token";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->bindParam(':token', $token);
                $stmt->execute();

                // Exibe a mensagem de sucesso com o pop-up
                exibirMensagemPopup('Senha redefinida com sucesso! Redirecionando...', 'sucesso');
                echo "<script>
                        setTimeout(function() {
                            window.location.href = '/login.html';
                        }, 3000); // Redireciona após 3 segundos
                      </script>";
            } else {
                // Senhas não correspondem, exibe um erro
                exibirMensagemPopup('As senhas não coincidem. Tente novamente!');
            }
        }
    } else {
        // Token inválido ou expirado
        exibirMensagemPopup('Token inválido ou expirado!');
        exit;
    }
} else {
    // Nenhum token fornecido
    exibirMensagemPopup('Nenhum token fornecido!');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            transition: background-color 0.3s; /* Transição para tema escuro/claro */
        }
        .container {
            background-color: #fff;
            width: 400px;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .container h2 {
            margin-bottom: 20px;
        }
        .container form {
            display: flex;
            flex-direction: column;
        }
        .container form label {
            font-size: 14px;
            margin-bottom: 5px;
            text-align: left;
        }
        .container form input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .container form button {
            padding: 10px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .container form button:hover {
            background-color: #333;
        }
        .back-to-login {
            text-align: center;
            margin-top: 15px;
        }
        .back-to-login a {
            color: #000;
            text-decoration: none;
            font-weight: bold;
        }
        .back-to-login a:hover {
            text-decoration: underline;
        }

        /* Indicador de força da senha */
        .password-strength {
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Redefinir sua senha</h2>
    <form action="" method="post" onsubmit="return validarSenhas()">
        <label for="new_password">Nova Senha:</label>
        <input type="password" id="new_password" name="new_password" required placeholder="Digite sua nova senha" onkeyup="verificarForcaSenha()">
        <span class="password-strength" id="password-strength"></span>
        
        <label for="confirm_password">Confirme a Senha:</label>
        <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirme sua nova senha">
        
        <button type="submit">Redefinir Senha</button>
    </form>
    <div class="back-to-login">
        <a href="/login.html">Voltar para Login</a>
    </div>
</div>

<script>
    // Validação de senhas no frontend
    function validarSenhas() {
        var senha = document.getElementById('new_password').value;
        var confirmacao = document.getElementById('confirm_password').value;
        if (senha !== confirmacao) {
            alert('As senhas não coincidem!');
            return false;
        }
        return true;
    }

    // Indicador de força da senha
    function verificarForcaSenha() {
        var senha = document.getElementById('new_password').value;
        var strengthText = document.getElementById('password-strength');
        if (senha.length < 6) {
            strengthText.innerText = 'Fraca';
            strengthText.style.color = 'red';
        } else if (senha.length < 10) {
            strengthText.innerText = 'Média';
            strengthText.style.color = 'orange';
        } else {
            strengthText.innerText = 'Forte';
            strengthText.style.color = 'green';
        }
    }

    // Alerta de confirmação ao tentar sair da página
    window.onbeforeunload = function() {
        return 'Você tem certeza que deseja sair? As alterações podem não ser salvas.';
    };
</script>

</body>
</html>
