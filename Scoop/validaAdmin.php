

<?php
	session_start();
	$user = $_SESSION['user'];
	if($user == 'admin')
		header(" admin.php");
		else
		{
		 header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
		
			}
			
?>