<?php
$host = "localhost";   // servidor
$user = "root";        // usuário do MySQL
$pass = "";            // senha do MySQL
$db   = "sistema_login"; // nome do banco

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
