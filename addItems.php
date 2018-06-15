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
$obj = json_decode($json, true);

foreach ($obj as $item) {
    $query = "INSERT into tbControle (cdProduto, qtProduto,vlControle,cdComanda) 
        SELECT " . $item['cdProduto'] . " ," . $item['qtProduto'] . "," . $item['qtProduto'] . "* precoUnitario ," . $item['cdComanda'] . " 
        from tbProduto where cdProduto =" . $item['cdProduto'] . " ON DUPLICATE KEY UPDATE qtProduto= qtProduto + " . $item['qtProduto'];
    $result = mysqli_query($conexaoDB, $query);
}
$query = " UPDATE tbcomanda
    SET vlTotal = (SELECT sum(vlControle) from tbcontrole where cdComanda=" . $item['cdComanda'] . ")
    WHERE cdComanda=" . $item['cdComanda'];

$result = mysqli_query($conexaoDB, $query);

if ($result) {
    echo "1";
} else {
    echo "0";
}

?>