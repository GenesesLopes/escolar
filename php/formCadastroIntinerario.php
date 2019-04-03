<?php
session_start();
include 'conexao.php';
include 'head.php';
?>
<body>
	
	<h2 align="center"><b>Cadastro de Intinerário</b></h2>
	<div class="jumbotron">
		<div class="container">
			<form class="form-group" enctype="multipart/form-data" method="post" action="ações/cadastroIntinerario.php" onsubmit="return capacidadeVeiculo();">
				<div class="form-group">
				  	<label>Veículo que irá conduzir</label>
				  	<select name="veiculo" onchange="buscarPlaca();" id="veiculo" class="form-control" style=" width: 15%;" required>
				  	<option value="selecionar" > Selecione a Placa</option>
				  	
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
				<!--usar ajax aqui-->
				<div class="form-group" id="resultado" >
					<label>Capacidade do veículo</label>
					
				</div>
				
				<div class="form-group">
					<label>Quantidade de alunos a transportar</label>
					<input type="number" name="quantidade" id="quantidade" class="form-control" style="width: 20%;" required>
				</div>

				<div class="form-group">
					<label>Escola / Colégio</label>
					<select name="local" id="local" class="form-control" style=" width: 15%;" required>
				  	<option> Selecione o Local</option>
				  	
				  	<?php 
				  		$sql= "SELECT nome FROM local";
				  		$local = $conexao->prepare($sql);
				  		$local->execute();
				  		$local->setFetchMode(PDO::FETCH_OBJ);
				  		while($result = $local->fetch()){
				  			echo "<option value='".$result->nome."'>".$result->nome."</option>";
				  		}
				  	?>
				  	
				  	</select>
				</div>

				<div class="form-group">
					<label>Turno</label><br>
					<input type="checkbox" name="manha" id="manha" value="manha"> Manhã &nbsp;&nbsp;
					<input type="checkbox" name="tarde" id="tarde" value="tarde"> Tarde
				</div>

				<div class="form-group">
				   <button type="submit" class="btn btn-success" onclick="return turno();"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Cadastrar</button>
				   <button type="reset" class="btn btn-danger"> <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Limpar</button>
				</div>
			</form>
			<a href="../index.php" class="btn btn-primary " role="button"> <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Voltar</a>
		</div>
	</div>
	
</body>
</html>