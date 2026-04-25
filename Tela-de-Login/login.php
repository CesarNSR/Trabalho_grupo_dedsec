<?php
session_start();
include "conexao.php";

// Verifica envio
if (!isset($_POST['usuario'], $_POST['senha'])) {
    header("Location: index.html?erro=campos");
    exit();
}

$usuario = trim($_POST['usuario']);
$senha = $_POST['senha'];

if (empty($usuario) || empty($senha)) {
    header("Location: index.html?erro=campos");
    exit();
}

// Busca usuário
$sql = "SELECT id, usuario, senha FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: index.html?erro=servidor");
    exit();
}

$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();

    if (password_verify($senha, $user['senha'])) {

        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nome'] = $user['usuario'];

        // 🔥 REDIRECIONA COM MENSAGEM
        header("Location: dashboard.php?msg=login");
        exit();

    } else {
        header("Location: index.html?erro=senha");
        exit();
    }

} else {
    header("Location: index.html?erro=usuario");
    exit();
}

$stmt->close();
$conn->close();
?>