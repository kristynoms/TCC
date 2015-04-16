<?php
$id =$_POST['cod'];
$nome = $_POST['nome'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$login = $_POST['login'];
$senha = $_POST['senha'];
include "conexao.php";
$result= mysql_query("DELETE from usuarios  WHERE cod_user ='$id'");



 header('Location: ListaDelUsuario.php');

?>