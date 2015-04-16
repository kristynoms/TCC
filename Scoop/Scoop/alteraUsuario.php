<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<?php
require "validaAdmin.php";
?>
</head>
<script>
function msg() {
 alert("Alteração Efetuada!");
 
          AltUsuario.submit();
  
     
}
</script>
<body>


<?php  if(isset($_SESSION['user'])) { ?>
<a href="logout.php">
<button class="btn btn-primary btn-xs" type="button" > Logout </button>
</a>
<button class="btn btn-primary btn-xs" type="button" ><?php echo  strtoupper("Bem Vindo: ".$_SESSION['user']."")  ?> </button>
<?php } ?>
<div class="page-header"> </div>
<div class="container">
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <button class="navbar-toggle" data-target=".navbar-inverse-collapse" data-toggle="collapse" type="button"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>
    <?php include('/menu/menu.php')?>
</div>
 <?php
             $id=$_GET['id'];
             include 'conexao.php';
             $result= mysql_query("select * from usuarios where cod_user='$id'");
			  while($row= mysql_fetch_array($result)){
          echo" <div class='col-lg-62'>
           <div class='well2'>
           <form action=\"updateUser.php\" method=\"post\" class='bs-example form-horizontal' name='AltUsuario'>
		  
           <fieldset>
           <legend>Edição de Usuários</legend>
           <div class='form-group'>
           <label class='col-lg-2 control-label' for='inputNome' > Nome </label>
		    <input id='inputId' class='form-control' type='hidden' placeholder='id' name='cod' value=".$row['cod_user']."></input>
           <div class='col-lg-10'>
    <input id='inputNome' class='form-control' type='text' placeholder='Nome' name='nome' value=".$row['nome']."></input>
           </div>
           </div>
           <div class='form-group'>
           <label class='col-lg-2 control-label' for='inputIdade'> Idade </label>
           <div class='col-lg-10'>
    <input id='inputIdade' class='form-control' type='text' placeholder='Idade' name='idade' value=".$row['idade']."></input>
           </div>
           </div>
          <div class='form-group'>

    <label class='col-lg-2 control-label' for='sexo'>sexo</label>
    <div class='col-lg-10'>
        <select id='sexo' class='form-control' name='sexo'>
           <option> - </option>
		   <option value=".$row['sexo']." selected='selected'>".$row['sexo']."</option>
            <option> Masculino </option>
            <option>Feminino </option>
            
           </select>
           </div></div>
             <div class='form-group'>
           <label class='col-lg-2 control-label' for='inputEmail'> Email </label>
           <div class='col-lg-10'>
    <input id='inputEmail' class='form-control' type='text' placeholder='Email' name='email' value=".$row['email']."></input>
           </div>
           </div>
              <div class='form-group'>
           <label class='col-lg-2 control-label' for='inputLogin'> Login </label>
           <div class='col-lg-10'>
    <input id='inputLogin' class='form-control' type='text' placeholder='Login' name='login' value=".$row['login']."></input>
           </div>
           </div>
              <div class='form-group'>
           <label class='col-lg-2 control-label' for='inputSenha'> Senha </label>
           <div class='col-lg-10'>
    <input id='inputSenha' class='form-control' type='password' placeholder='Senha' name='senha' value=".$row['senha']."></input>
           </div>
           </div>
            <div class='form-group'>

    <div class='col-lg-10 col-lg-offset-2'>
        <button class='btn btn-default' onclick=\"location.href='ListaUsuario.php'\">Cancel</button>
        <button class='btn btn-primary' onclick='msg()'>Alterar</button>
		
    </div></div>
           </fieldset></form>
           </div>
           
             
           </div>  ";
		
		   }
		   ?>
</body>
</html>
