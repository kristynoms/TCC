<?php
require_once "twitter_api_pkg/twitter_config.php"; //twitter configuration file
require_once "twitter_api_pkg/classes/twitterapirequest.php"; //twitter api class
require_once "twitter_api_pkg/functions/twitter_user_timeline.php"; //twitter user timeline functions
require_once "twitter_api_pkg/functions/twitter_search.php"; //twitter search functions
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Democode</title>
<link rel="stylesheet" type="text/css" href="twitter_api_pkg/twitter.css">
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
<script src="twitter_api_pkg/javascript/location_map_finder.js"></script>
<!-- this style code is just here so that the example file looks a little prettier... You can leave this out. -->
<style>
body{
	background:#F7F7F7; color:#171717;
	font:normal 13px/20px Georgia, "Times New Roman", Times, serif;
	margin:0; padding:0;}
#body{
	width:683px; margin:0 auto; padding:0 0 60px 0;
	}
button.twitter_search{ display: inline-block; border: none; height: 29px; padding: 0px 17px; cursor: pointer; font:12px arial,sans-serif; color: #ffff; text-align: center; background: url(twitter_api_pkg/icons/submit-button.png) repeat-x; color: #fff; vertical-align: top;width:100%;}
h1,h2,h3,h4{
	font:bold italic 16px/18px Georgia, "Times New Roman", Times, serif;
	color:#3D5C32; background-color:#F7F7F7;}
input{ width:100px; height: 20px; vertical-align: top;}
</style>
<!-- end this style code is just here so that the example file looks a little prettier... You can leave this out. -->
</head>
<body>
<div id="body">
<h1>Twitter search form example</h1>
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
echo twitter_generate_search_form('index.php',true,true,true,true,$_GET);
?>
<h2>Where Twitter search results will appear after you submit your search</h2>
<?php 
/**
Below function shows search results
$_GET variable is used for search term, sort type, geocode and distance
*/
echo twitter_search_php($_GET);
?>

</div>
</body>
</html>
