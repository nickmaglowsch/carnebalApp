<?php 

require_once('dataBase.php');
$db = new conexao();
$conexaoDB = $db->getConexao();
$headers = apache_request_headers();
if (!$headers) {
    $headers = http_get_request_headers();
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Authorization, Content-Type');
$json = file_get_contents('php://input');
$item = json_decode($json, true);
$query = " UPDATE tbcomanda
    SET vlTotal = (SELECT sum(vlControle) from tbcontrole where cdComanda=" . $item['cdComanda'] . ")
    WHERE cdComanda=" . $item['cdComanda'];

$result = mysqli_query($conexaoDB, $query);
    // print_r($item[0]);
if ($result) {
    echo "1";
} else {
    echo "0";
}

?>