<?php 

    require_once('../mysqli_connection.php');
    $db = new conexao();
    $conexaoDB = $db->getConexao();
    //echo "oi";
    global $conexaoDB;
    $nmCliente= $_POST['nmCliente'];
    $numMesa= $_POST['numMesa'];
    $cdFuncionario = $_POST['cdFuncionario'];
    $nmCliente = trim($nmCliente);
    $numMesa = trim($numMesa);
    $query="insert into tbComanda (cdFuncionario, nomeCliente,numMesa,dtComanda, hrComanda, vlTotal) values('$cdFuncionario' ,'$nmCliente', $numMesa, CURDATE(), CURTIME(), 0.00)";
    $result = mysqli_query($conexaoDB, $query);
    if($result){
        echo "1";
        // $response=array(
        // 'status' => 1,
        // 'status_message' =>'Comanda Criada com sucesso.'
        // );
    } else {
        echo "0";
        // $response=array(
        // 'status' => 0,
        // 'status_message' =>'Falha a Criar Comanda.'
        // );
    }
?>