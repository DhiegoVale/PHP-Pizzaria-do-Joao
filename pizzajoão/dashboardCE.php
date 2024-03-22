<?php
  include_once("templates/header.php");
  include_once("process/orders2.php");
  include_once("process/ordersC.php");
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
                <th scope="col"><span>Pedido</span> #</th>
                <th scope="col">Borda</th>
                <th scope="col">Massa</th>
                <th scope="col">Sabores</th>
                <th scope="col">Status</th>
                <th scope="col">Ações</th>
                <th scope="col">Data</th>
                <th scope="col">Cliente</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($pizzas as $pizza): ?>
                <tr>
                  <td><?= $pizza["id"] ?></td>
                  <td><?= $pizza["borda"] ?></td>
                  <td><?= $pizza["massa"] ?></td>
                  
                  <td>
                    <ul>
                      <?php foreach($pizza["sabores"] as $sabor): ?>
                        <li><?= $sabor ;?></li>
                      <?php endforeach; ?>
                    </ul>
                  </td>
                  <td>
                    <form action="process/orders.php" method="POST" class="form-group update-form">
                      <input type="hidden" name="type" value="update">
                      <input type="hidden" name="id" value="<?= $pizza["id"] ?>">
                      <select name="status" class="form-control status-input">
                        <?php foreach($status as $s): ?>
                          <option value="<?= $s["id"] ?>" <?php echo ($s["id"] == $pizza["status"]) ? "selected" : ""; ?> ><?= $s["tipo"] ?></option>
                        <?php endforeach; ?>
                      </select>
                      <button type="submit" class="update-btn">
                        <i class="fas fa-sync-alt"></i>
                      </button>
                    </form>
                  </td>
                  <td>
                    <form action="process/orders.php" method="POST">
                      <input type="hidden" name="type" value="delete">
                      <input type="hidden" name="id" value="<?= $pizza["id"] ?>">
                      <button type="submit" class="delete-btn">
                        <i class="fas fa-times"></i>
                      </button>
                    </form>
                  </td>
                  <td>
                  <?php
                  if (isset($pizza['data_p']) && !empty($pizza['data_p'])) {
                    echo date('d/m/Y \à\s H:i', strtotime($pizza['data_p']));
                  } else {
                    echo 'N/A';
                  }
                  ?>
                  </td>
                  <td>
                    <?php echo "R$ ", number_format($pizza['preco_total'], 2); ?>
                  </td>
                  <td>
                    <?php echo $pizza['cliente_nome'];?>
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