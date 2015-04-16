<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lista</title>
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
 <?php
		   include('conexao.php');
             $result=mysql_query('select * from usuarios');
			  while($row=mysql_fetch_array($result)){
           echo" <div class='bs-example table-responsive'>
           <table class='table table-striped table-bordered table-hover'>
           <thead>
           <tr>
           <th> Codigo </th>
           <th>  Nome </th>
           <th>  Idade </th>
           <th>  Sexo </th>
           <th>  Email </th>
           <th>  Login </th>
           <th>  Senha </th>
		    </tr>
           </thead>
           <tbody>
		  
           <tr>
           <td> ".$row['cod_user']." </td>
           <td> ".$row['nome']." </td>
           <td> ".$row['idade']." </td>
            <td> ".$row['sexo']." </td>
             <td> ".$row['email']." </td>
              <td> ".$row['login']." </td>
			   <td> ".$row['senha']." </td>
			   <td>  <a href=\"alteraUsuario.php?id=".$row['cod_user']."\"><button class='btn btn-primary btn-xs' type='button' >Alterar</button>
		</a> </td>
           </tr>
           </tbody>";
		   }
		   ?>
</body>
</html>
