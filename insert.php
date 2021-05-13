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

if($_POST){
	$DescMovimento = $_POST["DescMovimento"];
	$DtMovmento = $_POST["DtMovmento"];
	$Valor = $_POST["Valor"];
	$CatReceitas_CodReceita = $_POST["CatReceitas_CodReceita"];
	
	$sql = "INSERT INTO movimentos (DescMovimento, DtMovmento, Valor, CatReceitas_CodReceita)
	VALUES ('$DescMovimento', '$DtMovmento', $Valor, $CatReceitas_CodReceita)";

	if (mysqli_query($conn, $sql)) {
	  $msg = "Inserido com sucesso";
	} else {
	  $msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
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

    <title>Insert</title>
  </head>
  <body>
 <div class="container">
 <?php
 if(isset($msg)){
 echo "
 <div class='alert alert-success' role='alert'>
	$msg
 </div>";
 }
 ?>
  <div class="row">
    <div class="col-sm">
	<form method="post">
	  <div class="form-group">
		<label for="descricao">Descrição</label>
		<input type="text" class="form-control" id="descricao" name="DescMovimento" />
	  </div>
	  <div class="form-group">
		<label for="data">Data</label>
		<input type="date" class="form-control" id="data" name="DtMovmento" />
	  </div>
	  <div class="form-group">
		<label for="valor">Valor</label>
		<input type="text" class="form-control" id="valor" name="Valor" />
	  </div>
	  <div class="form-group">
		<label for="Receita">Receita</label>
		<select class="form-control" id="Receita" name="CatReceitas_CodReceita">
		
		<?php
		$sql = "SELECT * FROM catreceitas";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				echo "<option value='".$row['CodReceita']."'>".$row['DescReceita']."</option>";
			}
		}
		?>		
		  
		  
		</select>
	  </div>
	  
	   <button type="submit" class="btn btn-primary">Enviar</button>
	</form>
	
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