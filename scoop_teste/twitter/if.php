<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Twitter</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
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
    <?php include('../menu/menu_tw.php')?>
</div>}
<div class="bs-example">
    <div class="jumbotron">
         <?php
            include "../neosmart-stream/setup.php";
            $nss->streamCSS();
            $nss->includeFile('jquery.js');
            $nss->streamJS();
            $nss->show();
        ?>
            </div>
        </div>
        
    </div>
</div>
</body>
</html>
