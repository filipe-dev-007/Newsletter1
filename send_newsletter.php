<?php
// Configurações do e-mail
$to = "teste@localhost"; // E-mail local
$subject = "Assunto da Newsletter"; // Assunto do e-mail
$message = "Olá, esta é uma newsletter de teste!"; // Corpo do e-mail
$headers = "From: teste@localhost" . "\r\n" . // Remetente
           "Reply-To: teste@localhost" . "\r\n" . // E-mail para resposta
           "X-Mailer: PHP/" . phpversion();

// Envia o e-mail
if (mail($to, $subject, $message, $headers)) {
    echo "Newsletter enviada com sucesso!";
} else {
    echo "Erro ao enviar a newsletter.";
}
?>