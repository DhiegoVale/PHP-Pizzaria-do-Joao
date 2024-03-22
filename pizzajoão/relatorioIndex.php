    <?php
    include_once("templates/header.php");
    include_once("process/orders.php");
    include_once("process/relatorio.php");
    include_once("loginverificacao.php");

    ?>

    <div id="main-container">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h2>Relatórios:</h2>
            <h3>Valor Vendido por Mês:</h4>
            <div class="col-md-12 table-container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Mês</th>
                    <th scope="col">Valor Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($pizzaMes as $pzm): ?>
                    <tr>
                    <td><?= $pzm["mes"] ?></td>
                    <td><?= $pzm["valor_total_mes"] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h4>Tabela dos Sabores mais Vendidos:</h3>
            </div>
            <div class="col-md-12 table-container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Sabores</th>
                    <th scope="col">Nº de Vendas</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($vendas as $venda): ?>
                    <tr>
                    <td><?= $venda["sabor"] ?></td>
                    <td><?= $venda["total_vendido"] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h5>Qual a Quantidade de Sabores das Pizzas Mais Vendidas:</h4>
            <div class="col-md-12 table-container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Nº de Pizzas Vendidas</th>
                    <th scope="col">Qtd de Sabores da Pizza</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($pizzasPorSabores as $pzs): ?>
                    <tr>
                    <td><?= $pzs["total_pizzas"] ?></td>
                    <td><?= $pzs["quantidade_sabores"] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    <?php
    include_once("templates/footer.php");
    ?>