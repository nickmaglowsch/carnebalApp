<?php 
    // require_once('../mysqli_connection.php');
    // $db = new conexao();
    // $conexaoDB = $db->getConexao();
    $servername = "localhost";
	$username = "root";
	$password = "";
    $dbname = "carnebal";
    $conn = mysqli_connect($servername, $username, $password ,$dbname);

    $CPF = $_POST['cpf'];
    $Senha = $_POST['senha'];
    $sql = "select cdFuncionario from tbFuncionario where CPF='$CPF' and senha='$Senha'";
    
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['cdFuncionario'];
    } else {
        echo "0";
    }




    
    // $request_method=$_SERVER["REQUEST_METHOD"];

    // switch($request_method){
    //     case 'POST':
    //         autentificar();
    //     break;
    //     default:
    //         header("HTTP/1.0 405 METHOD NOT VALID");
    //     break;
    // }

    // function autentificar(){
    //     global $conexaoDB;
    //     $data = json_decode(file_get_contents('php://input'), true);
    //     $CPF=$data["CPF"];
    //     $Senha=$data["Senha"];
    //     $Senha = md5($Senha);
    //     $query="select cdFuncionario tbFuncionario where CPF='".$CPF."' and senha='".$Senha."'";
    //     $result=mysqli_query($conexaoDB, $query);
        
    //     if(mysqli_num_rows($result) > 0){
    //         $row = mysql_fetch_assoc($result);
    //         $token = getToken();
    //         $response=array(
    //         'status' => 1,
    //         'status_message' =>'Login Correto.',
    //         'cdFuncionario' => $result
    //         );
    //     } else {
    //         $response=array(
    //         'status' => 0,
    //         'status_message' =>'Login Incorreto.'
    //         );
    //     }
    //     header('Content-Type: application/json');
    //     echo json_encode($response);
    // }

?>