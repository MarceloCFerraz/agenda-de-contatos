<?php 
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
    if (isset($_GET["operacao"])){
        $operacao = $_GET["operacao"];
    }
    
    if ($operacao == "read") { // LISTA OS CONTATOS PELA LEITURA 
        $sql = "select * from contato";
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

        if (empty($nome) || empty($telefone)) {
            $resultado["erro"] = true;
            $resultado["msg"] = "Verifique os campos obrigatórios";
        } else {            
            $sql = "Insert into contato (nome, email, telefone, instagram, facebook) values ('$nome', '$email', '$telefone', '$instagram', '$facebook')";
            if (!$conexao->query($sql)) {
                $resultado["erro"] = true;
                $resultado["msg"] = $conexao->error;
            } else {
                $resultado["erro"] = false;
                $resultado["msg"] = "Novo contato inserido com sucesso";
            }
        }

    } else
    if ($operacao == "update") { // EDITAR CONTATO
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $instagram = $_POST["instagram"];
        $facebook = $_POST["facebook"];

        if (empty($nome) || empty($telefone)) {
            $resultado["erro"] = true;
            $resultado["msg"] = "Verifique os campos obrigatórios";
        } else { 
            $sql = "Update contato set nome = '$nome', email = '$email', telefone = '$telefone', instagram = '$instagram', facebook = '$facebook' where id =$id";

            if (!$conexao->query($sql)) { // TESTA SE HOUVE ERRO NO COMANDO SQL
                $resultado["erro"] = true;
                $resultado["msg"] = $conexao->error;
            } else {
                $resultado["erro"] = false;
                $resultado["msg"] = "Contato atualizado com sucesso!";
            }
        }
    } else
    if ($operacao == "delete") { // DELETAR CONTATO

        $id = $_GET["id"];
        
        $sql = "delete from contato where id = $id"; // DELETAR CONTATO PELO ID ESCOLHIDO
        if (!$conexao->query($sql)) {
            $resultado["erro"] = true;
            $resultado["msg"] = $conexao->error;
        } else{
            $resultado["erro"] = false;
            $resultado["msg"] = "Contato removido com sucesso!";
        }
    }

    echo json_encode($resultado);

    mysqli_close($conexao);

?>