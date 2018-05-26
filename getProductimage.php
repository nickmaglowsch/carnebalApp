<?php 
    // this Script is just a testing and support script do not use it in production!
    require_once('dataBase.php');
    $conexaoDB = getConexao();

    $request_method=$_SERVER["REQUEST_METHOD"];

    switch($request_method){
        case 'GET':
            if(!empty($_GET["id"])){
                $id=intval($_GET["id"]);
                get_ProductImage($id);
            }
        break;
        default:
            header("HTTP/1.0 405 METHOD NOT VALID");
        break;
    }

    function get_ProductImage($id){
        global $conexaoDB;
        $query = "select foto from tbProduto where cdProduto= $id";
        $result = mysqli_query($conexaoDB, $query);

        while($row = mysql_fetch_array($result)){
            header("content-type: image/jpeg");
            echo $row['image'];
        }
        
    }
?>