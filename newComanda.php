<?php 
    $headers = apache_request_headers();
    if (!$headers) {
        $headers = http_get_request_headers();
    }

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET,POST');
    header( 'Access-Control-Allow-Headers: Authorization' );
    header( 'Content-Type:application/json' );

    require_once('dataBase.php');
    $db = new conexao();
    $conexaoDB = $db->getConexao();
    
    $numComandaFisica= $_POST['numComandaFisica'];
    $numMesa= $_POST['numMesa'];
    $cdFuncionario = $_POST['cdFuncionario'];
    $numComandaFisica = trim($numComandaFisica);
    $numMesa = trim($numMesa);
    $query="select * from tbComanda where numComandaFisica = $numComandaFisica and isAtivo= 1";
    $result = mysqli_query($conexaoDB, $query);
    //print_r($result);
    if (mysqli_num_rows($result) == 0){
        $query="insert into tbComanda (cdFuncionario, numComandaFisica,numMesa,dtComanda, hrComanda, vlTotal, isAtivo) values($cdFuncionario ,$numComandaFisica, $numMesa, CURDATE(), CURTIME(), 0.00, 1)";
        $result = mysqli_query($conexaoDB, $query);
        //echo json_encode($result);
        $query="select cdComanda from tbComanda where numComandaFisica = $numComandaFisica and isAtivo= 1";
        $result = mysqli_query($conexaoDB, $query);
        $row = $result->fetch_assoc();
        echo json_encode($row['cdComanda']);
        
    }else{
        echo "0";
    }
?>