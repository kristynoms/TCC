<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Twitter</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
<?php
require "../valida.php";
?>
</head>

<body>
<?php  if(isset($_SESSION['user'])) { ?>
<a href="../logout.php">
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
    <?php include('../menu/menu_tw.php')?>
</div>
<div class="bs-example">
    <div class="jumbotron">
        <h2> Pesquisar: </h2>
        <p>Inicie sua busca aqui:</p>
        </br>
            <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"></h3>
            </div>
            <div class="panel-body">
                <form action="twitterSearch.php" method="post">
                    <div class="form-group">
                    <label class="control-label" for="inputDefault">Twitter</label>
                    <input class="form-control" id="inputDefault" name="pesqT" type="text">
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default" type="reset">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>
</body>
</html>
