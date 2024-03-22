<?php
include_once("conn.php");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {
  $pedidosQuery = $conn->query("SELECT * FROM pedidos WHERE status_id IN (2,3);");

  $pedidos = $pedidosQuery->fetchAll();
  $pizzas = [];

  //Montar a pizza
  foreach ($pedidos as $pedido) {
    $pizza = [];

    //definir um array para pizza
    $pizza["id"] = $pedido["pizza_id"];

    //RESGATANDO O CLIENTE
    $clienteQuery = $conn->prepare("SELECT nomeC FROM clientes WHERE id = :cliente_id");
    $clienteQuery->bindParam(":cliente_id", $pedido["cliente_id"]);
    $clienteQuery->execute();
    $cliente = $clienteQuery->fetch(PDO::FETCH_ASSOC);
    $pizza["cliente_nome"] = $cliente["nomeC"];

    //RESGATANDO A PIZZA
    $pizzaQuery = $conn->prepare("SELECT * FROM pizzas WHERE id = :pizza_id");
    $pizzaQuery->bindParam(":pizza_id", $pizza["id"]);
    $pizzaQuery->execute();

    //TRAZENDO AS BORDAS E MASSAS VIA PIZZA
    $pizzaData = $pizzaQuery->fetch(PDO::FETCH_ASSOC);

    //RESGATANDO A BORDA
    $bordaQuery = $conn->prepare("SELECT * FROM bordas WHERE id = :borda_id");
    $bordaQuery->bindParam(":borda_id", $pizzaData["borda_id"]);

    $bordaQuery->execute();

    $borda = $bordaQuery->fetch(PDO::FETCH_ASSOC);

    $pizza["borda"] = $borda["tipo"];

    //RESGATANDO MASSA
    $massaQuery = $conn->prepare("SELECT * FROM massas WHERE id = :massa_id");
    $massaQuery->bindParam(":massa_id", $pizzaData["massa_id"]);

    $massaQuery->execute();

    $massa = $massaQuery->fetch(PDO::FETCH_ASSOC);

    $pizza["massa"] = $massa["tipo"];

    //RESGATANDOOSPREÇOS

    //resgatar o preço
    $precoQuery = $conn->prepare("SELECT pzs.sabor_id, sab.preco FROM pizza_sabor AS pzs JOIN sabores AS sab ON pzs.sabor_id = sab.id WHERE pzs.pizza_id = :pizza_id;");
    $precoQuery->bindParam(':pizza_id', $pizza['id']);
    $precoQuery->execute();

    if($precoQuery){
        $precos = $precoQuery->fetchAll(PDO::FETCH_ASSOC);

          $precoTot = 0;

          foreach ($precos as $preco) {
                  $precoTot += $preco['preco'];
        }
        $qtdSabores = count($precos);
        if($qtdSabores > 0){
            $precoTot /= $qtdSabores;
        }
        $pizza['preco_total'] = $precoTot;
      }

    //RESGATANDO OS SABORES

    $saboresQuery = $conn->prepare("SELECT * FROM pizza_sabor WHERE pizza_id = :pizza_id");
    $saboresQuery->bindParam(":pizza_id", $pizza["id"]);

    $saboresQuery->execute();

    $sabores = $saboresQuery->fetchAll(PDO::FETCH_ASSOC);
    //resgatando os nomes dos sabores
    $saboresDaPizza = [];
    $saborQuery = $conn->prepare("SELECT * FROM sabores WHERE id = :sabor_id");

    $saboresDaPizza = [];
    $saborQuery = $conn->prepare("SELECT * FROM sabores WHERE id = :sabor_id");

    foreach ($sabores as $sabor) {
      $saborQuery->bindParam(":sabor_id", $sabor["sabor_id"]);
      $saborQuery->execute();
      $saborPizza = $saborQuery->fetch(PDO::FETCH_ASSOC);
      array_push($saboresDaPizza, $saborPizza["nome"]);
    }
    $pizza["sabores"] = $saboresDaPizza;
    //add o status do pedido
    $pizza["status"] = $pedido["status_id"];
    $pizza['data_p'] = $pedido["data_p"];
    //add o array de pizza no array PIZZAS
    array_push($pizzas, $pizza);


  }
  //echo "<pre>"; print_r($pizzas); echo "</pre>";
  //RESGATAR O STATUS DA PIZZA
  $statusQuery = $conn->query("SELECT * FROM status;");
  $status = $statusQuery->fetchAll();
} else if ($method === "POST") {
  $type = $_POST['type'];
  //deletar o pedido
  if ($type === "delete") {
    $pizza_id = $_POST['id'];
    $deleteQuery = $conn->prepare("DELETE FROM pedidos WHERE pizza_id = :pizza_id;");
    $deleteQuery->bindParam(":pizza_id", $pizza_id, PDO::PARAM_INT);
    $deleteQuery->execute();
    $_SESSION["msg"] = "Pedido deletado com sucesso";
    $_SESSION["status"] = "danger";
  } elseif ($type === "update") {
    $pizza_id = $_POST['id'];
    $status_id = $_POST['status'];
    $updateQuery = $conn->prepare("UPDATE pedidos SET status_id = :status_id WHERE pizza_id = :pizza_id;");

    $updateQuery->bindParam(":status_id", $status_id, PDO::PARAM_INT);

    $updateQuery->bindParam(":pizza_id", $pizza_id, PDO::PARAM_INT);

    $updateQuery->execute();
    $_SESSION["msg"] = "Pedido atualizado com sucesso";
    $_SESSION["status"] = "primary";
  }
  header("Location: ../dashboard.php");
  //Pegar os Preços

}
?>