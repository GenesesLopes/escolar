<?php
session_start();
include'../conexao.php';

//Recuperar dados do formulário

$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$dataCadastro = date("d/m/Y");
$loginCadastro = $_SESSION["login"];
$qtdAluno = $_POST['aluno'];
echo $nome.$endereco.$dataCadastro.$loginCadastro.$qtdAluno;
//Verificando se o local já foi cadastrado

$sql = "SELECT nome FROM local WHERE nome = ?";
$local = $conexao->prepare($sql);
$local->bindValue(1,$nome);
$local->execute();

if($local->rowCount())
	echo "<script>alert('Local já cadastrado!');location.href=\"../formCadastroVeiculo.php\";</script>";
//inserindo dados na tabela local
$sql = "INSERT INTO local VALUES(?,?,?,?,?)";
$local = $conexao->prepare($sql);
$local->bindValue(1,$nome);
$local->bindValue(2,$loginCadastro);
$local->bindValue(3,$dataCadastro);
$local->bindValue(4,$endereco);
$local->bindValue(5,$qtdAluno);
$local->execute();

echo "<script>alert('Local cadastrado com sucesso!');location.href=\"../../index.php\";</script>";
?>