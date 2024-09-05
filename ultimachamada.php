<html>
 	


<body>

<?php
// Create connection
$conn = '192.168.254.208:C:\Program Files (x86)\Leucotron Telecom\Banco de Dados\CONTACTION.FDB';

//conexão com o banco, se der erro mostrara uma mensagem.
if (!($dbh=ibase_connect($conn, 'SYSDBA', 'masterkey')))
die('Erro ao conectar: ' . ibase_errmsg());

$dataatual=date('d.m.Y');
 //session_start(); // Inicia a Sessão
$usuario= $_SESSION['n'];


$sqlultimachamada="SELECT FIRST 1

p.cham_identificacao,
p.cham_duracaoligacao,
P.cham_hora


from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_data = '$formattedResult'
and ppp.con_nome='$usuario'
ORDER BY P.cham_hora DESC;
";

$query51=ibase_query ($dbh, $sqlultimachamada);

if($row = ibase_fetch_object ($query51)) {

$row->CHAM_HORA;
$row->CHAM_IDENTIFICACAO;
$row->CHAM_DURACAOLIGACAO;

$ultimachamada=$row->CHAM_HORA;
$numerochamada=$row->CHAM_IDENTIFICACAO;
$tempochamada=$row->CHAM_DURACAOLIGACAO;

}else{
	
	$ultimachamada=0;
$numerochamada=0;
$tempochamada=0;
}
  
  //echo "Sua ultima ligacao gravada: <br> Numero: $numerochamada / Hora: $ultimachamada / Tempo: $tempochamada <br>";
  
  
?>
</body>
</html>
