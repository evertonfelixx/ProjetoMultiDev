<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Select</title>
  </head>
  <body>
 <div class="container">
  <div class="row">
    <div class="col-sm">
    
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

$sql = "SELECT movimentos.*, catreceitas.DescReceita as receita, catdespesas.DescDespesa as despesa 
FROM movimentos LEFT JOIN catreceitas ON movimentos.CatReceitas_CodReceita = catreceitas.CodReceita
LEFT JOIN catdespesas ON movimentos.CatDespesas_CodDespesa = catdespesas.CodDespesa";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  
  ?>
		<table class="table table-hover">
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Descrição</th>
			  <th scope="col">Data</th>
			  <th scope="col">Valor</th>
			  <th scope="col">Tipo</th>
			</tr>
		  </thead>
		  <tbody>  
		  <?php
		  while($row = mysqli_fetch_assoc($result)) {
			echo "
			<tr>
			  <th scope='row'>" . $row["CodMovimento"]. "</th>
			  <td>" . $row["DescMovimento"]."</td>
			  <td>" . $row["DtMovmento"]."</td>
			  <td>" . $row["Valor"]."</td>";
			
			if($row["receita"] != null)
				echo "<td class='text-success'>" . $row["receita"]."</td>";
			else
				echo "<td class='text-danger'>" . $row["despesa"]."</td>";
			echo "</tr>";
		  }
		  echo "
			</tbody>
		</table>
		  ";
} else {
  echo "0 results";
}

mysqli_close($conn);
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