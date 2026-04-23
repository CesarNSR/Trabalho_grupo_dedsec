<?php
include "conexao.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar_senha'];

if ($senha != $confirmar) {
    echo "As senhas não coincidem!";
    exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senhaHash);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar";
}