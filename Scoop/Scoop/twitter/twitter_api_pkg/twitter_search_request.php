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
require_once "twitter_config.php";//twitter configuration file
require_once "classes/twitterapirequest.php"; //twitter api class
require_once "functions/twitter_search.php"; //twitter search functions

/**
get the search variables
*/
$search_query = stripslashes(urldecode($_GET['q']));
    if($_GET['language']){
        $lang = $_GET['language'];
    }
    if($_GET['result_type']){
        $result_type = $_GET['result_type'];
    }
    if($_GET['geocode']){
        $geo = $_GET['geocode'];
    }

/**
send to the function for preparation and processing
*/
echo twitter_search_php($search_query,$lang,$result_type,$geo);
?>