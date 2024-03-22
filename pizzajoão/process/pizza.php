<?php 
include_once("conn.php");

$method =$_SERVER ['REQUEST_METHOD'];

//Resgatando os dados, mointagem do pedido

    if ($method === "GET") {
        $bordasQuery = $conn -> query("SELECT * FROM bordas;");
        $bordas = $bordasQuery->fetchAll();
   

        $massasQuery = $conn -> query("SELECT * FROM massas;");
        $massas = $massasQuery->fetchAll();
    

        $saboresQuery = $conn -> query("SELECT * FROM sabores;");
        $sabores = $saboresQuery->fetchAll();
   }elseif($method === 'POST'){
    $data = $_POST;
    $borda = $data['borda'];
    $massa = $data['massa'];
    $sabores = $data['sabores'];
    $cliente = $data['cliente'];
    //Validação da qtd de sabores
    if(count($sabores) > 4){
        $_SESSION["msg"] = "Selecione no máximo 4 sabores";
        $_SESSION["status"] = "warning";

    }else{
       //SALVANDO AS BORDAS E MASSAS 
       $stmt = $conn->prepare("INSERT INTO pizzas (borda_id, massa_id) VALUES(:borda, :massa)");
    // fILTRAR OS INPUTS
    $stmt->bindParam(":borda",$borda, PDO::PARAM_INT);
    $stmt->bindParam(":massa",$massa, PDO::PARAM_INT);
    $stmt->execute();
    
        //RESGATAR O ÚLTIMO ID DA PIZZA 
        $pizzaId = $conn ->lastInsertId();

        $stmt = $conn ->prepare("INSERT INTO pizza_sabor(pizza_id, sabor_id) VALUES (:pizza,:sabor)");

        //REPETE ATÉ SALVAR TODOS OS VALORES    
         foreach($sabores as $sabor){
            $stmt->bindParam(":pizza", $pizzaId, PDO::PARAM_INT);
            $stmt->bindParam(":sabor", $sabor, PDO::PARAM_INT);
            $stmt->execute();
         }
       
         //CRIAR PEDIDO
         $cliente_id = $cliente;
            $stmt = $conn->prepare("INSERT INTO pedidos (pizza_id, status_id, cliente_id) VALUES (:pizza, :status, :cliente_id)");
            $status_id = 1;
            $stmt->bindParam(":pizza", $pizzaId, PDO::PARAM_INT);
            $stmt->bindParam(":status", $status_id, PDO::PARAM_INT);
            $stmt->bindParam(":cliente_id", $cliente_id, PDO::PARAM_INT);
            $stmt->execute();

        
        //EXIBIR MSG DE SUCESSO
        $_SESSION["msg"] = "Pedido realizado com sucesso";
        $_SESSION["status"] = "success";
        }header("location:..");
    }

         
?>