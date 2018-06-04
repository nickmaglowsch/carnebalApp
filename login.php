<?php 
    $headers = apache_request_headers();
    if (!$headers) {
        $headers = http_get_request_headers();
    }
    
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET,POST');
    header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
    
    require_once('dataBase.php');
    $db = new conexao();
    $conexaoDB = $db->getConexao();
    //$data = json_decode(file_get_contents('php://input'), true);
    $CPF = $_POST['cpf'];
    $Senha = $_POST['senha'];
    //$Senha = sha1($Senha);
    $sql = "select cdFuncionario, foto, nomeFuncionario from tbFuncionario where CPF='$CPF' and senha='$Senha'";
    
    $result = mysqli_query($conexaoDB, $sql);
    $resultCheck = mysqli_num_rows($result);
    $response=array();
    if($resultCheck > 0) {
        $result=mysqli_query($conexaoDB, $sql);
        $row = mysqli_fetch_assoc($result);
        $response[]=$row;
        echo json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    } else {
        echo "0";
    }

?>