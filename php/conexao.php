<?php
try{
		//$conexao = new PDO('mysql:host=localhost; dbname=site', 'root', 'lopes28');
		$conexao = new PDO('pgsql:dbname=escolar; host=localhost', 'postgres', 'lopes28');
       		$conexao->exec("set names utf8");
		
}
catch(PDOException $e){
		echo 'ERROR: '. $e->getMessage();
}

?>
