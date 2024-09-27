<?php
// Habilita exibição de erros (apenas para desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclui PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'config.php'; // Inclui a conexão com o banco de dados

// Impede que o PHP envie algum conteúdo antes da resposta JSON
ob_start();

header('Content-Type: application/json');

// Função de resposta JSON para padronizar a saída
function jsonResponse($success, $message) {
    echo json_encode(['success' => $success, 'message' => $message]);
    exit; // Encerra a execução para garantir que não haja saída adicional
}

// Verifica se os dados foram enviados em formato JSON
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['email'])) {
    $email = $data['email'];

    // Valida o e-mail recebido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsonResponse(false, 'E-mail inválido.');
    }

    // Gera um token único para a recuperação de senha
    $token = bin2hex(random_bytes(50));

    // Verifica se o e-mail existe no banco de dados
    $query = "SELECT * FROM users WHERE email=:email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Salva o token no banco de dados
        $query = "UPDATE users SET token=:token WHERE email=:email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':email', $email);
        $result = $stmt->execute();

        if ($result) {
            // Envia o e-mail de recuperação de senha
            $mail = new PHPMailer(true);

            try {
                // Configurações do servidor de e-mail
                $mail->isSMTP();
                $mail->Host = 'smtp.hostinger.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'suporte@jduber.com';  // Seu email             
                $mail->Password = 'Luke582279@';            // Senha do aplicativo do Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->CharSet = 'UTF-8';

                // Configurações do remetente e destinatário
                $mail->setFrom('suporte@jduber.com', 'JDUBER Support');
                $mail->addAddress($email); // E-mail do destinatário

                // Conteúdo do e-mail
                $mail->isHTML(true);
                $mail->Subject = 'Redefinição de Senha - JDUBER';
                $mail->Body = '
    <div style="font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4; text-align: center;">
        <div style="max-width: 600px; margin: 0 auto; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
            <img src="https://jduber.com/assets/imagens/favicon.png" alt="JDUBER Logo" style="width: 100px; margin-bottom: 20px;">
            <h2 style="color: #333;">Redefinição de Senha - JDUBER</h2>
            <p style="font-size: 16px; color: #555;">Olá,</p>
            <p style="font-size: 16px; color: #555;">Clique no botão abaixo para redefinir sua senha. Se você não solicitou a redefinição de senha, ignore este e-mail.</p>
            <a href="https://jduber.com/backend_php/mudando_senha.php?token='.$token.'" style="display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">Redefinir Senha</a>
            <p style="font-size: 14px; color: #999; margin-top: 20px;">Se o botão acima não funcionar, copie e cole o seguinte link no seu navegador:</p>
            <p style="font-size: 14px; color: #555;"><a href="https://jduber.com/backend_php/mudando_senha.php?token='.$token.'">https://jduber.com/backend_php/mudando_senha.php?token='.$token.'</a></p>
            <hr style="border: none; border-top: 1px solid #ddd; margin: 40px 0;">
            <p style="font-size: 12px; color: #999;">© 2024 JDUBER. Todos os direitos reservados.</p>
        </div>
    </div>
';


                // Tenta enviar o e-mail
                $mail->send();

                // Retorna uma resposta JSON de sucesso
                jsonResponse(true, 'Um e-mail foi enviado para sua caixa de entrada.');
            } catch (Exception $e) {
                // Retorna uma resposta JSON de erro caso o e-mail falhe
                jsonResponse(false, "Erro ao enviar e-mail: {$mail->ErrorInfo}");
            }
        } else {
            // Retorna uma resposta JSON de erro ao atualizar o token
            jsonResponse(false, 'Erro ao atualizar token no banco de dados.');
        }
    } else {
        // Retorna uma resposta JSON caso o e-mail não exista no banco
        jsonResponse(false, 'E-mail não encontrado.');
    }
} else {
    // Se o e-mail não foi enviado corretamente
    jsonResponse(false, 'E-mail não fornecido.');
}

// Limpa qualquer saída adicional inesperada
ob_end_clean();
