<?php 
	$host = "localhost";
	$usuario = "root";
	$senha = "";
	$db = "agenda";

	/*
	$conexao = new mysqli($host, $usuario, $senha, $db);

	if($conexao->connect_error){
		echo $conexao->connect_error;
		exit;
	}
	*/

	$result = array("error" => false, "contatos" => []);

	$operacao = "";
	if (isset($_GET["operacao"]))
		$operacao = $_GET["operacao"];

	/*
	if ($operacao == "read") {
		$sql = "select * from contatos";
		$exec = $conexao->query($sql);
		
		$contatos = array();
		while($contato = $exec->fetch_assoc())
			array_push($contatos, $contato);

			$result ["registros"] = $exec->num_rows;
			$result["contatos"] = $contatos;
	}
	*/

	echo json_encode($result);

?>