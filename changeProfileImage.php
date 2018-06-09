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


$data = ['result' => false];
$cdFuncionario=$_POST['cdFuncionario'];

if (isset($_POST['file'])) {
    $imgdata = $_POST['file'];
    $imgdata = str_replace('data:image/jpg;base64,','',$imgdata);
    $imgdata = str_replace('data:image/jpg;base64,','',$imgdata);
    $imgdata = str_replace(' ','+',$imgdata);
    $imgdata = base64_decode($imgdata);
    AlterarFotoUsuario($imgdata);
}

function AlterarFotoUsuario($file){
    $fileNameNew = uniqid('', true).".jpg";
    if (!file_exists('View/Contents/users/'.$cdFuncionario.'/imgUser')) {
        mkdir('View/Contents/users/'.$cdFuncionario.'/imgUser', 0777, true);
    } else {
        $files = glob('View/Contents/users/'.$cdFuncionario.'/imgUser/*');
        foreach($files as $file){
            if(is_file($file))
                unlink($file);
        }
    }
    $fileDestination = 'View/Contents/users/'.$cdFuncionario.'/imgUser/'.$fileNameNew;
    file_put_contents($fileDestination.$fileNameNew, $file);
    $query ="UPDATE tbFuncionario SET foto = '$fileDestination' WHERE cdFuncionario = ".$cdFuncionario;
    echo $_SERVER['SERVER_ADDR']."/".$fileDestination;
    
    
}//function