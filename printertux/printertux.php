<html>

<head>



<style>

table

{

border-style:solid;

border-width:2px;

border-color:pink;

}

</style>

</head>

<body bgcolor="#EEFDEF">

<?php

echo getenv("username")." sua cota atual de impressao:";
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



$sql="SELECT 
ppp.quota,
SUM(pp.paginas) AS resultado,
(ppp.quota+SUM(pp.paginas))as QuotaTotal

from modp ppp, usuario p, impressoes pp where pp.cod_usuario = p.cod_usuario 
and p.cod_usuario = ppp.cod_usuario
and p.login='$logado'
and pp.data_impressao between '$data1' and '$data2'
group by ppp.cod_usuario";



 $result = $conn->query($sql);
 
 

echo "<table border='1'>

<tr>



<th>Impressas</th>

<th>Quota Total</th>

<th>Restante</th>

</tr>";



while($row = $result->fetch_assoc())

  {

  echo "<tr>";

  

  echo "<td>" . $row['resultado'] . "</td>";

  echo "<td>" . $row['QuotaTotal'] . "</td>";

  echo "<td>" . $row['quota'] . "</td>";

  echo "</tr>";

  }

echo "</table>";

 

$conn->close();

?>

</body>

</html>