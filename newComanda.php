<?php 

    require_once('dataBase.php');
    $conexaoDB = getConnetion();
    global $conexaoDB;
    $nmCliente= $_POST['nmCliente'];
    $numMesa= $_POST['numMesa'];
    $cdFuncionario = $_POST['cdFuncionario'];
    $nmCliente = trim($nmCliente);
    $numMesa = trim($numMesa);
    $query="insert into tbComanda (cdFuncionario, nomeCliente,numMesa,dtComanda, hrComanda, vlTotal) values('$cdFuncionario' ,'$nmCliente', $numMesa, CURDATE(), CURTIME(), 0.00)";
    $result = mysqli_query($conexaoDB, $query);
    if($result){
        echo "1";
    } else {
        echo "0";
    }
?>