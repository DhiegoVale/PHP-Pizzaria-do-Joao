<?php 
include_once("conn.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $type = $_POST['type'];

    $CadPQuery = $conn->prepare("INSERT INTO usuarios(nome, email, senha) VALUES
    (:nome, :email, :senha);");
    $CadPQuery->bindParam(":nome", $nome);
    $CadPQuery->bindParam(":email", $email);
    $CadPQuery->bindParam(":senha", $senha);
    $CadPQuery->execute();
    $user = $CadPQuery->fetch(PDO::FETCH_ASSOC);
    if($user){
    $_SESSION['msg'] = "CADASTRO REALIZADO";
    $_SESSION['status'] = "success";
    header('Location: ../login.php');
        }else{
            $_SESSION['msg'] = "CREDENCIAIS INVALIDAS";
            $_SESSION['status'] = "danger";
            header('Location: ../CadastroP.php');
        } 
}