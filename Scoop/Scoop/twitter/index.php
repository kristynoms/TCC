<?php
require_once "twitter_api_pkg/twitter_config.php"; //twitter configuration file
require_once "twitter_api_pkg/classes/twitterapirequest.php"; //twitter api class
require_once "twitter_api_pkg/functions/twitter_user_timeline.php"; //twitter user timeline functions
require_once "twitter_api_pkg/functions/twitter_search.php"; //twitter search functions
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Twitter</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
<script src="twitter_api_pkg/javascript/location_map_finder.js"></script>
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
   

 <?php
/**
show the twitter search form
first variable /test.php = URL where search results will appear
second variable true or false. True shows a language select menu
third variable true or false. True shows a result_type select
fourth variable true or false. True shows distance inputs
fifth variable true or false. True shows google map
sixth variable takes the $_GET variables and looks through them in order to populate form fields with entered info
*/
echo twitter_generate_search_form('index.php',false,true,true,true,$_GET);
?>

<?php 
/**
Below function shows search results
$_GET variable is used for search term, sort type, geocode and distance
*/
echo twitter_search_php($_GET);
?>



         
        </div>
        
    </div>
</div>
</body>
</html>
