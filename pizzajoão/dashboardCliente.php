<?php
  include_once("templates/header.php");
  include_once("process/ordersC.php");
  include_once("process/loginCad.php");
  

?>
  <div id="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Gerenciar pedidos:</h2>
        </div>
        <div class="col-md-12 table-container">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col"><span>Nº Do Cliente</span> #</th>
                <th scope="col">Nome Completo</th>
                <th scope="col">Email</th>
                <th scope="col">Rua</th>
                <th scope="col">Nº da Casa</th>
                <th scope="col">Bairro</th>
                <th scope="col">Num de Pedidos</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($clientes as $cliente): ?>
                <tr>
                  <td><?= $cliente["id"] ?></td>
                  <td><?= $cliente["nomeC"] ?></td>
                  <td><?= $cliente["emailC"] ?></td>
                  <td><?= $cliente["rua"] ?></td>
                  <td><?= $cliente["numero"] ?></td>
                  <td><?= $cliente["bairro"] ?></td>
                  <td><?php 
    // Busca o número de pedidos correspondente ao cliente atual
    $cliente_id = $cliente["id"];
    $quantidade_pedidos = 0;
    foreach ($numPedidos as $numPedido) {
        if ($numPedido["id_cliente"] == $cliente_id) {
            $quantidade_pedidos = $numPedido["quantidade_pedidos"];
            break;
        }
    }
    echo $quantidade_pedidos;
    ?></td>
                  <td>
                  </td>
                  <td>
                    <form action="process/ordersC.php" method="POST">
                      <input type="hidden" name="type" value="deleteC">
                      <input type="hidden" name="id" value="<?= $cliente["id"] ?>">
                      <button type="submit" class="delete-btn" onclick ='return deletar()'>
                        <i class="fas fa-times"></i>
                      </button>
                    </form>
                  </td>
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
<script>
    function deletar(){
    let resposta = confirm("Você deseja realmente apagar esse cliente?");
    if (resposta === true) { 
        return true;
    } 
    else {
        return false;
    }
}

</script>