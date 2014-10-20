<?php
session_start();
require_once("twitteroauth/twitteroauth.php"); //Path to twitteroauth library
 


$search = '#inter';
$notweets = 30;
$consumerkey = "OkmjsMCElHaPLmUlORbD5GOK3";
$consumersecret = "U8xRTAnvTTU7W0xSTl5rQUWxvnGudKyLoMnxyUwxxvEMCGn0ga";
$accesstoken = "40692343-VUYqkHN36iBQqfWvrSjLVVEnnGbXHd6LIIPv8awV7";
$accesstokensecret = "e1phMnk8eMDjf60oNShNTo9ItaogbwM3034Am5yTEDu0q";
  
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
   
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$search = str_replace("#", "%23", $search);
$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=".$search."&count=".$notweets);

  echo json_encode($tweets);

?>

