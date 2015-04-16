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
function hyperlink($string)
{
    $content_array = explode(" ", $string);
    $output = '';

    foreach($content_array as $content) //loop through the tweet word by word
    {
         //starts with http:// or https://
        if( (substr($content, 0, 7) == "http://" || substr($content, 0, 8) == "https://") && ctype_alnum(substr($content, -3)) )
		{
            $content = '<a href="' . $content . '" target="_blank">' . $content . '</a>'; //create the link
        }
        $output .= " " . $content; //reconstruct the tweet
    }

    $output = trim($output);
    return $output;
}

/**
emphasize the search term in the tweets
*/
function highlight($str, $keywords = '')
{
    $keywords = preg_replace('/\s\s+/', ' ', strip_tags(trim($keywords))); // filter

    $style = 'highlight';
    $style_i = 'highlight_ul';

    $var = '';
    $replacement = $str;

/** 
Apply Style 
*/

    $replacement = str_ireplace($keywords, '<span class='.$style_i.'>'.$keywords.'</span>', $replacement);
	
    /**
	loop through the keywords and emphasize them
	*/
    foreach(explode(' ', $keywords) as $keyword)
    {

        if(($replacement != '') && ($replacement != 'NULL') && ($keyword != '') && ($keyword != 'NULL')){
            if(stristr($replacement, ' '.trim($keyword). ' ') && !stristr($replacement, trim($keywords))){
                $keyword = ' '.trim($keyword). ' ';
                $replacement = str_ireplace($keyword, ' <span class='.$style.'>'.$keyword.'</span> ', trim($replacement));
            }elseif(stristr($replacement, ' '.trim($keyword)) && !stristr($replacement, trim($keywords))){
                $keyword = ' '.trim($keyword);
                $replacement = str_ireplace($keyword, ' <span class='.$style.'>'.$keyword.'</span> ', trim($replacement));
            }elseif(stristr($replacement, trim($keyword).' ') && !stristr($replacement, trim($keywords))){
                $keyword = trim($keyword).' ';
                $replacement = str_ireplace($keyword, ' <span class='.$style.'>'.$keyword.'</span> ', trim($replacement));
            }
        }

    $replacement = str_replace('<span class='.$style.'> ','<span class='.$style.'>',$replacement);
    $replacement = str_replace(' </span>','</span>',$replacement);
    $replacement = trim($replacement);
    }

    return $replacement;
}

/**
show twitter search results
*/
function get_twitter_search_results($query,$lang='',$result_type='',$geo='')
{
    /**
	check if we need to filter with a language
	*/
    if(strlen($lang) == 2){
        $lang = '&lang='.$lang;
    }else{
        $lang = '';
    }

    /**
	check if we need to filter with the geocode
	*/
    if(preg_match('([0-9\-\.]{1,}[\,][0-9\-\.]{1,}[\,][0-9]{1,}(mi|km))',$geo)){
        $geo = '&geocode='.$geo;
    }else{
        $geo = '';
    }

    $twitter_activity = '';

    /**
	sanitize the search query
	*/
    $clean_query = strip_tags($query);
    $clean_query = stripslashes($query);
    $clean_query = urlencode($clean_query);

    // define the cache file you created
    $cache_folder = constant("TWITTER_CACHE_SEARCH_FOLDER").'search-'.md5($clean_query.$lang.(($result_type == 'mixed' || $result_type == 'popular' || $result_type == 'recent')?$result_type:constant("TWITTER_SEARCH_RESULTS_TYPE"))).$geo.'.html';

    // check to see if the cache is older than time specified in config file
    // if so, refresh the data
    if(file_exists($cache_folder) && constant("TWITTER_CACHE_SEARCH") == true)
	{
        $cache_time = filemtime($cache_folder);
    }else{
        $cache_time = 0;
    }
    
	$time_to_wait = time() - (constant("TWITTER_CACHE_SEARCH_TIME") * 60);
	/**
	if our cache file is still fresh show it
	*/
    if ($cache_time > $time_to_wait && constant("TWITTER_CACHE_SEARCH") == true)
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
       $url = 'https://api.twitter.com/1.1/search/tweets.json';
       $getfield = '?q='.$clean_query.$geo.'&count='.constant("TWITTER_SEARCH_COUNT").'&result_type='.(($result_type == 'mixed' || $result_type == 'popular' || $result_type == 'recent')?       $result_type:constant("TWITTER_SEARCH_RESULTS_TYPE")).'&include_entities=1'.$lang;
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
           if(!empty($json->statuses)){
               $i=1;
	           foreach ($json->statuses as $tweet) : 
	               $datetime = $tweet->created_at;
		           $date = date('M d, Y', strtotime($datetime));
		           $time = date('g:ia', strtotime($datetime));
		           $tweet_text = $tweet->text;
                   //empahasize keywords
                   $tweet_text = highlight($tweet_text, $query);
                   // check if any entites exist and if so, replace then with hyperlinked versions
		               if (!empty($tweet->entities->urls) || !empty($tweet->entities->hashtags) || !empty($tweet->entities->user_mentions)) {
			               if(constant("TWITTER_SEARCH_HYPERLINK_HASHTAGS") == true){				
			                   foreach ($tweet->entities->hashtags as $hashtag) {
				                   $find = '#'.$hashtag->text;
				                   $replace = '<a href="https://twitter.com/search?q=%23'.$hashtag->text.'" target="_blank">'.$find.'</a>';
				                   $tweet_text = str_replace($find,$replace,$tweet_text);
			                   }
			                }
			           /**
					   should we hyper links user mentions?
					   */
			               if(constant("TWITTER_SEARCH_HYPERLINK_USER_MENTIONS") == true){				
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
					  if(constant("TWITTER_SEARCH_HYPERLINK_URLS") == true){
			              $tweet_text = hyperlink($tweet_text);
			          }else{
			              $tweet_text = $tweet_text;
			          }
    
    	           if($i <= constant("TWITTER_SEARCH_COUNT")){
	                   $twitter_activity .= 
					   '<div class="tweet">
		                <div class="tweet_pic"><img src="'.$tweet->user->profile_image_url.'" align="left" class="imagepad" border="0" alt="'.'@'.$tweet->user->screen_name.'" title="'.'@'.$tweet->user->screen_name.'" width="48" height="48" onerror="this.style.display=\'none\'"></div>
        <div class="tweet_name"><strong>'.$tweet->user->name.'</strong> <small>@'.$tweet->user->screen_name.'</small><br />'. $tweet_text.'<br /><small>'. $time.', '. $date.'</small> </div>
                        </div>';	
	               }
	               $i++;			
	           endforeach;
		}
			   
           if(isset($twitter_activity) && $twitter_activity != ''){
		   /**
		   write to file if we are caching results
		   */
               if(constant("TWITTER_CACHE_SEARCH") == true){
	               $cachefile = fopen($cache_folder, 'w');
	               fwrite($cachefile, $twitter_activity);
	               fclose($cachefile);
	            }
	        return $twitter_activity;
		    }
	    }	
    }
 }

/**
function that prepares data for twitter request
*/	
function twitter_search_php($twitter_search_query,$lang='',$result_type='',$geo='')
{

    /**
    check for language code filter
    */
    if(strlen($lang) == 2){
        $lang = $lang;
    }else{
        $lang = '';
    }
	
    /**
    check for results type filter
    */
    if($result_type == 'mixed' || $result_type == 'recent' || $result_type == 'popular'){
        $result_type = $result_type;
    }else{
        $result_type = '';
    }
	
    /**
    check for geocode filter
    */
    if(preg_match('([0-9\-\.]{1,}[\,][0-9\-\.]{1,}[\,][0-9]{1,}(mi|km))',$geo)){
        $geo = $geo;
    }else{
        $geo='';
    }
	
    /**
	check if array matches these values and make sure they are properly formated
	*/
    if(is_array($twitter_search_query)){
	    /**
        check for language code filter
        */
        if(isset($twitter_search_query['lang']) && strlen($twitter_search_query['lang']) == 2){
            $lang = $twitter_search_query['lang'];
        }
        /**
        check for results type filter
        */
		if(isset($twitter_search_query['result_type']) && ($twitter_search_query['result_type'] == 'mixed' || $twitter_search_query['result_type'] == 'recent' || $twitter_search_query['result_type'] == 'popular')){
             $result_type = $twitter_search_query['result_type'];
        }

        /**
        check for geocode filter and construct the input data
        */

       if(isset($twitter_search_query['lat']) && is_numeric($twitter_search_query['lat'])){
           $geo .= $twitter_search_query['lat'];
       }

       if(isset($twitter_search_query['lon']) && is_numeric($twitter_search_query['lon'])){
           $geo .= ','.$twitter_search_query['lon'];
       }

       if(isset($twitter_search_query['distance']) && is_numeric($twitter_search_query['distance'])){
           $geo .= ','.$twitter_search_query['distance'];
       }

       if(isset($twitter_search_query['mikm']) && ($twitter_search_query['mikm'] == 'mi' || $twitter_search_query['mikm'] == 'km')){
           $geo .= $twitter_search_query['mikm'];
       }

      /**
	  
	  */
      
	  /**
	  if we have keywords we proceed in getting results. If not, we just return nothing.
	  */
      if(isset($twitter_search_query['twitter_keywords'])){
           $twitter_search_query = $twitter_search_query['twitter_keywords'];
      }else{
           return '';
      }
   }

   /**
   since we've made it here, we make a request for data
   */
   $twitter_activity = get_twitter_search_results($twitter_search_query,$lang,$result_type,$geo);

   /**
   check the data that was returned to us and show results if we've got them
   */
   if($twitter_activity != ''){
       $show_twitter_activity = '<div id="twitter_search_results">';
       $show_twitter_activity .= '<div><strong>Resultados para: </strong> '.$twitter_search_query.'</div>';
       $show_twitter_activity .= '<div id="tweets">'. $twitter_activity.'</div>';
       $show_twitter_activity .= '<div style="clear:both;"></div></div>';
   }else{
       $show_twitter_activity = '<div id="twitter_search_results"><div id="tweets">Sem resultados para: '.$twitter_search_query.'</div><div style="clear:both;"></div></div>';
   }

   return $show_twitter_activity;

}

/**
construct jquery code for head section
*/
function twitter_search_jquery($twitter_search_query,$sec='',$lang='',$result_type='',$geo='')
{
    $jquery_code = '<script type="text/javascript">
                   $(document).ready(function(){
                   (function GetTwitterActivity() {
                   var searchquery = "'.$twitter_search_query.'";'."\n";

    /**
	do we do filter by language code?
	*/
	if(strlen($lang) == 2){
        $jquery_code .= 'var language = "&language='.$lang.'";'."\n";
    }else{
        $jquery_code .= 'var language = "";'."\n";
    }

    /**
	do we do filter by results type?
	*/
    if($result_type == 'mixed' || $result_type == 'popular' || $result_type == 'recent'){
        $jquery_code .= 'var result_type = "&result_type='.$result_type.'";'."\n";
    }else{
        $jquery_code .= 'var result_type = "";'."\n";
    }

    /**
	do we do filter by geocode?
	*/
    if(preg_match('([0-9\-\.]{1,}[\,][0-9\-\.]{1,}[\,][0-9]{1,}(mi|km))',$geo)){
        $jquery_code .= 'var geocode = "&geocode='.$geo.'";'."\n";
    }else{
        $jquery_code .= 'var geocode = "";'."\n";
    }

    $jquery_code .= '$.ajax({
                     url: "'.constant("TWITTER_API_PKG_DIR").'twitter_api_pkg/twitter_search_request.php?q="+encodeURIComponent(searchquery)+language+result_type+geocode, 
                     success: function(data) {
                     $(\'div#twitter_search_results_jquery\').html(data);
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

/**
build the twitter search form
*/
function twitter_generate_search_form($url,$show_lang,$result_type,$show_distance,$showmap,$get=''){
    $keywords = '';
	
	/**
	we inspect the $_GET for variables that we sent by the form so that we can populate each input field. Note that we make sure that the variables are clean.
	*/
    if(is_array($get)){
        if(isset($get['twitter_keywords']) && $get['twitter_keywords'] != ''){
            $keywords = stripslashes(urldecode($get['twitter_keywords']));
        }

        if(isset($get['lang']) && strlen($get['lang']) == 2){
            $lang = $get['lang'];
        }else{
            $lang = 'all';
        }

        if(isset($get['result_type']) && ($get['result_type'] == 'mixed' || $get['result_type'] == 'recent' || $get['result_type'] == 'popular')){
            $result_type = $get['result_type'];
        }

        if(isset($get['lat']) && is_numeric($get['lat'])){
            $lat = $get['lat'];
        }else{
            $lat = '';
        }

        if(isset($get['lon']) && is_numeric($get['lon'])){
            $lon = $get['lon'];
        }else{
            $lon = '';
        }

       if(isset($get['distance']) && is_numeric($get['distance'])){
            $distance = $get['distance'];
       }else{
            $distance = '';
       }

       if(isset($get['mikm']) && ($get['mikm'] == 'mi' || $get['mikm'] == 'km')){
            $mikm = $get['mikm'];
       }else{
            $mikm = '';
       }
   }
   /**
   Now we prepare the actual form for output
   */

   $the_form = '<form action="'.$url.'" method="get">
               Pesquisa: <input type="text"  name="twitter_keywords" value="'.htmlentities($keywords).'" />';
   if($show_lang == true){
   /**
   this just makes sure that the previously selected value for language is shown
   */
       $the_form .= str_replace('value="'.$lang.'"','value="'.$lang.'" selected',' Language: <select name="lang">
                                 <option value="all">Any</option>
                                 <option value="am">Amharic</option>
                                 <option value="ar">Arabic</option>
                                 <option value="hy">Armenian</option>
                                 <option value="bn">Bengali</option>
                                 <option value="bg">Bulgarian</option>
                                 <option value="chr">Cherokee</option>
			                     <option value="zh">Chinese</option>
                                 <option value="da">Danish</option>
			                     <option value="nl">Dutch</option>
			  			  		 <option value="en">English</option>
                                 <option value="de">German</option>
			                     <option value="ka">Georgian</option>
			                     <option value="el">Greek</option>
                                 <option value="gu">Gujarati</option>
                                 <option value="fi">Finnish</option>
                                 <option value="fr">French</option>
                                 <option value="iw">Hebrew</option>
                                 <option value="hi">Hindi</option>
                                 <option value="hu">Hungarian</option>
                                 <option value="is">Icelandic</option>
			                     <option value="in">Indonesian</option>
			                     <option value="iu">Inuktitut</option>
                                 <option value="it">Italian</option>
                                 <option value="ja">Japanese</option>
                                 <option value="kn">Kannada</option>
			                     <option value="km">Khmer</option>
                                 <option value="ko">Korean</option>
                                 <option value="lo">Lao</option>
                                 <option value="lt">Lithuanian</option>
                                 <option value="ml">Malayalam</option>
			                     <option value="dv">Maldivian</option>
                                 <option value="my">Myanmar</option>
                                 <option value="ne">Nepali</option>
                                 <option value="no">Norwegian</option>
                                 <option value="or">Oriya</option>
                                 <option value="pa">Panjabi</option>
                                 <option value="pl">Polish</option>
                                 <option value="pt">Portuguese</option>
			                     <option value="fa">Persian</option>
                                 <option value="ru">Russian</option>
                                 <option value="si">Sinhala</option>
			                     <option value="es">Spanish</option>
                                 <option value="sv">Swedish</option>
			                     <option value="tl">Tagalog</option>
			                     <option value="ta">Tamil</option
			                     <option value="te">Telugu</option>
			                     <option value="th">Thai</option>
			                     <option value="bo">Tibetan</option>
                                 <option value="tr">Turkish</option>
                                 <option value="ur">Urdu</option>
                                 <option value="vi">Vietnamese</option>
                                 </select>');
   }

   /**
   this just makes sure that the previously selected value for results type is shown
   */
   if($result_type == true){
       $the_form .= str_replace('value="'.$result_type.'"','value="'.$result_type.'" selected',' Ordenar: <select id="result_type" name="result_type">
                                 <option value="recent">Recente</option>
                                <option value="popular">Popular</option>
                                </select>');
   }
   
   /**
   shows operator help information
   */
   /** $the_form .= '<script type="text/javascript">
	            function showHelpText(el)
	            {
		         myEl = document.getElementById(el);
		         myEl.style.display = (myEl.style.display == \'block\') ? \'none\' : \'block\';
	             }
                </script> (<a class="help_link" href="javascript:void(0);" onclick="showHelpText(\'help\');">About Search Operators</a>)<table id="help"><tr><td>Twitter Search Operators                </td></tr><tbody>
               <tr><td><strong>twitter search</td><td>containing both "twitter" and "search". This is the default operator.</strong></td></tr>
               <tr><td><b>"</b>happy hour<b>"</b></td><td>containing the exact phrase "happy hour".</td></tr>
               <tr><td>love <b>OR</b> hate</td><td>containing either "love" or "hate" (or both).</td></tr>
               <tr><td>beer <b>-</b>root</td><td>containing "beer" but not "root".</td></tr>
               <tr><td><b>#</b>haiku</td><td>containing the hashtag "haiku".</td></tr>
               <tr><td><b>from:</b>alexiskold</td><td>sent from person "alexiskold".</td></tr>
               <tr><td><b>to:</b>techcrunch</td><td>sent to person "techcrunch".</td></tr>
               <tr><td><b>@</b>mashable</td><td>referencing person "mashable".</td></tr>
               <tr><td>"happy hour" <b>near:</b>"san francisco"</td><td>containing the exact phrase "happy hour" and sent near "san francisco".</td></tr>
               <tr><td><b>near:</b>NYC <b>within:</b>15mi</td><td>sent within 15 miles of "NYC".</td></tr>
               <tr><td>superhero <b>since:</b>2010-12-27</td><td>containing "superhero" and sent since date "2010-12-27" (year-month-day).</td></tr>
               <tr><td>ftw <b>until:</b>2010-12-27</td><td>containing "ftw" and sent up to date "2010-12-27".</td></tr>
               <tr><td>movie -scary <b>:)</b></td><td>containing "movie", but not "scary", and with a positive attitude.</td></tr>
               <tr><td>flight <b>:(</b></td><td>containing "flight" and with a negative attitude.</td></tr>
               <tr><td>traffic <b>?</b></td><td>containing "traffic" and asking a question.</td></tr>
               <tr><td>hilarious <b>filter:links</b></td><td>containing "hilarious" and linking to URLs.</td></tr>
               <tr><td>news <b>source:twitterfeed</b></td><td>containing "news" and entered via TwitterFeed</td></tr>
               </tbody></table>';

   /**
   should we show the google map? */
   
    if($show_distance == true && $showmap == true){
        $the_form .= '<div id="map_holder">
                      <div id="map_help">Pesquisa por lugar</div>
                      <div id="panel">
                      <input id="target" type="text" placeholder="Search Box">
                      </div>
                      <div id=\'map_canvas\'></div>
                      </div>';

    }
	
   /**
   should we show the geocode input fields?
   */	  
   if($show_distance == true){		  
       $the_form .= '<div id="location">Latitude: <input type="text" id="lat" name="lat" value="'.$lat.'" size="20" onclick="changeSort();" /> Longitude: <input type="text" id="lon" name="lon" value="'.$lon.'" size="20" onclick="changeSort();" /> Distância: <input type="text" name="distance" value="'.(($distance == '')?100:$distance).'" size="5" /> <select name="mikm">';
       $the_form .= str_replace('value="'.$mikm.'"','value="'.$mikm.'" selected','<option value="mi">Milhas</option>
           <option value="km">Quilometros</option>
          </select></div>');
   }
		  
   $the_form .= '<button class="btn btn-primary" type="submit">Search</button>
                </form>';

   return $the_form;
}
?>

   <?php

 session_start();
 	$pesq =  $_GET['twitter_keywords'];
	$date = date('Y-m-d H:i:s');
 	$user = $_SESSION['user'];
include '../../conexao.php';
$query = "INSERT INTO pesquisas_audit (pesquisa,usuario,data_pesquisa) 
 
VALUES ('$pesq','$user','$date')";

mysql_query($query);

?>