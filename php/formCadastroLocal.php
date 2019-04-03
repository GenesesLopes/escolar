<?php
session_start();
include 'conexao.php';
include 'head.php';
?>
<body>
	<h2 align="center"><b>Cadastro de Locais</b></h2>
	<div class="jumbotron">
		<div class="container">
			<form class="form-group" enctype="multipart/form-data" method="post" action="ações/cadastroLocal.php">
				<div class="form-group">
					<label>Nome</label>
					<input type="text" name="nome" class="form-control" id="nome" placeholder="" style=" width: 45%;" required>
				</div>
				<div class="form-group">
					<label>Endereço</label>
					<input type="text" name="endereco" class="form-control" id="endereco" style="width: 45%;" required>
				</div>
				<div class="form-group">
					<label>Quantidade todal de alunos a transportar</label>
					<input type="number" name="aluno" class="form-control" id="aluno" style="width: 15%;" required>
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