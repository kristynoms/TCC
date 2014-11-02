<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css" />

    
</head>
<body>
<?php  if(isset($_SESSION['user'])) { ?>
<a href="logout.php">
<button class="btn btn-primary btn-xs" type="button" >Logout</button>
</a>
<button class="btn btn-primary btn-xs" type="button" ><?php echo  strtoupper("Bem Vindo: ".$_SESSION['user']."")  ?></button>
<?php } ?>
<div class="page-header">
</div>
<div class="container">
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <button class="navbar-toggle" data-target=".navbar-inverse-collapse" data-toggle="collapse" type="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    </div>
    <?php include('../menu/menu_tw.php')?>
</div>

<?php 
	$pesquisa = $_REQUEST["pesqT"];
	echo "<h3>Procurando: <span id='palavra'>".$pesquisa."</span></h3>";
?>

<?php 
 include("getSearchResults2.html");
?>

<a href="twitter.php" ><img src="../imgs/arrow_back_blue_2.png" width="50" >  </a>

<script type="text/javascript">
$(document).ready(function() {
		
		$('#tweets-search-recent').html("");
		
		// Get the 5 most recent tweets with keyword: test
		var keyword = $("#palavra").html();
		var searchtype = "recent";
		var tweets = "20";
		
		
		$.get('http://www.projetokristy.com.br/Scoop/twitter/twitter_api.php?type=search&searchtype=' + searchtype + '&q=' + encodeURIComponent(keyword) + '&count=' + tweets, function (jsondata) {
		
			// Parse JSON
			var data = $.parseJSON(jsondata);
			var i = 0;
			
			
			// Append to content
			$.each(data, function() {
				i++;
				$('#tweets-search-recent').append('<tr>+<td><img src="' + this['avatar'] + '" /></td>+<td>' + this['username'] + '</td><td>' + this['tweet'] + '</td><td>' + this['date'] + '</td><td>'  + '</td><tr>');
						});
						
						
			
		});
			
		
	}); </script>

</body>
</html>


<?php

include '../conexao.php';
$query = "INSERT INTO pesq (pesq)
 
VALUES ('$pesquisa')";

mysql_query($query);
$id = mysql_insert_id();




?>
<?php
// Turn off all error reporting
error_reporting(0);
?>
