<html>
 	


<body>

<?php

error_reporting(0);
/*
$conn = mysqli_connect("localhost","root","","filter");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 */ 
  
  // Create connection
//$conn = '192.168.254.208:C:\Program Files (x86)\Leucotron Telecom\Banco de Dados\CONTACTION.FDB';

//conexão com o banco, se der erro mostrara uma mensagem.
if ($dbh=ibase_connect('192.168.254.208:C:\Program Files (x86)\Leucotron Telecom\Banco de Dados\CONTACTION.FDB', 'SYSDBA', 'masterkey')){
	
	echo '<img src="imagens/ok.png"/>';
	 ibase_close($dbh);
}else{
	
echo '<img src="imagens/erro.png" />';
exit;
}
  
?>
</body>
</html>
