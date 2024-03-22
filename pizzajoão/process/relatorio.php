<?php
include_once("conn.php");

//Nº de VENDAS
$vendasQuery = $conn->prepare("SELECT sab.nome AS sabor, COUNT(pzs.sabor_id) AS total_vendido
FROM pizza_sabor AS pzs
JOIN sabores AS sab ON pzs.sabor_id = sab.id
GROUP BY pzs.sabor_id
ORDER BY total_vendido DESC;");
$vendasQuery->execute();
$vendas = $vendasQuery->fetchAll();

//QTD de pizzas vendidas por nº sabor
$sabPizzaQuery = $conn->prepare("SELECT 
quantidade_sabores,
COUNT(*) AS total_pizzas
FROM (
SELECT 
    CASE
        WHEN COUNT(DISTINCT sabor_id) = 1 THEN '1 sabor'
        WHEN COUNT(DISTINCT sabor_id) = 2 THEN '2 sabores'
        WHEN COUNT(DISTINCT sabor_id) = 3 THEN '3 sabores'
        WHEN COUNT(DISTINCT sabor_id) = 4 THEN '4 sabores'
    END AS quantidade_sabores,
    pizza_id
FROM pizza_sabor
GROUP BY pizza_id
) AS pizzas_agrupadas
GROUP BY quantidade_sabores;");
$sabPizzaQuery->execute();
$pizzasPorSabores = $sabPizzaQuery->fetchAll();

//valor de pizzas por mês
$pizzaMesQuery = $conn->prepare("SELECT 
DATE_FORMAT(data_p, '%Y-%m') AS mes,
SUM(
    (SELECT SUM(sabores.preco) / COUNT(pizza_sabor.sabor_id)
    FROM pizza_sabor
    JOIN sabores ON pizza_sabor.sabor_id = sabores.id
    WHERE pizza_sabor.pizza_id = pizzas.id)
) AS valor_total_mes
FROM pedidos
JOIN pizzas ON pedidos.pizza_id = pizzas.id
GROUP BY mes;");
$pizzaMesQuery->execute();

$pizzaMes = $pizzaMesQuery->fetchAll();