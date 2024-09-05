<html>

<head>



<style>

table

{

border-style:solid;

border-width:2px;

border-color:green;

}

</style>

</head>

<body bgcolor="#EEFDEF">
<a href="JavaScript:location.reload(true);">
Atualizar
</a>
<?php


//pegando usuario
exec("wmic /node:$_SERVER[REMOTE_ADDR] COMPUTERSYSTEM Get UserName", $user);
$usuario= substr($user[1],6);
echo "$usuario";
echo "<br>";



//echo getHostByName(getHostName());
//echo "<br>";
echo date("d-m-Y") . '<br />';
//echo "<br>";
//echo date("Y-m-01") . '<br />';

$data1=date("Y-m-01");
$data2=date("Y-m-d");

$logado = getenv("username");
$localIP = getHostByName(getHostName());

// Create connection
$conn = '192.168.254.208:C:\Program Files (x86)\Leucotron Telecom\Banco de Dados\CONTACTION.FDB';

//conexão com o banco, se der erro mostrara uma mensagem.
if (!($dbh=ibase_connect($conn, 'SYSDBA', 'masterkey')))
die('Erro ao conectar: ' . ibase_errmsg());



$sql="SELECT 
ppp.con_exibicao,
ppp.con_nome,
p.cham_data,
COUNT(p.cham_duracaoligacao) AS qtd,

((SUM(p.cham_duracaoligacao - CAST('00:00:00.000' AS TIME))) / 3600) as D_SOMA_HORAS

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.con_nome = pp.usu_ramal
and p.cham_data='13.05.2019'
and p.cham_usuario_id=150

group by ppp.con_exibicao,con_nome,p.cham_data";


 $query= ibase_query ($dbh, $sql);
 


echo "<table border='1'>

<tr>

<th>Usuario</th>
<th>Ramal</th>
<th>Quantidade</th>
<th>Tempo</th>

</tr>";



while($row = ibase_fetch_object ($query)) 

  {

  echo "<tr>";
$teste= $row->D_SOMA_HORAS;
  echo "<td>" . $row->CON_EXIBICAO . "</td>";
  echo "<td>" . $row->CON_NOME . "</td>";
  echo "<td>" . $row->QTD . "</td>";
  echo "<td>" . gmdate('H:i:s', floor($teste * 3600)) . "</td>";
  
  echo "</tr>";

  }

echo "</table>";



//Libera a memoria usada
ibase_free_result($query);

//fecha conexão com o firebird
ibase_close($dbh);

?>

</body>

</html>
