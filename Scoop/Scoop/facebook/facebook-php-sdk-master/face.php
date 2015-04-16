<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('facebook-php-sdk-master/src/facebook.php');

  $config = array(
    'appId' => '678269262234858',
    'secret' => '1ffa8177f323919ccb39fc3de6acaa96',
    'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
   $query = urlencode('india');
$type = 'post';
$retrive = $facebook->api('/search?q='.$query.'&type='.$type.'&limit=10');

$string= json_encode($retrive );
$json_a = json_decode($string, true);
$json_o = json_decode($string);

foreach($json_o->data as $p)
{
 $text = $p->message;
        $username=$p->from->name;
        $id=$p->from->id;
        echo "<table border=1px>
<tr>
<td>
<td>$id</td>
<td>$username</td>
<td>$text</td>
</tr>
</table>";

}
?>
<html>
  <head></head>
  <body>

  

  </body>
</html>