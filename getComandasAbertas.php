<?php 
$headers = apache_request_headers();
if (!$headers) {
    $headers = http_get_request_headers();
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST');
header('Access-Control-Allow-Headers: Authorization, Content-Type');


require_once('dataBase.php');
$db = new conexao();
$conexaoDB = $db->getConexao();

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        get_Products();
        break;
    default:
        header("HTTP/1.0 405 METHOD NOT VALID");
        break;
}

function get_Products()
{
    global $conexaoDB;
    $query = 'SELECT cdComanda, numMesa, numComandaFisica, TIME_FORMAT(hrComanda, "%H:%i") AS hrComanda FROM tbComanda WHERE isAtivo=1';

    $response = array();
    $result = mysqli_query($conexaoDB, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
}
?>