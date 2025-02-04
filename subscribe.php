<?php
$servername = "localhost";
$username = "root"; // Usuário padrão do XAMPP
$password = ""; // Senha padrão do XAMPP (vazia)
$dbname = "newlestter_db";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Pegar o email do formulário
$email = $_POST['email'];

// Inserir no banco de dados
$sql = "INSERT INTO subscribers (email) VALUES ('$email')";

if ($conn->query($sql) === TRUE) {
    echo "Inscrição realizada com sucesso!";
} else {
    if ($conn->errno == 1062) { // Código de erro para email duplicado
        echo "Este email já está inscrito.";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>