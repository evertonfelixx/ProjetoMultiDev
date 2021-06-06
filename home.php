<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Video</title>
  </head>
  <body>
	<div class="container">
		<div class="row">
			<ul class="nav nav-pills">
			  <li class="nav-item">
				<a class="nav-link active" href="home.php">Página inicial</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link " href="select.php">Movimentos</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="insert.php">Cadastrar Receita</a>
			  </li>	
			  <li class="nav-item">
				<a class="nav-link" href="cadastrarDespesa">Cadastrar Despesa</a>
			  </li>

			</ul>
		</div>
		<div class="row">
			<?php
			$sql = "SELECT SUM(Valor) FROM `movimentos` WHERE `CatReceitas_CodReceita` is NOT null";
			$result = mysqli_query($conn, $sql);
			$receitas = mysqli_fetch_array($result);
			$receita = $receitas[0];
			?>
			
			<div class="alert alert-success" role="alert">
				Receitas: R$ <?=$receita; ?>
			</div>
		
		</div>
		<div class="row">
			<?php
			$sql = "SELECT SUM(Valor) FROM `movimentos` WHERE `CatDespesas_CodDespesa` is NOT null";
			$result = mysqli_query($conn, $sql);
			$despesas = mysqli_fetch_array($result);
			$despesa = $despesas[0];
			?>
			
			<div class="alert alert-danger" role="alert">
				Despesas: R$ <?=$despesa; ?>
			</div>
		
		</div>
		<div class="row">
			<?php
			if($receita>$despesa){
				$saldo = $receita - $despesa;
				?>
				<div class="alert alert-success" role="alert">
					Saldo: R$ <?=$saldo; ?>
				</div>
				<?php
			}else{
				$saldo = $receita - $despesa;
				?>
				<div class="alert alert-danger" role="alert">
					Saldo: R$ <?=$saldo; ?>
				</div>
				<?php
			}
			?>
		</div>
		
	</div>
	
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
<?php

mysqli_close($conn);

?>