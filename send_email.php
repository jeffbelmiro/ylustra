<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Configurações SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jeffbelmiro@gmail.com'; // Gmail
        $mail->Password = 'oozqoklacpawzfmg'; // Senha ou App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Remetente e destinatário
        $mail->setFrom('empresadelimpeza78@gmail.com', 'BravoClean');
        $mail->addAddress('empresadelimpeza78@gmail.com');

        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = 'Novo contato de cliente do site BravoClean';
        $mail->Body = "
            <h2>Novo Contato Recebido</h2>
            <p><strong>Nome:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Telefone:</strong> $phone</p>
            <p><strong>Mensagem:</strong></p>
            <p>$message</p>
        ";

        $mail->send();
        echo json_encode(["status" => "success", "message" => "Mensagem enviada com sucesso!"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Erro ao enviar a mensagem: {$mail->ErrorInfo}"]);
    }
}
?>
