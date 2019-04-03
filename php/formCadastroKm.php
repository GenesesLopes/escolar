<?php
session_start();
include('conexao.php');
include('head.php');
?>
<body>
	<h2 align="center"><b>Cadastro de Quilometragem por Mês</b></h2>
	<div class="jumbotron">
		<div class="container">
			<form  class="form-group" enctype="multipart/form-data" method="post" action="ações/cadastroKm.php">
				<div class="form-group">
					<label>Veículo</label>

					<select name="veiculo" id="veiculo" class="form-control" style="width: 25%;" required>
						<option>Selecione o Veículo</option>
						<?php 
				  		$sql= "SELECT placa FROM veiculo";
				  		$veiculo = $conexao->prepare($sql);
				  		$veiculo->execute();
				  		$veiculo->setFetchMode(PDO::FETCH_OBJ);
				  		while($result = $veiculo->fetch()){
				  			echo "<option value='".$result->placa."'>".$result->placa."</option>";
				  		}
				  	?>
					</select>
				</div>
				<div class="form-group">
					<label>Período:</label><br>
					<input type="radio" name="radio" id="atual" checked onclick="Km2();" "> Mês Atual&nbsp;&nbsp;<br>
					<input type="radio" name="radio" id="antigo"onclick="Km();">&nbsp;Outro:
				</div>
				<div class="form-group">
					<label>Mês:</label><br>
					<input type="text" name="mes" id="mes" class="form-control" placeholder="Ex.:07" style="width: 10%;" disabled>
					<label>Ano:</label>
					<input type="text" name="ano" id="ano" class="form-control" placeholder="Ex.:2016" style="width: 12%;" disabled>
				</div>
				<div class="form-group">
					<label>Quilometragem o veículo</label>
					<input type="number" name="km" class="form-control" id="km" style="width: 20%;" required>
				</div>
				
				<div class="form-group">
				   <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Cadastrar</button>
				   <button type="reset" class="btn btn-danger"> <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Limpar</button>
				</div>
			</form>
			<a href="../index.php" class="btn btn-primary " role="button"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Voltar</a>
		</div>
	</div>
</body>
</html>