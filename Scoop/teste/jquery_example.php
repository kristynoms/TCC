<?php
require_once "twitter_api_pkg/twitter_config.php"; //twitter configuration file
require_once "twitter_api_pkg/functions/twitter_user_timeline.php"; //twitter user timeline functions
require_once "twitter_api_pkg/functions/twitter_search.php"; //twitter search functions
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Democode</title>
<link rel="stylesheet" type="text/css" href="twitter_api_pkg/twitter.css">
<script src="twitter_api_pkg/javascript/jquery-1.10.2.min.js"></script>
<?php 
/** get the user timeline for the user
first variable is the Twitter screen name
second variable is the number of seconds for auto refresh
*/
echo twitter_user_timeline_jquery('envato',0);
/** get twitter search results
first variable is the search term
second variable is the number of seconds for auto refresh
third variable is the language code
fourth variable is the results type
fourth variable is the geocode
*/
echo twitter_search_jquery('traffic',0,'en','recent','40.757332,-73.955556,10mi');
?>
<!-- this style code is just here so that the example file looks a little prettier... You can leave this out. -->
<style>
body{
	background:#F7F7F7; color:#171717;
	font:normal 13px/20px Georgia, "Times New Roman", Times, serif;
	margin:0; padding:0;}
#body{
	width:683px; margin:0 auto; padding:0 0 60px 0;
	}
button{ display: inline-block; border: none; height: 29px; padding: 0px 17px; cursor: pointer; font:12px arial,sans-serif; color: #ffff; text-align: center; background: url(twitter_api_pkg/icons/submit-button.png) repeat-x; color: #fff; vertical-align: top;}
h1,h2,h3,h4{
	font:bold italic 16px/18px Georgia, "Times New Roman", Times, serif;
	color:#3D5C32; background-color:#F7F7F7;}
</style>
<!-- end this style code is just here so that the example file looks a little prettier... You can leave this out. -->
</head>
<body>
<div id="body">
<h1>jQuery Twitter search form example</h1>
<div id="twitter_search_results_jquery"></div>
<h2>jQuery Twitter user timeline example</h2>
<div id="timeline_tweets_jquery"></div>
</div>
</body>
</html>
