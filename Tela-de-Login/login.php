<?php
session_start();
include "conexao.php";

// Verifica se os dados foram enviados
if (!isset($_POST['usuario'], $_POST['senha'])) {
    die("Preencha todos os campos.");
}

$usuario = trim($_POST['usuario']);
$senha = $_POST['senha'];

// Verifica se está vazio
if (empty($usuario) || empty($senha)) {
    die("Todos os campos são obrigatórios.");
}

// Busca o usuário no banco
$sql = "SELECT id, usuario, senha FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro no prepare: " . $conn->error);
}

$stmt->bind_param("s", $usuario);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();

    // Verifica a senha criptografada
    if (password_verify($senha, $user['senha'])) {

        // Cria sessão
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nome'] = $user['usuario'];

        // Redireciona (você pode trocar depois)
        header("Location: dashboard.php");
        exit;

    } else {
        echo "Senha incorreta!";
    }

} else {
    echo "Usuário não encontrado!";
}

// Fecha conexões
$stmt->close();
$conn->close();
?>