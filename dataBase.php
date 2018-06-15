<?php
class conexao
{
	/* Database connection start */
	var $servername = "localhost";
	var $username = "root";
	var $password = "";
	var $dbname = "dbcarnebal";
	var $dbc;
	function getConexao()
	{
		$con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());
		mysqli_set_charset($con, "utf8");
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		} else {
			$this->dbc = $con;
		}
		return $this->dbc;
	}
}

?>