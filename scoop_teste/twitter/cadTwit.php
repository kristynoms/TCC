<?php

include '../conexao.php';
$query = "INSERT INTO twit (username,tweet,data)
 
VALUES ('$user','$tweet','$data')";

mysql_query($query);
$id = mysql_insert_id();


if(!mysql_error()) {
    header( 'Location: home.php' ) ;
}

?>