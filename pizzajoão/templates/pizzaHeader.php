<?php
include("process/conn.php");
$msg = "";

if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    $status = $_SESSION['status'];
    //limpar a msg
    $_SESSION['msg'] = "";
    $_SESSION['status'] = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--atividade (icon)-->
    <link rel="shortcut icon" type="image/jpg" href="img/pizza.favicon-removebg-preview.ico" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzaria do João</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="pizza-bg">
    <header>
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="index.php">
                <img src="img/draw.svg" id="brand-logo">
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- LISTA DE PRODUTOS -->
                <ul class="navbar-nav">
                    <li class="nav item active">
                        <a href="index.php" class="nav-link">
                            PEÇA SUA PIZZA!
                        </a>
                    </li>
                </ul>
            </div>
            <!-- NAVBAR (PEDIDO E DASHBOARD)-->
            <nav class="">
                <form class="justify-content-right">
                    <button class="btn btn-sm btn-outline-primary" type="button">Pedido</button>
                    <a href="dashboard.php"><button class="btn btn-sm btn-outline-secondary" type="button">Dashboard</button></a>
                    <a href="cadastro.php"><button class="btn btn-sm btn-outline-secondary" type="button">Cadastrar</button></a>
                </form>
            </nav>
        </nav>
    </header>
    <?php
    if ($msg != ""): ?>
        <div class="alert alert-<?= $status ?>">
            <p>
                <?= $msg ?>
            </p>
        </div>
    <?php endif; ?>