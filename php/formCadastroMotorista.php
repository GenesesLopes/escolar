<?php
session_start();
include 'head.php';
include 'conexao.php';
$sql = "SELECT * FROM veiculo";
$busca = $conexao->prepare($sql);
$busca->execute();
if(!$busca->rowCount())
	echo "<script>alert('Não existe registro de veículos cadastrados, favor cadastrar algum veículo!');location.href=\"../index.php\";</script>";
?>
<body>
<h2 align="center"><b>Cadastro de Motorista</b></h2>
<div class="jumbotron">
	<div class="container">
		<form class="form-group" method="post" name="formCadastroMotorista" action="ações/cadastroMotorista.php" onsubmit=" return turno();">
		  <div class="form-group">
		    <label>Nome</label>
		    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Completo" style="width:45%;" required>
		  </div>
		  <div class="form-group">
		    <label>Número da habilitação</label>
		    <input type="text" class="form-control" id="cnh" name="cnh" placeholder="Somente números" style=" width: 45%;" required>
		  </div>
		  <div class="form-group">
		  	<label>Categoria da Habilitação</label>
		  	<input type="text" name="categoriaCnh" class="form-control" id="categoriaCnh" style=" width: 10%;" required>
		  </div>
		  <div class="form-group">
		  	<label>Veículo que irá conduzir</label>
		  	<select name="veiculo" id="veiculo" class="form-control" style=" width: 20%;">
		  	<option selected > SELECIONE A PLACA</option>
		  	<option>
		  	<?php 
		  		$sql= "SELECT placa FROM veiculo";
		  		$veiculo = $conexao->prepare($sql);
		  		$veiculo->execute();
		  		$veiculo->setFetchMode(PDO::FETCH_OBJ);
		  		while($result = $veiculo->fetch()){
		  			echo $result->placa;
		  		}
		  	?>
		  	</option>
		  	</select>
		  	</div>
		  	<div class="form-group">
		  		<label>Turno</label><br>
		  		<input type="checkbox" name="manha" id="manha" value="manha"> Manhã&nbsp;&nbsp;
		  		<input type="checkbox" name="tarde" id="tarde" value="tarde"> Tarde
		  	</div>

		  	<div class="form-group">
		  		<label>Status</label>		  		
		  		<select name="status" id="status" class="form-control" style="width: 15%;">
		  			<option>Ativo</option>
		  			<option>Inativo</option>
		  		</select>
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