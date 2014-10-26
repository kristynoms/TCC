<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 
	if(!isset($_SESSION['user'])) {
?>
<div class="page-header"> </div>
<div class="col-lg-6">
  <div class="well">
    <form action="login.php" method="post" class="bs-example form-horizontal">
      <fieldset>
        <legend>Login</legend>
        <div class="form-group">
          <label class="col-lg-2 control-label" for="inputEmail"> Usuario </label>
          <div class="col-lg-10">
            <input id="inputEmail" class="form-control" type="text" placeholder="Usuario" name="login">
            </input>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label" for="inputPassword"> Senha </label>
          <div class="col-lg-10">
            <input id="inputPassword" class="form-control" type="password" placeholder="Password" name="senha">
            </input>
          </div>
          <div class="col-lg-10 col-lg-offset-2">
            <button class="btn btn-primary" type="submit">Submit</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>
<?php	
	if(isset($_SESSION['error'])) {
			echo "<div class='col-lg-4'>
    <div class='alert alert-dismissable alert-danger' >
        <button class='close' data-dismiss='alert' type='button'> ×
        </button>  <strong>
           USUARIO OU SENHA INCORRETOS
        </strong>              
   </div>
</div>";
	}
	
	} else {
?>
<?php if(isset($_SESSION['user'])) { echo "Bem vindo ". $_SESSION['user']; } header('Location: home.php');?>
<?php } ?>
</body>
</html>
