<?php
session_start();
include '../conexao.php';
//recuperando dados do formulário
$login = strtoupper($_POST["login"]);
$senha = md5($_POST["senha"]);
//Consultando no banco de dados
$sql = "SELECT * FROM usuario WHERE login = ? AND senha = ?";
$consulta = $conexao->prepare($sql);
$consulta->bindValue(1,$login);
$consulta->bindValue(2,$senha);
$consulta->execute();

if($consulta->rowCount() > 0){
	$consulta->setFetchMode(PDO::FETCH_OBJ);
	while($result = $consulta->fetch()){
		$_SESSION["tipo"] = $result->tipo;
		$status = $result->status;
		$_SESSION["login"] = $login;
	}
	//verificando se o usuario está ativo
	if(!$status){
		//Destruíndo sessão e conexão com o banco de dados
		session_unset();session_destroy();
		$conexao = null;
		echo "<script>alert('Usuário temporariamente desativado! Favor entrar em contato com o Secretário ou administrador do sistema!');location.href=\"../../index.php\";</script>";
	}else
		header("location: ../../index.php");

}else{
	session_unset();session_destroy();
	$conexao = null;
	echo "<script>alert('Usuario não encontrado');location.href=\"../../index.php\";</script>";
}	

?>