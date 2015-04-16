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
 <div class="panel-body">
          <div class="row">
            <div class="col-xs-6 col-md-6"> <a href="listaUsuario.php" class="btn btn-success btn-lg" role="button">Usuários</a> 
			<a href="audit.php" class="btn btn-info btn-lg" role="button"> Auditoria</a>  </div>
          </div>
        </div>
    </div>
</div>
</body>
</html>
