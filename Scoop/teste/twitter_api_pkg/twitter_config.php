<?php
define('TWITTER_API_PKG_DIR','teste/');//specify where this plugin is located on your server. If in the root, leave as is.
/**
configuration below is for Twitter API
*/
define('TWITTER_CONSUMER_KEY', '0h6tpgkuF2Mhabhqisrvur1sn'); //replace *Consumer key with your consumer key
define('TWITTER_CONSUMER_SECRET', '2yc5unFwKYHqTbtOTYzxypUh6CqEVBpWTUfxVmOafS7lCnIOlz'); //replace *Consumer secret with your consumer secret
define('TWITTER_ACCESS_TOKEN', '40692343-79V438PpYqHImsyL2VhHyv58wXAi6mJtsKy39eTUu'); //replace *Access token with your access token
define('TWITTER_ACCESS_TOKEN_SECRET', 'UM8xcjJdK2Tgo7uVuE7JyhYToKETEvMoP75gNhNAAVokq'); //replace *Access token secret with your access token secret
/**
configuration below is for Twitter timeline results
*/
define('TWITTER_CACHE_FOLDER', 'twitter_api_pkg/caches/twitter-'); //the cache directory. leave titter- because it's part of file... change only the directories if needed
define('TWITTER_CACHE_TWEETS', true); //cache tweets true or false
define('TWITTER_CACHE_TIME', 5); //cache time in seconds for minutes enter in seconds. Example 2 minutes = 120 seconds
define('TWITTER_USER_TIMELINE_COUNT', 5); //how many results do you want to show? Max is 200...
define('TWITTER_USER_TIMELINE_HYPERLINK_URLS', true); //do you want to hyperlink URLs in tweets? True or false.
define('TWITTER_USER_TIMELINE_HYPERLINK_HASHTAGS', true); //do you want to hyperlink hashtags in tweets? True or false.
define('TWITTER_USER_TIMELINE_HYPERLINK_USER_MENTIONS', true); //do you want to hyperlink user mentions in tweets? True or false.
/**
configuration below is for Twitter search results
*/
define('TWITTER_CACHE_SEARCH_FOLDER', 'twitter_api_pkg/caches/twitter-'); //the cache directory. leave titter- because it's part of file... change only the directories if needed
define('TWITTER_CACHE_SEARCH', true); //cache tweets true or false
define('TWITTER_CACHE_SEARCH_TIME', 5); //cache time in seconds for minutes enter in seconds. Example 2 minutes = 120 seconds
define('TWITTER_SEARCH_COUNT', 15); //How many tweets do you want displayed? default is 15 and max is 100 if you set lower than 15, some results will be removed by script.
define('TWITTER_SEARCH_HYPERLINK_URLS', true); //do you want to hyperlink URLs in tweets? True or false.
define('TWITTER_SEARCH_HYPERLINK_HASHTAGS', true); //do you want to hyperlink hashtags in tweets? True or false.
define('TWITTER_SEARCH_HYPERLINK_USER_MENTIONS', true); //do you want to hyperlink user mentions in tweets? True or false.
/**
How do you want the search results sorted? Mixed by default. Add comments to define('TWITTER_SEARCH_RESULTS_TYPE', 'mixed'); and uncomment another if you don't want mixed results
*/
define('TWITTER_SEARCH_RESULTS_TYPE', 'mixed');
//define('TWITTER_SEARCH_RESULTS_TYPE', 'recent');
//define('TWITTER_SEARCH_RESULTS_TYPE', 'popular');
?>