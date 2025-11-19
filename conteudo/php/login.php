<?php
session_start();
include("conexao.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/login.html');
    exit();
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['senha'] ?? '';

if ($email === '' || $password === '') {
    echo "Preencha todos os campos.";
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "E-mail inválido.";
    exit();
}

$sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Erro na preparação: " . $conn->error;
    exit();
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        // guarda o usuário na sessão
        $_SESSION['usuario'] = $user['email'];
        // redireciona para inicial.html
        header("Location: ../html/inicial.html");
        exit();
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Usuário não encontrado.";
}
?>
