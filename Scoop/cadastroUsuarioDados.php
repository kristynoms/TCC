<?php

include 'conexao.php';

$nome = $_POST["nome"];
$idade = $_POST["idade"];
$sexo = $_POST["sexo"];
$email = $_POST["email"];
$login = $_POST["login"];
$senha = $_POST["senha"];
$senha2 = md5($senha);



//Query que realiza a inserção dos dados no banco de dados na tabela indicada acima
$query = "INSERT INTO usuarios (nome,idade,sexo,email,login,senha )
 
VALUES ('$nome','$idade','$sexo','$email','$login','$senha2' )";

mysql_query($query);
$id = mysql_insert_id();


if(!mysql_error()) {
    header( 'Location: home.php' ) ;
}

?>

