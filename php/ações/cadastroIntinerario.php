<?php
include('../conexao.php');
//Recuperando dados do formulário

$veiculo = $_POST['veiculo'];
$quantidade = $_POST['quantidade'];
$local = $_POST['local'];
/* Turno "Legenda"
 	1-> Manhã
 	2-> Tarde
 	3-> Manhã e Tarde
*/
if(isset($_POST['manha']) && isset($_POST['tarde']))
	$turno = 3;
else if(isset($_POST['manha']))
	$turno = 1;
else 
	$turno = 2;

//Verificando se a rota já foi cadastrada
$sql = "SELECT * FROM conduzAo WHERE palca = ? AND local = ? AND turno = ?";
$consulta = $conexao->prepare($sql);
$consulta->bindValue(1,$veiculo);
$consulta->bindValue(2,$local);
$consulta->bindValue(3,$turno);
$consulta->execute();

if($consulta->rowCount())
	echo"<script>alert('Rota já cadastrada!');location.href=\"../formCadastroIntinerario.php\";</script>";
else{
	//Cadastrando rota no banco de dados
	$sql = "INSERT INTO conduzAo VALUES(?,?,?,?)";
	$consulta = $conexao->prepare($sql);
	$consulta->bindValue(1,$veiculo);
	$consulta->bindValue(2,$local);
	$consulta->bindValue(3,$turno);
	$consulta->bindValue(4,$quantidade);
	$consulta->execute();

	echo"<script>alert('Rota cadastrada com sucesso!');location.href=\"../../index.php\";</script>";
}
?>