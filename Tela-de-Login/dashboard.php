<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.html");
    exit;
}

echo "Bem-vindo, " . $_SESSION['usuario_nome'];
?>