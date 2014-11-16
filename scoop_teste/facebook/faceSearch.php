
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css" />

</head>
<?php
// Turn off all error reporting
error_reporting(0);
?>
<body>
<?php  if(isset($_SESSION['user'])) { ?>
<a href="logout.php">
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
  <?php include('../menu/menu_face.php')?>
</div>
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
 $query = urlencode($_POST['pesqT']);
$type = 'post';
$retrive = $facebook->api('/search?q='.$query.'&type='.$type.'&limit=10');

$string= json_encode($retrive );
$json_a = json_decode($string, true);
$json_o = json_decode($string);

foreach($json_o->data as $p)
{       $mess= "deletado";
        $text = $p->message;
        $username=$p->from->name;
        $id=$p->from->id;
		$tempo = $p-> created_time;
		if (empty($text) == true){$text = $p->picture;};
		if (empty($text) == true){$text = $p->story;};
		
		$date_source = strtotime($tempo);
        $timestamp = date('d-m-Y H:i:s', $date_source);
		

 echo"  <div class='col-lg-42'>

    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <h3 class='panel-title'> Nome: $username </h3>
        </div>
        <div class='panel-body'>  
          
           <table width='200'  class='table table-striped table-bordered table-hover'>
		   <tbody>
    <tr>
    <td>MENSAGEM: $text </td>
	<td>DATA: $timestamp</td>
	
	
  </tr>
 
  </tbody>
</table>
      
        </div>
    </div>";}?>
	<a href="face.php" ><img src="../imgs/arrow_back_blue_2.png" width="50" >  </a>
</body>
</html>

		<?php

include '../conexao.php';
$query = "INSERT INTO fb 
 
VALUES ('$username','$text','$timestamp')";

mysql_query($query);





?>
