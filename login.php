<?php 
    // require_once('../mysqli_connection.php');
    // $db = new conexao();
    // $conexaoDB = $db->getConexao();
    $servername = "localhost";
	$username = "root";
	$password = "";
    $dbname = "dbCarnebal";
    $conn = mysqli_connect($servername, $username, $password ,$dbname);

    $CPF = $_POST['cpf'];
    $Senha = $_POST['senha'];
    $Senha = sha1($Senha);
    $sql = "select cdFuncionario from tbFuncionario where CPF='$CPF' and senha='$Senha'";
    
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['cdFuncionario'];
    } else {
        echo "0";
    }

?>