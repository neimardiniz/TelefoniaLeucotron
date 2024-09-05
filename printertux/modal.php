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
Refrescar
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

$servername = "192.168.254.216";
$username = "printertux";
$password = "print3";
$dbname = "PRINTERTUX";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sqlw = $conn->query("select cod_nivel_acesso,cod_grupo from usuario where login='$usuario'");

 $row = $sqlw->fetch_row();

 $acesso= $row[0];
 $grupo= $row[1];
 echo $acesso;
 echo $grupo;

if($acesso==1){
$sql="SELECT 
ppp.quota,
SUM(pp.paginas) AS resultado,
(ppp.quota+SUM(pp.paginas))as QuotaTotal,
p.login

from modp ppp, usuario p, impressoes pp where pp.cod_usuario = p.cod_usuario 
and p.cod_usuario = ppp.cod_usuario
and p.login='frederico.vespucio'
and pp.data_impressao between '$data1' and '$data2'
group by ppp.cod_usuario";
}else{

$sql="SELECT 
ppp.quota,
SUM(pp.paginas) AS resultado,
(ppp.quota+SUM(pp.paginas))as QuotaTotal,
p.login

from modp ppp, usuario p, impressoes pp where pp.cod_usuario = p.cod_usuario 
and p.cod_usuario = ppp.cod_usuario
and p.cod_grupo=31

and pp.data_impressao between '$data1' and '$data2'
group by ppp.cod_usuario";
}

 $result = $conn->query($sql);
 


echo "<table border='1'>

<tr>

<th>Usuario</th>
<th>Quota Mensal</th>
<th>Realizadas</th>
<th>Disponiveis</th>

</tr>";



while($row = $result->fetch_assoc())

  {

  echo "<tr>";

  echo "<td>" . $row['login'] . "</td>";
  echo "<td>" . $row['QuotaTotal'] . "</td>";
  echo "<td>" . $row['resultado'] . "</td>";
  echo "<td>" . $row['quota'] . "</td>";

  echo "</tr>";

  }

echo "</table>";



$conn->close();

?>

</body>

</html>