<?php 
include_once("conn.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $type = $_POST['type'];

    //LOGIN
    if ($type == "login"){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $loginQuery = $conn->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha;");
        $loginQuery->bindParam(":email", $email);
        $loginQuery->bindParam(":senha", $senha);
        $loginQuery->execute();
        $user = $loginQuery->fetch(PDO::FETCH_ASSOC);

        if($user){
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['msg'] = "LOGIN REALIZADO";
            $_SESSION['status'] = "success";
            header('Location: ../index.php');
        }else{
            $_SESSION['msg'] = "CREDENCIAIS INVALIDAS";
            $_SESSION['status'] = "danger";
            header('Location: ../login.php');
        }
        }

        //CADASTRO

        if ($type == "cadastroP"){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $CadPQuery = $conn->prepare("INSERT INTO usuarios(nome, email, senha) VALUES
            (:nome, :email, :senha);");
            $CadPQuery->bindParam(":nome", $nome);
            $CadPQuery->bindParam(":email", $email);
            $CadPQuery->bindParam(":senha", $senha);
            $CadPQuery->execute();
            $user = $CadPQuery->fetch(PDO::FETCH_ASSOC);
            
            
            $_SESSION['msg'] = "CADASTRO REALIZADO";
            $_SESSION['status'] = "success";
            header('Location: ../login.php');
            }
            if ($type == 'cadastroC') {
                $nomeC = $_POST['nomeC'];
                $emailC = $_POST['emailC'];
                $rua = $_POST['rua'];
                $numero = $_POST['num'];
                $bairro = $_POST['bairro'];
            
                // Verifica se o cliente já existe antes de cadastrar novamente
                $verificaClienteQuery = $conn->prepare("SELECT id FROM clientes WHERE emailC = :emailC");
                $verificaClienteQuery->bindParam(":emailC", $emailC);
                $verificaClienteQuery->execute();
                $clienteExiste = $verificaClienteQuery->fetch(PDO::FETCH_ASSOC);
            
                if ($clienteExiste) {
                    $_SESSION['msg'] = "Cliente já cadastrado!";
                    $_SESSION['status'] = "danger";
                    header('Location: ../index.php');
                    exit();
                }
            
                // Cadastro do Cliente
                $CadCQuery = $conn->prepare("INSERT INTO clientes(nomeC, emailC) VALUES (:nomeC, :emailC);");
                $CadCQuery->bindParam(":nomeC", $nomeC);
                $CadCQuery->bindParam(":emailC", $emailC);
                $CadCQuery->execute();
            
                $idC = $conn->lastInsertId();
            
                // Cadastro do Endereço
                $CadEQuery = $conn->prepare("INSERT INTO enderecos(rua, numero, bairro, id_cliente) VALUES (:rua, :numero, :bairro, :id_cliente);");
                $CadEQuery->bindParam(":rua", $rua);
                $CadEQuery->bindParam(":numero", $numero);
                $CadEQuery->bindParam(":bairro", $bairro);
                $CadEQuery->bindParam(":id_cliente", $idC);
                $CadEQuery->execute();
            
                $_SESSION['msg'] = "CLIENTE CADASTRADO!";
                $_SESSION['status'] = "success";
                header('Location: ../index.php');
                exit();
            }
            }
    