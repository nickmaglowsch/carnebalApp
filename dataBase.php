
<?php
    $servername = "localhost";
	$username = "root";
	$password = "";
    $dbname = "dbCarnebal";

    function getConnetion(){
        try 
        {
            $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
        return null;
    }
?>