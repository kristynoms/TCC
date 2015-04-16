<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />

<?php
require "valida.php";
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
<div class="bs-example">
    <div class="jumbotron">
    <h2>Bem Vindo ao Scoop! </h2>
	  <h4>Para iniciar sua pesquisa escolha uma das redes sociais abaixo: </h4>
	  </br>
	    </br>
		  </br>
	  <div align="center">
	  <table2 class=table2 classwidth="500" border="0">
  <tbody>
    <tr>
      
    <td scope="col"><a href="http://kristytcc.com/scoop/twitter/index.php"><img border="0"  src="imgs/tw.png" width="200" height="200"></a></td>
    <td scope="col"><a href="http://kristytcc.com/scoop/facebook/face.php"><img border="0"  src="imgs/fa.png" width="200" height="170"></a></td>
  </tr>
  </tbody>
</table2>
	  </div>

	  
	  
            </div>
        </div>
    </div>
</div>
</body>
</html>
