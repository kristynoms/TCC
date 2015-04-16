<?php
//PHP Twitter User Timeline & Search Plugin Version 1.0
//Created by: Danny Pajevic
//Mail: support@democode.net
//Copyright: Danny Pajevic
/*LICENSE CERTIFICATE : Envato Marketplace Item
==============================================
/this is protected under copyrights as defined in the standard terms and conditions on the Envato Marketplaces.

For any queries related to this document or license please contact Envato Support via http://support.envato.com/index.php?/Live/Tickets/Submit

Envato Pty. Ltd. (ABN 11 119 159 741)
PO Box 21177, Little Lonsdale Street, VIC 8011, Australia img
*/
/**
hyper link the links in tweets
*/
function hyperlink_timeline($string)
{
    $content_array = explode(" ", $string);
    $output = '';

    foreach($content_array as $content) //loop through the tweet word by word
    {
        //starts with http:// or https://
        if((substr($content, 0, 7) == "http://" || substr($content, 0, 8) == "https://") && ctype_alnum(substr($content, -3)))
		{
            $content = '<a href="' . $content . '" target="_blank">' . $content . '</a>'; //create the link
        }
        $output .= " " . $content; //reconstruct the tweet
    }

    $output = trim($output);
    return $output;
}

/**
show twitter timeline results
*/
function get_twitter_user_timeline($screen_name)
{
    $twitter_activity = '';

    // define the cache file you created
    $cache_folder = constant("TWITTER_CACHE_FOLDER").'user_timeline-'.md5($screen_name).'.html';

   // check to see if the cache is older than time specified in config file
   // if so, refresh the data
   if(file_exists($cache_folder) && constant("TWITTER_CACHE_TWEETS") == true)
   {
       $cache_time = filemtime($cache_folder);
   }else{
       $cache_time = 0;
   }
   
   $time_to_wait = time() - (constant("TWITTER_CACHE_TIME") * 60);
   
   /**
	if our cache file is still fresh show it
	*/
    if ($cache_time > $time_to_wait && constant("TWITTER_CACHE_TWEETS") == true)
    {
	    $twitter_activity = file_get_contents($cache_folder);
	    return $twitter_activity;
	/**
	else we request fresh data from twitter
	*/
	}else{

       /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
       $settings = array('oauth_access_token' => constant("TWITTER_ACCESS_TOKEN"),
                         'oauth_access_token_secret' => constant("TWITTER_ACCESS_TOKEN_SECRET"),
                         'consumer_key' => constant("TWITTER_CONSUMER_KEY"),
                         'consumer_secret' => constant("TWITTER_CONSUMER_SECRET"));
	
	  /** Perform a GET request and echo the response **/
      /** Note: Set the GET field BEFORE calling buildOauth(); **/
      $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
      $getfield = '?screen_name='.$screen_name.'&count='.constant("TWITTER_USER_TIMELINE_COUNT").'&include_entities=1&include_rts=1';
      $requestMethod = 'GET';
      $twitter = new TwitterAPIRequest($settings);
      $json = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
			 
      $json = json_decode($json);
	
    }

    // parses the data
    if (isset($json) && !empty($json)){
        if(!empty($json->errors)){
           foreach ($json->errors as $twitter_error){ 
               return '<div>'.$twitter_error->message.'</div>';
           }
        }else{
	        foreach ($json as $tweet) :
	        $datetime = $tweet->created_at;
		    $date = date('M d, Y', strtotime($datetime));
		    $time = date('g:ia', strtotime($datetime));
		    $tweet_text = $tweet->text;
		    // check if any entites exist and if so, replace then with hyperlinked versions
		    if (!empty($tweet->entities->urls) || !empty($tweet->entities->hashtags) || !empty($tweet->entities->user_mentions)) {
			    if(constant("TWITTER_USER_TIMELINE_HYPERLINK_HASHTAGS") == true){			
			        foreach ($tweet->entities->hashtags as $hashtag) {
				        $find = '#'.$hashtag->text;
				        $replace = '<a href="https://twitter.com/search?q=%23'.$hashtag->text.'" target="_blank">'.$find.'</a>';
				        $tweet_text = str_replace($find,$replace,$tweet_text);
			        }
			    }
			   /**
			   should we hyper links user mentions?
			   */
			   if(constant("TWITTER_USER_TIMELINE_HYPERLINK_USER_MENTIONS") == true){				
			       foreach ($tweet->entities->user_mentions as $user_mention) {
				       $find = "@".$user_mention->screen_name;
				       $replace = '<a href="https://twitter.com/'.$user_mention->screen_name.'" target="_blank">'.$find.'</a>';
				       $tweet_text = str_ireplace($find,$replace,$tweet_text);
			       }
		       }
		   }
		   /**
		   should we hyper links URLs?
		   */
		   if(constant("TWITTER_USER_TIMELINE_HYPERLINK_URLS") == true){
		       $tweet_text = hyperlink_timeline($tweet_text);
		   }
			    
           $twitter_activity .= '<div class="tweet">
		<div class="tweet_pic"><img src="'.$tweet->user->profile_image_url.'" align="left" class="imagepad" border="0" alt="'.'@'.$screen_name.'" title="'.'@'.$screen_name.'" width="48" height="48" onerror="this.style.display=\'none\'"></div>
        <div class="tweet_name"><strong>'.$tweet->user->name.'</strong> <small>@'.$screen_name.'</small><br />'. $tweet_text.'<br /><img src="'.constant("TWITTER_API_PKG_DIR").'twitter_api_pkg/icons/reply_arrow.png" border="0" onerror="this.style.display=\'none\'"> <small><a href="https://twitter.com/intent/tweet?in_reply_to='.$tweet->id.'" target="_blank">Reply</a></small> <img src="'.constant("TWITTER_API_PKG_DIR").'twitter_api_pkg/icons/retweet_arrows.png" border="0" onerror="this.style.display=\'none\'"> <small><a href="https://twitter.com/intent/retweet?tweet_id='.$tweet->id.'" target="_blank">Retweet</a></small> <img src="'.constant("TWITTER_API_PKG_DIR").'twitter_api_pkg/icons/favorite_star.png" border="0" onerror="this.style.display=\'none\'"> <small><a href="https://twitter.com/intent/favorite?tweet_id='.$tweet->id.'" target="_blank">Favorite</a></small><br /><small>'. $time.', '. $date.'</small> <small><a href="https://twitter.com/'.$screen_name.'/status/'.$tweet->id.'" target="_blank">Expand</a></small></div>
      </div>';				
	        endforeach;
			
        }
        if(isset($twitter_activity) && $twitter_activity != ''){
		    /**
		    write to file if we are caching results
		    */
            if(constant("TWITTER_CACHE_TWEETS") == true){
	            $cachefile = fopen($cache_folder, 'w');
	            fwrite($cachefile, $twitter_activity);
	            fclose($cachefile);
	        }
        }
	    return $twitter_activity;
	    }
}
	
/**
function that prepares data for twitter request
*/		
function twitter_user_timeline_php($twitter_screen_name)
{

/**
pass the twitter screen name to the get_twitter_user_timeline function
*/
$twitter_activity = get_twitter_user_timeline($twitter_screen_name);

/**
check the data that was returned to us and show results if we've got them
*/
if($twitter_activity != ''){
    $show_twitter_activity = '<div id="timeline_tweets">
<div class="merchantInfoText"><strong>Latest Tweets from</strong> <a href="http://twitter.com/'.$twitter_screen_name.'" alt="'.$twitter_screen_name.'" target="_blank">@'.$twitter_screen_name.'</a></div>
<!-- the line below displays the actual tweets -->
<div id="tweets">'. $twitter_activity.'</div>
<!-- end -->
<div style="clear:both;"></div>
</div>';
}else{
    $show_twitter_activity = '<div id="timeline_tweets"><div id="tweets">We were unable to retrieve the Twitter timeline of '.$twitter_screen_name.'</div><div style="clear:both;"></div></div>';
}
//end twitter user timeline

return $show_twitter_activity;

}

/**
construct jquery code for head section
*/
function twitter_user_timeline_jquery($twitter_screen_name,$sec='')
{

    $jquery_code = '<script type="text/javascript">
                   $(document).ready(function(){
                   (function GetTwitterActivity() {
                   var TwitterUser = "'.$twitter_screen_name.'";
                   $.ajax({
                   url: "'.constant("TWITTER_API_PKG_DIR").'twitter_api_pkg/twitter_user_timeline_request.php?u="+encodeURIComponent(TwitterUser), 
                   success: function(data) {
                   $(\'div#timeline_tweets_jquery\').html(data);
                   }';
	/**
	should we autorefresh?
	*/
	if(is_numeric($sec) && $sec > 0){
	    $jquery_code .= ',
                        complete: function() {
                        setTimeout(GetTwitterActivity, '. $sec*1000 .');
	                    }';
    }
    $jquery_code .= '});
                    })();
                    });
                    </script>';
    return $jquery_code;
}
?>