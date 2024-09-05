<!DOCTYPE html>
<html lang="en">

<head>

<style>
.div{
width: 300px;	
border: 1px solid #000000;
	
	
}
.v{
 

color:white;
	}
	
	
</style>



</head>

<body>

<?php
//codigo form data



     $self = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '#';
     $now = date("Y-m-d");
     $today = isset($_POST['today']) ? $_POST['today'] : (new DateTime)->format('Y-m-d');
	 
     $date = date('d.m.Y', strtotime($today));
	 
     $formattedResult = $date;
    
 

//finaliza codigo form data
?>



<form action="" method="post" id="form" enctype="multipart/form-data">

<select id="mode" name="mode" class="select">
<?php  

//pegando usuario
session_start(); // Inicia a Sessão

$nome=$_SESSION['n'];




$conn = '192.168.254.208:C:\Program Files (x86)\Leucotron Telecom\Banco de Dados\CONTACTION.FDB';

//conexão com o banco, se der erro mostrara uma mensagem.
if (!($dbh=ibase_connect($conn, 'SYSDBA', 'masterkey')))
die('Erro ao conectar: ' . ibase_errmsg());

$sqlcargo="select con_cargo from contatos where con_nome='$nome'";


$query11=ibase_query ($dbh, $sqlcargo);

	while($row = ibase_fetch_object ($query11)) {
		
		$cargo= $row->CON_CARGO ;
		
		
		}

echo "$cargo";

if($cargo=='SUPERVISOR'){
$sql="SELECT 

ppp.con_nome


from usuarios pp,contatos ppp where
ppp.contato_id = pp.usu_contato_id


and ppp.con_cargo='RCA'

group by  ppp.con_nome";}else{
	
	$sql="select con_nome from contatos where con_nome='$nome'";
}

$query2=ibase_query ($dbh, $sql);


while($row = ibase_fetch_object ($query2)) {
            $dados = $row->CON_NOME;
	
	echo "<option value=$dados> $dados </option>";
	 
	}

        


		
 ?>
</select>
<input type="date" name="today" value="<?= $today;?>">
<input type="submit" value="selecionar" name="selecionar">

</form>
    


<?php
if(isset($_POST['selecionar'])!=""){
$usuario = $_POST['mode'];  
echo  "Chamadas de: $usuario";  
}else{
	
$usuario ="";	
}
?>

<?php


$dataAtual=date('Y-m-d');
    $data1=date('Y-m-01');



// Create connection
$conn = '192.168.254.208:C:\Program Files (x86)\Leucotron Telecom\Banco de Dados\CONTACTION.FDB';

//conexão com o banco, se der erro mostrara uma mensagem.
if (!($dbh=ibase_connect($conn, 'SYSDBA', 'masterkey')))
die('Erro ao conectar: ' . ibase_errmsg());



$sql="SELECT 

p.cham_identificacao,
p.cham_duracaoligacao,
p.cham_hora

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_data >= '$formattedResult'
and ppp.con_nome='$usuario'

";

$query2=ibase_query ($dbh, $sql);

	
	
   
echo "<table border='1'>

<tr>

<th>Numeros</th>
<th>Tempo</th>
<th>Hora</th>

</tr>";


while($row = ibase_fetch_object ($query2)) {
$row->CHAM_IDENTIFICACAO;
$row->CHAM_DURACAOLIGACAO;	


echo "<tr>";

  echo "<td>" . $row->CHAM_IDENTIFICACAO . "</td>";
  echo "<td>" . $row->CHAM_DURACAOLIGACAO . "</td>";
  echo "<td>" . $row->CHAM_HORA . "</td>";

  echo "</tr>";

  }

echo "</table>";


	

?>

					
					

	
	
	</div>






</div>
<div id="v" name="v" class="v">
		<p>fsdfsfd</p>	
<p>fsdfsfd</p>
<p>fsdfsfd</p>	
<p>fsdfsfd</p>	
	</div>

</body>

</html>
