<?php
$id =$_POST['cod'];
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$login = $_POST['login'];
$senha = $_POST['senha'];
$senha2 = md5($senha);
include "conexao.php";
$result= mysql_query("UPDATE usuarios SET nome = '$nome',idade = '$idade', sexo = '$sexo', email = '$email', login = '$login', senha = '$senha2' WHERE cod_user ='$id'");


 header('Location: ListaUsuario.php');

?>