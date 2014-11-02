<?php

include '../conexao.php';

$user = $_POST["user"];
$tweet = $_POST["tweet"];
$data = $_POST["date"];




//Query que realiza a inserção dos dados no banco de dados na tabela indicada acima
$query = "INSERT INTO twit (username,tweet,data)
 
VALUES ('$user','$tweet','$data')";

mysql_query($query);
$id = mysql_insert_id();


if(!mysql_error()) {
    header( 'Location: home.php' ) ;
}

?>