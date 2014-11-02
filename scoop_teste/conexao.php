  <?php
  
  if (!$conexao = mysql_connect('localhost','root','')){
	
	echo "Erro ao conectar-se ao Servidor";
	
	exit();
	
  }
  
  if(!mysql_select_db('scoop',$conexao)){
	echo "Erro ao Selecionar a Base de Dados";
	exit();
  }
  
  ?>
  
