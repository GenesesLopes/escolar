<?php
include("../conexao.php");

if(isset($_POST['placa'])){
	
	$placaVeiculo = $_POST['placa'];
	//Consultar no banco
	$sql = "SELECT capacidade FROM veiculo WHERE placa = ?";
	$capacidade = $conexao->prepare($sql);
	$capacidade->bindValue(1,$placaVeiculo);
	$capacidade->execute();
	$capacidade->setFetchMode(PDO::FETCH_OBJ);

	while($result = $capacidade->fetch()){
		$placa = $result->placa;
?>
	<label>Capacidade do veículo</label>
	<input type="text" class="form-control" style="width: 3%" disabled name="capacidade" value="<?php echo $result->capacidade; ?>">
	<input type="hidden" id="capacidade" name="capacidade" value="<?php echo $result->capacidade; ?>">
<?php
	}
}
?>