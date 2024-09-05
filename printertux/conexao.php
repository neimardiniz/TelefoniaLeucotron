<?php
//conexao oracle
$user="DONWMS";	//usuário
$senha="otolip";	//senha
//date_default_timezone_set('America/Sao_Paulo');
$banco="(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.254.227)(PORT = 1521)) ".
		    "(ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.5)(PORT = 1526))) ".
			"(CONNECT_DATA = (SID = ORCL) ) ".
			")";  // configuracoes do banco
			
$conexao = OCILogon($user,$senha,$banco);//conexão
if($conexao == ""){
	$erro = ocierror($conexao);
	print_r($erro);
	echo "Erro de conexao banco atacadista";
	die;
}else{
	
}


//$pesquisar = $_POST['pesquisar'];



if (isset($_POST['envia'])){
$pesquisar = $_POST['pesquisar'];
$stid = oci_parse($conexao, "select nome,ativo from usuario where nome='$pesquisar'" );

}

if (isset($_POST['seleciona'])){

$stid = oci_parse($conexao, "select nome,ativo from usuario where ativo =$s" );
}


//$stid = oci_parse($conexao, "select nome,ativo from usuario where nome='$pesquisar'" );
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
	}
    echo "</tr>\n";

echo "</table>\n";




oci_close($conexao);






//conexao normal

/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuario";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT nome, idade FROM cliente";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "nome: " . $row["nome"]. " - idade: " . $row["idade"].  "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();*/

		
		

?>