<?php 
session_start();
include '../conexao.php';

$nome = strtoupper($_POST['nome']);
$numeroHabilitacao = $_POST['cnh'];
$categoria = strtoupper($_POST['categoriaCnh']);
$veiculo = $_POST['veiculo'];
$status = $_POST['status']=='Ativo' ? 1 : 0;
 /*inserir turno na tabela conduz
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

$dataCadastro = date("d/m/Y");
$loginCadastro = $_SESSION["login"];


$sql = "SELECT cnh FROM motorista WHERE cnh = ?";
$motorista = $conexao->prepare($sql);
$motorista->bindValue(1,$numeroHabilitacao);
$motorista->execute();

if($motorista->rowCount() > 0)
	echo "<script>alert('Motorista Já cadastrado!');location.href=\"../formCadastroMotorista.php\";</script>";
else{
	//inserir os dados na tabela motorista
	$sql = "INSERT INTO motorista VALUES(?,?,?,?,?,?)";
	$motorista = $conexao->prepare($sql);
	$motorista->bindValue(1,$numeroHabilitacao);
	$motorista->bindValue(2,$nome);
	$motorista->bindValue(3,$categoria);
	$motorista->bindValue(4,$status);
	$motorista->bindValue(5,$dataCadastro);
	$motorista->bindValue(6,$loginCadastro);
	$motorista->execute();

	//inserindo dados na tabela conduz

	$sql = "INSERT INTO conduz VALUES(?,?,?,?)";
	$motorista = $conexao->prepare($sql);
	$motorista->bindValue(1,$numeroHabilitacao);
	$motorista->bindValue(2,$veiculo);
	$motorista->bindValue(3,$turno);
	$motorista->bindValue(4,$status);
	$motorista->execute();
	
	echo "<script>alert('Motorista Cadastrado com sucesso!'); location.href=\"../../index.php\";</script>";
}


?>