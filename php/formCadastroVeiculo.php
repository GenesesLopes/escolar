<?php
session_start();
include 'conexao.php';
include 'head.php';
?>
<body>
	<h2 align="center"><b>Cadastro de Veículos</b></h2>
	<div class="jumbotron">
		<div class="container">
			<form class="form-group" enctype="multipart/form-data" method="post" action="ações/cadastroVeiculo.php">
				<div class="form-group">
					<label>Placa</label>
					<input type="text" name="placa" class="form-control" id="placa" placeholder="Ex: JRZ-0994" style=" width: 45%;" required>
				</div>
				<div class="form-group">
					<label>Marca / Modelo</label>
					<input type="text" name="modelo" class="form-control" id="modelo" style="width: 45%;" required>
				</div>
				<div class="form-group">
					<label>Km Inicial</label>
					<input type="number" name="KmInicial" placeholder="Ex.:93000" class="form-control" id="KmInicial" style="width: 15%;" required>
				</div>
				<div class="form-group">
					<label>Capacidade</label>
					<input type="number" name="capacidade" placeholder="Ex.: 5" class="form-control" id="capacidade" style="width: 15%;" required>
				</div>
				<div class="form-group">
				    <label>Foto</label>
				    <input type="file" id="foto" name="foto" required>
				</div>
				<div class="form-group">
					<label>Situação</label>
					<select class="form-control" style="width: 15%;" name="situacao" id="situacao" required>
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