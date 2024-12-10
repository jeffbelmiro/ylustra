<?php
// Inclui o autoload do Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Verifique o caminho do autoload

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Configurações do servidor SMTP
    $mail = new PHPMailer(true);
    try {
        // Configuração do servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Servidor SMTP do Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'jeffbelmiro@gmail.com'; // Seu endereço Gmail
        $mail->Password = 'oozqoklacpawzfmg'; // Sua senha do Gmail ou App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Criptografia SSL
        $mail->Port = 465;

        // Remetente e destinatário
        $mail->setFrom('empresadelimpeza78@gmail.com', 'BravoClean'); // Seu email e nome
        $mail->addAddress('empresadelimpeza78@gmail.com'); // Email do destinatário

        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = 'Novo contato do site BravoClean';
        $mail->Body = "
            <h2>Novo Contato Recebido</h2>
            <p><strong>Nome:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Telefone:</strong> $phone</p>
            <p><strong>Mensagem:</strong></p>
            <p>$message</p>
        ";

        // Enviar email
        $mail->send();
        echo "Mensagem enviada com sucesso!";
    } catch (Exception $e) {
        echo "Erro ao enviar a mensagem: {$mail->ErrorInfo}";
    }
    $mail->SMTPDebug = 2; // Exibe detalhes sobre o envio no console
    $mail->Debugoutput = 'html'; // Formata a saída como HTML
}
?>
