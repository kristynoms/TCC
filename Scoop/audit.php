<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<?php
require "validaAdmin.php";
?>
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
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
             $result=mysql_query('select * from pesquisas_audit where pesquisa <> "" and usuario <> "" ');
			  while($row=mysql_fetch_array($result)){
           echo" <div class='bs-example table-responsive'>
           <table class='table table-striped table-bordered table-hover'>
           <thead>
           <tr>
           <th>  Nome </th>
           <th>  Pesquisa </th>
            </tr>
           </thead>
           <tbody>		  
           <tr>
           <td>".$row['usuario']."  </td>
           <td> ".$row['pesquisa']." </td>
           
		 </tr>
           </tbody>";
		   }
		   ?>
    </div>
</div>
</body>
</html>
