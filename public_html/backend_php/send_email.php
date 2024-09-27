<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclui os arquivos necessários do PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Inicializa a resposta
$response = array();

if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['message'])) {
    $email = $_POST['email']; // Captura o e-mail enviado pelo formulário
    $name = $_POST['name']; // Captura o nome enviado pelo formulário
    $message = $_POST['message']; // Captura a mensagem

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com'; // Servidor SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'suporte@jduber.com'; // Seu e-mail Hostinger
        $mail->Password   = 'Luke582279@'; // Sua senha do SMTP Hostinger
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Segurança
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8'; // Define o charset como UTF-8

        // Configurações do remetente e destinatário
        $mail->setFrom('suporte@jduber.com', 'JDUBER Support'); // Remetente
        $mail->addAddress('suporte@jduber.com'); // E-mail do destinatário (você receberá o e-mail do formulário)

        // Conteúdo do e-mail com estilo profissional
        $mail->isHTML(true); // Define o e-mail como HTML
        $mail->Subject = 'Contato via Formulário - JDUBER';
        $mail->Body    = '
            <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; border-radius: 10px; background-color: #f9f9f9;">
                <h2 style="color: #333; text-align: center;">Novo Contato via Formulário - JDUBER</h2>
                <p style="font-size: 16px; color: #555;">
                    <strong>Nome:</strong> ' . htmlspecialchars($name) . '<br>
                    <strong>Email:</strong> ' . htmlspecialchars($email) . '<br>
                    <strong>Mensagem:</strong> ' . nl2br(htmlspecialchars($message)) . '
                </p>
                <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
                <p style="font-size: 14px; color: #999; text-align: center;">
                    © 2024 JDUBER. Todos os direitos reservados.
                </p>
            </div>
        ';

        // Envia o e-mail
        if ($mail->send()) {
            // Resposta de sucesso
            $response['status'] = 'success';
            $response['message'] = 'E-mail enviado com sucesso.';
        } else {
            // Resposta de erro se o e-mail não for enviado
            $response['status'] = 'error';
            $response['message'] = 'O e-mail não pôde ser enviado.';
        }
    } catch (Exception $e) {
        // Captura erros do PHPMailer e retorna
        $response['status'] = 'error';
        $response['message'] = "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
} else {
    // Se os dados necessários não forem enviados pelo formulário
    $response['status'] = 'error';
    $response['message'] = 'Por favor, preencha todos os campos do formulário.';
}

// Retorna a resposta em formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
