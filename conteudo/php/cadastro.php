<?php
session_start();
include("conexao.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/cadastro.html');
    exit();
}

$nome = trim($_POST['nome'] ?? '');
$sobrenome = trim($_POST['sobrenome'] ?? '');
$email = trim($_POST['email'] ?? '');
$password_raw = $_POST['password'] ?? '';

if ($nome === '' || $sobrenome === '' || $email === '' || $password_raw === '') {
    echo "Preencha todos os campos.";
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "E-mail inválido.";
    exit();
}

$password = password_hash($password_raw, PASSWORD_DEFAULT);

// checar se e-mail já existe
$checkSql = "SELECT id FROM usuarios WHERE email = ? LIMIT 1";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("s", $email);
$checkStmt->execute();
$checkRes = $checkStmt->get_result();
if ($checkRes && $checkRes->num_rows > 0) {
    echo "Erro: E-mail já cadastrado.";
    exit();
}

// inserir novo usuário
$sql = "INSERT INTO usuarios (email, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);

if ($stmt->execute()) {
    // redirecionar para a página de login existente
    header("Location: ../html/login.html");
    exit();
} else {
    echo "Erro: " . $stmt->error;
}
?>
