<?php
include "conexao.php";

// Verifica se os dados foram enviados
if (!isset($_POST['usuario'], $_POST['senha'], $_POST['confirmar_senha'])) {
    die("Preencha todos os campos.");
}

$usuario = trim($_POST['usuario']);
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar_senha'];

// Verifica se está vazio
if (empty($usuario) || empty($senha) || empty($confirmar)) {
    die("Todos os campos são obrigatórios.");
}

// Verifica se as senhas são iguais
if ($senha !== $confirmar) {
    die("As senhas não coincidem!");
}

// Verifica se o usuário já existe
$sql_check = "SELECT id FROM usuarios WHERE usuario = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $usuario);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    die("Usuário já existe!");
}

// Criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Insere no banco
$sql = "INSERT INTO usuarios (usuario, senha) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro no prepare: " . $conn->error);
}

$stmt->bind_param("ss", $usuario, $senhaHash);

// Executa
if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

// Fecha conexões
$stmt->close();
$stmt_check->close();
$conn->close();
?>