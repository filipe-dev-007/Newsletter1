<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = ""; // Senha do MySQL (vazia por padrão no XAMPP)
$dbname = "newlestter_db";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Processar o envio da newsletter
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject']; // Assunto do email
    $message = $_POST['message']; // Conteúdo da newsletter

    // Buscar todos os emails dos inscritos
    $sql = "SELECT email FROM subscribers";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $to = $row['email'];
            $headers = "From: seuemail@example.com\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            // Enviar o email
            mail($to, $subject, $message, $headers);
        }
        echo "<div class='alert alert-success'>Newsletter enviada com sucesso!</div>";
    } else {
        echo "<div class='alert alert-warning'>Nenhum inscrito encontrado.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Newsletter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Enviar Newsletter</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="subject" class="form-label">Assunto</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensagem</label>
                <textarea class="form-control" id="message" name="message" rows="10" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar Newsletter</button>
        </form>
    </div>
</body>
</html>