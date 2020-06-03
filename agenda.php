<?php 
<<<<<<< HEAD
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
=======
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $db = "agenda";

    $conexao = new mysqli($host, $usuario, $senha, $db);

    if ($conexao->connect_error) { // VERFICA SE A CONEXÃO TEVE ERROS
        echo $conexao->connect_error;
        exit;
    }

    $resultado = array("erro" => false); // VETOR PARA GUARDAR ERROS

    $operacao = "";
    if (isset($_GET["operacao"]))
        $operacao = $_GET["operacao"];

    echo $operacao;

    if ($operacao == "read") { // LISTA OS CONTATOS PELA LEITURA 
        $sql = "select * from contatos";
        if (isset($_GET["id"])) // SE O ID JÁ FOR PASSADO, CONDIÇÃO PARA PROCURAR ESTE ID
            $sql .= " where id = $_GET[id]";
        $exec = $conexao->query($sql); 

        $contatos = array();
        while ($contato = $exec->fetch_assoc())
            array_push($contatos, $contato);

        $resultado["erro"] = false;
        $resultado["registros"] = $exec->num_rows;
        $resultado["contatos"] = $contatos;

    } else
    if ($operacao == "create") { // INCLUIR CONTATO
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $instagram = $_POST["instagram"];
        $facebook = $_POST["facebook"];

        if (empty($nome)) {
            $resultado["erro"] = true;
            $resultado["msg"] = "Nome nao informado!";
        } else {            
            $sql = "Insert into contatos (nome, email, telefone, instagram, facebook) 
                    values ('$nome', '$email', '$telefone', '$instagram', '$facebook')";
            if (!$conexao->query($sql)) {
                $resultado["erro"] = true;
                $resultado["msg"] = $conexao->error;
            }
        }

    } else
    if ($operacao == "update") { // EDITAR CONTATO
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $instagram = $_POST["instagram"];
        $facebook = $_POST["facebook"];
        $linkedin = $_POST["linkedin"];

        $sql = "Update contatos set nome = '$nome', email = '$email', '$telefone', 
                '$instagram', '$facebook','$linkedin' where id =$id";

        if (!$conexao->query($sql)) { // TESTA SE HOUVE ERRO NO COMANDO SQL
            $resultado["erro"] = true;
            $resultado["msg"] = $conexao->error;
        }
    } else
    if ($operacao == "delete") { // DELETAR CONTATO

        $id = $_GET["id"];
        
        $sql = "delete from contatos where id = $id"; // DELETAR CONTATO PELO ID ESCOLHIDO
        if (!$conexao->query($sql)) {
            $resultado["erro"] = true;
            $resultado["msg"] = $conexao->error;
        } else
            $resultado["msg"] = "Contato removido com sucesso!";
    }

    echo json_encode($resultado);

    mysqli_close($conexao);
>>>>>>> 689767694e87627d1684f561f23f5cd8d04748a6

?>