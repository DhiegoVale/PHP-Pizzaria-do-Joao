<?php
include_once("templates/pizzaHeader.php");
include_once("process/pizza.php");
?>
						<h1 class="h1-center">Cadastre o novo sabor</h1>
                    <div class="container div-login">
					<!-- Input email -->
					<form method="POST" action="process/orders.php" class="email-senha">
						<div class="credEmail">
						<label for="exampleFormControlInput1" class="form-label">Sabor:</label>
							<input type="text" class="form-control" name="nome" id="exampleFormControlInput1" placeholder="Digite o novo sabor:">
						</div>
						<!-- Input Password -->
						<div class="credSenha">
							<label for="inputPassword5" class="form-label">Preço:</label>
							<input type="number" id="inputPassword5" name="preco" class="form-control" placeholder="Digite o preço do sabor:" aria-describedby="passwordHelpBlock">
							<div id="passwordHelpBlock" class="form-text">
						</div><br>
						<button type="submit" name="type" value="cadastro" class="btn btn-warning">Entrar</button>
					    </form>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->