<?php

include_once("conn.php");

function obterTodosClientesComEnderecos() {
    global $conn;

    $clienteQuery = $conn->prepare("SELECT clientes.*, enderecos.rua, enderecos.numero, enderecos.bairro 
                            FROM clientes 
                            LEFT JOIN enderecos ON clientes.id = enderecos.id_cliente;");
    $clienteQuery->execute();

    // Obtém todos os clientes com endereços
    $clientes = $clienteQuery->fetchAll(PDO::FETCH_ASSOC);

    // Retorna os clientes
    return $clientes;
}
$clientes = obterTodosClientesComEnderecos();
function obterNumDePedidos(){
    global $conn;

    $pedQuery = $conn->prepare("SELECT clientes.id AS id_cliente, clientes.nomeC AS nome_cliente, COUNT(pedidos.id) AS quantidade_pedidos
    FROM clientes
    LEFT JOIN pedidos ON clientes.id = pedidos.cliente_id
    GROUP BY clientes.id, clientes.nomeC
    ORDER BY quantidade_pedidos DESC;
    ");
    $pedQuery->execute();

    // Obtém todos os clientes com endereços
    $numPedidos = $pedQuery->fetchAll(PDO::FETCH_ASSOC);

    // Retorna os clientes
    return $numPedidos;
}

$numPedidos = obterNumdePedidos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];

    if ($type === "deleteC") {
        $cliente_id = $_POST['id'];

        $deleteECQuery = $conn->prepare("DELETE FROM enderecos WHERE id_cliente = :cliente_id;");
        $deleteECQuery->bindParam(":cliente_id", $cliente_id, PDO::PARAM_INT);
        $deleteECQuery->execute();

        $deletePedidosQuery = $conn->prepare("DELETE FROM pedidos WHERE cliente_id = :cliente_id");
        $deletePedidosQuery->bindParam(":cliente_id", $cliente_id, PDO::PARAM_INT);
        $deletePedidosQuery->execute();
        
        $deleteCQuery = $conn->prepare("DELETE FROM clientes WHERE id = :cliente_id;");
        $deleteCQuery->bindParam(":cliente_id", $cliente_id, PDO::PARAM_INT);
        $deleteCQuery->execute();


        $_SESSION["msg"] = "Cliente deletado com sucesso";
        $_SESSION["status"] = "danger";
        header("Location: ../dashboardCliente.php");
        exit(); // Encerra o script após o redirecionamento
    }
}
?>
