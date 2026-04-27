e<?php
include "conexao.php";

// Verifica se os dados foram enviados
if (!isset($_POST['usuario'], $_POST['senha'], $_POST['confirmar_senha'])) {
    header("Location: cadastro.html?erro=campos");
    exit();
}

$usuario = trim($_POST['usuario']);
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar_senha'];

// Verifica se está vazio
if (empty($usuario) || empty($senha) || empty($confirmar)) {
    header("Location: cadastro.html?erro=vazio");
    exit();
}

// Verifica se as senhas são iguais
if ($senha !== $confirmar) {
    header("Location: cadastro.html?erro=senha");
    exit();
}

// Verifica se o usuário já existe
$sql_check = "SELECT id FROM usuarios WHERE usuario = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $usuario);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    header("Location: cadastro.html?erro=existe");
    exit();
}

// Criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Insere no banco
$sql = "INSERT INTO usuarios (usuario, senha) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: cadastro.html?erro=sql");
    exit();
}

$stmt->bind_param("ss", $usuario, $senhaHash);

// Executa
if ($stmt->execute()) {
    // VOLTA PRO LOGIN COM MENSAGEM
    header("Location: index.html?msg=cadastro_sucesso");
    exit();
} else {
    header("Location: cadastro.html?erro=cadastro");
    exit();
}

// Fecha conexões
$stmt->close();
$stmt_check->close();
$conn->close();
?>
