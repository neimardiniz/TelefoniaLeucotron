
<?php

$nome= $_POST['nome'];
$senha= $_POST['senha'];
$conn = '192.168.254.208:C:\Program Files (x86)\Leucotron Telecom\Banco de Dados\CONTACTION.FDB';

//conexão com o banco, se der erro mostrara uma mensagem.
if (!($dbh=ibase_connect($conn, 'SYSDBA', 'masterkey')))
die('Erro ao conectar: ' . ibase_errmsg());


$sql="select * from usuarios where usu_logon='$nome'";

$query5=ibase_query ($dbh, $sql);



while($row = ibase_fetch_object ($query5)) {
$logon=$row->USU_LOGON;}











//echo $_POST['senha'];






 
   ?>


  
  