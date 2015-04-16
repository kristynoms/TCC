<?php
include('conexao.php');
	session_start();
	$user = $_POST['login'];
	$senha = $_POST['senha'];
	$senha2 = md5($senha);
	$logar = mysql_query("SELECT * FROM usuarios WHERE login='$user' AND senha='$senha2'") ;
	 $count = mysql_num_rows($logar);
	if($count >= 1) {
		$_SESSION['user'] = $user;
		header('Location: home.php');
	} else {
		$_SESSION['error'] = 1;
		header('Location: index.php');
	}
	
	
	header('Location: home.php');
?>