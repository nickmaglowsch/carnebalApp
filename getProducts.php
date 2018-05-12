<?php 

    require_once('dataBase.php');
    
    $conexaoDB = getConexao();

    $request_method=$_SERVER["REQUEST_METHOD"];

    switch($request_method){
        case 'GET':
            if(!empty($_GET["id"])){
                $id=intval($_GET["id"]);
                get_Products($id);
            } else {
                get_Products(-1);
            }
        break;
        default:
            header("HTTP/1.0 405 METHOD NOT VALID");
        break;
    }

    function get_Products($id){
        global $conexaoDB;
        $query = "select foto, nomeProduto, descricao, precoUnitario from tbProduto";
        if($id != -1)
        {
            $query = "select foto, nomeProduto, descricao, precoUnitario from tbProduto as p left join tbcontrole as c on (p.cdProduto = c.cdProduto) inner join tbComanda as com on (c.cdComanda = com.cdComanda) where com.cdComanda =" .$id;
        }
        $response=array();
        $result=mysqli_query($conexaoDB, $query);
        while($row=mysqli_fetch_array($result))
        {
            $row[0]=base64_encode($row[0]);
            $row['foto']=base64_encode($row['foto']);
            $response[]=$row;
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }
?>