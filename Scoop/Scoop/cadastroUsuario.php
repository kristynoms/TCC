<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cadastro</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<?php
require "validaAdmin.php";
?>
</head>
<script>
function msg() {
 alert("Cadastro Efetuado!");
 
          CadUsuario.submit();
  
     
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
  <div class="well2">
    <form action="cadastroUsuarioDados.php" method="post" class="bs-example form-horizontal" name="CadUsuario">
      <fieldset>
        <legend>Cadastro de Usuários</legend>
        <div class="form-group">
          <label class="col-lg-2 control-label" for="inputNome" > Nome </label>
          <div class="col-lg-10">
            <input id="inputNome" class="form-control" type="text" placeholder="Nome" name="nome">
            </input>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label" for="inputIdade"> Idade </label>
          <div class="col-lg-10">
            <input id="inputIdade" class="form-control" type="text" placeholder="Idade" name="idade">
            </input>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label" for="sexo">sexo</label>
          <div class="col-lg-10">
            <select id="sexo" class="form-control" name="sexo">
              <option> - </option>
              <option> Masculino </option>
              <option>Feminino </option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label" for="inputEmail"> Email </label>
          <div class="col-lg-10">
            <input id="inputEmail" class="form-control" type="text" placeholder="Email" name="email">
            </input>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label" for="inputLogin"> Login </label>
          <div class="col-lg-10">
            <input id="inputLogin" class="form-control" type="text" placeholder="Login" name="login">
            </input>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-2 control-label" for="inputSenha"> Senha </label>
          <div class="col-lg-10">
            <input id="inputSenha" class="form-control" type="password" placeholder="Senha" name="senha">
            </input>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button class="btn btn-default">Cancel</button>
            <button class="btn btn-primary" onclick="msg()" >Submit</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
    </div>
</div>
</body>
</html>
