<?php
session_start();

// Proteção
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.html");
    exit();
}

$usuario = $_SESSION['usuario_nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<h1>Bem-vindo, <?php echo htmlspecialchars($usuario); ?> 👋</h1>

<script>
const params = new URLSearchParams(window.location.search);

// Mensagem de login
if (params.get("msg") === "login") {
    alert("Login realizado! Bem-vindo, <?php echo $usuario; ?>");
}
</script>

</body>
</html>
