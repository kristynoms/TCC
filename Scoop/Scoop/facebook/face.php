<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Facebook</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css" />
<?php
require "../valida.php";
?>
</head>

<body>
<?php  if(isset($_SESSION['user'])) { ?>
<a href="../logout.php">
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

   
  
<h3>FACEBOOK</h3>
<form method="GET">
    <label class="control-label" for="inputDefault">Digite sua pesquisa: </label> <input class="form-control" id="inputDefault" type="text" name="q" /> 
	</br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php

if(isset($_GET['q']) && $_GET['q']!='') {
    
    include_once(dirname(__FILE__).'/config.php');
    include_once(dirname(__FILE__).'/lib/FacebookSentimentAnalysis.php');

    
    $FacebookSentimentAnalysis = new FacebookSentimentAnalysis(DATUMBOX_API_KEY,FACEBOOK_APP_ID,FACEBOOK_APP_SECRET);

    
    $facebookSearchParams=array(
        'q'=>$_GET['q'],
        'type'=>'post',
        'limit'=>20, //not supported for posts
    );
    $results=$FacebookSentimentAnalysis->sentimentAnalysis($facebookSearchParams);


    ?>
	
	<?php

 session_start();
 	$pesq =  $_GET['q'];
	$date = date('Y-m-d H:i:s');
 	$user = $_SESSION['user'];
include '../conexao.php';
$query = "INSERT INTO pesquisas_audit (pesquisa,usuario,data_pesquisa) 
 
VALUES ('$pesq','$user','$date')";

mysql_query($query);

?>

    <h3>Resultados para: "<?php echo $_GET['q']; ?>"</h3>
    <table class="table table-striped ">
	
	<thead>
    <tr>
      <th>Usuário</th>
      <th>Post</th>
      <th>Facebook Link</th>
	   <th>Data</th>
    </tr>
  </thead>
       <tbody>
        <?php
        foreach($results as $post) {
            
            
            ?>
            <tr >
                <td><?php echo $post['user']; ?></td>
                <td><?php echo $post['text']; ?></td>
                <td><a href="<?php echo $post['url']; ?>" target="_blank">View</a></td>
				<td><?php echo  date("d-m-Y H:i:s", (strtotime($post['tempo']))); ?></td>
                
            </tr>
            <?php
        }
        ?> 
</tbody>		
    </table>
    <?php
}

?>
  

</body>
</html>
