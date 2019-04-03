<?php
include 'conexao.php';
/*$numero = $_POST['numero'];
$nome = $_POST['nome'];

$sql = "INSERT INTO dados VALUES(?,?)";	
$inserir = $conexao->prepare($sql);
$inserir->bindValue(1,$numero);
$inserir->bindValue(2,$nome);
$inserir->execute();
echo '<script>alert(\'enviado\');</script>';
*/

/*
//mês
$sqlmes = "SELECT DATE_PART('MONTH', CURRENT_TIMESTAMP)";
$procura = $conexao->prepare($sqlmes);
$procura->execute();
$procura->setFetchMode(PDO::FETCH_OBJ);

$result = $procura->fetch();
echo $result->date_part."/";
//Ano
$sqlano = "SELECT DATE_PART('YEAR', CURRENT_TIMESTAMP)";
$procura = $conexao->prepare($sqlano);
$procura->execute();
$procura->setFetchMode(PDO::FETCH_OBJ);

$result = $procura->fetch();
echo $result->date_part;
*/
setlocale(LC_TIME,"pt_BR");
//echo date("M/Y");
$mes = date("m");
$ano = date("Y");
echo $mes.$ano;
$sql = "INSERT INTO teste VALUES(?,?)";
$inserir = $conexao->prepare($sql);
$inserir->bindValue(1,$mes);
$inserir->bindValue(2,$ano);
$inserir->execute();


?>
