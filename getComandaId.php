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

    $request_method=$_SERVER["REQUEST_METHOD"];

    switch($request_method){
        case 'GET':
            $id=intval($_GET["id"]);
            getCommandaId($id);
        break;
        default:
            header("HTTP/1.0 405 METHOD NOT VALID");
        break;
    }

    function getCommandaId($id){
        global $conexaoDB;
        $response=array();
        $query="select cdComanda from tbComanda where numComandaFisica = $id and isAtivo= 1";
        $result = mysqli_query($conexaoDB, $query);
        while($row=mysqli_fetch_assoc($result))
        {
            $response=$row;
        }
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }
?>