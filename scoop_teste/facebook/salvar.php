<?php
	include '../conexao.php';
$query = "INSERT INTO fb 
 
VALUES ('$username','$text','$timestamp')";

mysql_query($query);	

?>