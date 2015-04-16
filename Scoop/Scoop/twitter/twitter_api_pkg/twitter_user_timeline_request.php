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
require_once "twitter_config.php"; //twitter configuration file
require_once "classes/twitterapirequest.php"; //twitter api class
require_once "functions/twitter_user_timeline.php"; //twitter user timeline functions

/**
get the screen name
*/
$twitter_screen_name = stripslashes(urldecode($_GET['u']));

/**
send to the function for preparation and processing
*/
echo twitter_user_timeline_php($twitter_screen_name);
?>