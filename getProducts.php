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
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            get_Products($id);
        } else {
            get_Products(-1);
        }
        break;
    default:
        header("HTTP/1.0 405 METHOD NOT VALID");
        break;
}

function get_Products($id)
{
    global $conexaoDB;
    $query = "SELECT tbProduto.cdProduto, foto , nomeProduto, descricao, precoUnitario, 0 AS qtProduto, 0 AS cdComanda FROM tbProduto";
    if ($id != -1) {
        $query = "SELECT foto, nomeProduto, descricao, precoUnitario FROM tbProduto AS p INNER JOIN tbcontrole AS c ON (p.cdProduto = c.cdProduto) INNER JOIN tbComanda AS com ON (c.cdComanda = com.cdComanda) WHERE com.cdComanda =" . $id . " AND isAtivo=1";
    }
    $response = array();
    $result = mysqli_query($conexaoDB, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
}
?>