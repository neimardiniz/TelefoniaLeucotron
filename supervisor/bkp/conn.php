<?php
/*
$conn = mysqli_connect("localhost","root","","filter");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 */ 
  
  // Create connection
$conn = '192.168.254.208:C:\Program Files (x86)\Leucotron Telecom\Banco de Dados\CONTACTION.FDB';

//conexão com o banco, se der erro mostrara uma mensagem.
if (!($dbh=ibase_connect($conn, 'SYSDBA', 'masterkey')))
die('Erro ao conectar: ' . ibase_errmsg());
  
?>