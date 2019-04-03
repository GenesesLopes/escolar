<?php
session_start();
include'../conexao.php';

//Recuperar dados do formulário

$placa = strtoupper($_POST['placa']);
$modelo = $_POST['modelo'];
$KmInicial = $_POST['KmInicial'];
$situacao = $_POST['situacao']=='Ativo' ? 1 : 0;
$dataCadastro = date("d/m/Y");
$loginCadastro = $_SESSION["login"];
$capacidade = $_POST['capacidade'];

//Verificando se o veículo já foi cadastrado

$sql = "SELECT placa FROM veiculo WHERE placa = ?";
$veiculo = $conexao->prepare($sql);
$veiculo->bindValue(1,$placa);
$veiculo->execute();

if($veiculo->rowCount() > 0)
	echo "<script>alert('Veículo já cadastrado!');location.href=\"../formCadastroVeiculo.php\"; 	</script>";

//Recuperando imagem do formulário
$destino = "../../img/";
$foto = $_FILES['foto'];
$nomeFoto = $placa.$foto['name'];
$destino.= $nomeFoto;

//Altura e largura pretendida de cada imagem
$altura = "242";
$largura = "200";

//Configurando a imagem 
switch ($foto['type']) {
	case 'image/png':
		$imagem_temporaria = imagecreatefrompng($foto['tmp_name']);
		$largura_original = imagesx($imagem_temporaria);
		$altura_original = imagesy($imagem_temporaria);
		//Nova largura
		$nova_largura = $largura ? $largura : floor(( $largura_original / $altura_original ) * $altura);
		//Nova Altura
		$nova_altura = $altura ? $altura : floor(( $altura_original / $largura_original ) * $largura);
		/* Retorna a nova imagem criada */
		$imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
		/* Copia a nova imagem da imagem antiga com o tamanho correto */
		imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
		//move imagem para o servidor
		imagepng($imagem_redimensionada, '../../img/' . $nomeFoto);
		break;
	case 'image/jpeg':
	case 'image/jpg':
		
		$imagem_temporaria = imagecreatefromjpeg($foto['tmp_name']);
			
			$largura_original = imagesx($imagem_temporaria);
			
			$altura_original = imagesy($imagem_temporaria);
						
			$nova_largura = $largura ? $largura : floor (($largura_original / $altura_original) * $altura);
			
			$nova_altura = $altura ? $altura : floor (($altura_original / $largura_original) * $largura);
			
			$imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
			imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
			
			imagejpeg($imagem_redimensionada, '../../img/' . $nomeFoto);
		break;
	default:
		echo "<script>alert('Formato de imagem inválido!');location.href=\"../formCadastroVeiculo.php\";";
		break;
}

//Inserir dados no banco de dados

$sql = "INSERT INTO veiculo VALUES(?,?,?,?,?,?,?,?)";
$veiculo = $conexao->prepare($sql);
$veiculo->bindValue(1,$placa);
$veiculo->bindValue(2,$nomeFoto);
$veiculo->bindValue(3,$modelo);
$veiculo->bindValue(4,$dataCadastro);
$veiculo->bindValue(5,$_SESSION["login"]);
$veiculo->bindValue(6,$KmInicial);
$veiculo->bindValue(7,$situacao);
$veiculo->bindValue(8,$capacidade);
$veiculo->execute();

echo "<script>alert('Veículo Cadastrado com sucesso!');location.href=\"../../index.php\";</script>";

?>