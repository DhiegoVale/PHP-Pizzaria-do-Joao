<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION["msg"] = "Você precisa estar logado para acessar esta página.";
    $_SESSION["status"] = "danger";
    header("Location: login.php");
    exit();
}
?>