<?php
$servername = "localhost";
$username = "root";
$password =  "";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if($_POST){
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	$DescMovimento = $_POST['DescMovimento'];
	$DtMovmento = $_POST['DtMovmento'];
	$Valor = $_POST['Valor'];
	$CatDespesas_CodDespesa = $_POST['CatDespesas_CodDespesa'];
	
	$sql = "INSERT INTO movimentos (DescMovimento, DtMovmento, Valor, CatDespesas_CodDespesa)
	VALUES ('$DescMovimento', '$DtMovmento', $Valor, $CatDespesas_CodDespesa)";

	if (mysqli_query($conn, $sql)) {
	  $msg = "Despesa inserida";
	} else {
	  $msg =  "Erro: " . $sql . "<br>" . mysqli_error($conn);
	}

}

$sql = "SELECT * FROM CatDespesas";
$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Olá, mundo!</title>
  </head>
  <body>
	<div class="container">	
		<div class="row">
			<ul class="nav nav-pills">
			  <li class="nav-item">
				<a class="nav-link " href="home.php">Página inicial</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link " href="select.php">Movimentos</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="insert.php">Cadastrar Receita</a>
			  </li>	
			  <li class="nav-item">
				<a class="nav-link active" href="cadastrarDespesa">Cadastrar Despesa</a>
			  </li>

			</ul>
		</div>
		<div class="row">
			<div class="col">		
				<form method="POST">
				  <div class="form-group">
					<label for="descricao">Descrição</label>
					<input type="text" class="form-control" name="DescMovimento" id="descricao" placeholder="Descrição">
				  </div>
				  <div class="form-group">
					<label for="data">Data</label>
					<input type="date" class="form-control" name="DtMovmento" id="data" placeholder="Data">
				  </div>
				  <div class="form-group">
					<label for="valor">Valor</label>
					<input type="text" class="form-control" name="Valor" id="valor" placeholder="Valor">
				  </div>
				  
					<div class="form-group">
						<label for="despesa">Despesa</label>
						<select class="form-control" id="despesa" name="CatDespesas_CodDespesa">
						 <?php
						 
						 if (mysqli_num_rows($result) > 0) {
						  // output data of each row
						  while($row = mysqli_fetch_assoc($result)) {
							echo	 "<option value='".$row["CodDespesa"]."'>" . $row["DescDespesa"]. "</option>";
						  }
						} else {
						  echo "<option>Sem Despesas Cadastradas</option>";
						}

						mysqli_close($conn);
						 ?>
						 
						
						 
						</select>
					  </div>
				 
				  <button type="submit" class="btn btn-primary">Enviar</button>
				</form>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
				<?php 
				if(isset($msg)){
				?>
				<div class="alert alert-success" role="alert">
				  <?=$msg;?>
				</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>