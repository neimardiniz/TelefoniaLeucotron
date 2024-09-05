<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />

		<link rel="stylesheet" href="dist/ladda-themeless.min.css">

		<link rel="stylesheet" href="css/prism.css">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <title>TMA-CoferAtacadista</title>

  <!-- Bootstrap core CSS -->
  

  <!-- Custom styles for this template -->
 
<style>

.dd{
	
width: 500px;
	
}

.div{
	
border: 1px solid #000000;
	
}

.div2{
	
height:100px;
}

input[type="date"], 
input[type="time"] {
    width: 150px;
    height: 30px;
    border: 2px solid green;
}

.d1{
	content: "";
  display: table;
  clear: both;
background-color: #E6E6E6;
height: 50px;
padding: 0px;
margin-top: 0px;
width: 500px;
border: 1px solid #D8D8D8;
}

.d3{
	content: "";
  display: table;
  clear: both;
background-color: #81BEF7;
height: 50px;
padding: 0px;
margin-top: 0px;
width: 100%;
border: 1px solid #D8D8D8;
}

.d2{
	content: "";
  display: table;
  clear: both;
background-color: #fafafa;
height: 30px;
padding: 0px;
margin-top: 0px;
width: 100%;
border: 1px solid #D8D8D8;
}

.d{
	content: "";
  display: table;
  clear: both;
background-color: #000000;
height: 90px;
padding: 0px;
margin-top: 0px;
width: 100%;
border: 1px solid #D8D8D8;
}


	table.minimalistBlack {
  border: 0px solid #030303;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
  
}
table.minimalistBlack td, table.minimalistBlack th {
  border: 1px solid #A7A7A7;
  padding: 5px 4px;
}
table.minimalistBlack tbody td {
  font-size: 13px;
}
table.minimalistBlack thead {
  background: #000000;
}
table.minimalistBlack thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FEFFF4;
  text-align: left;
}
table.minimalistBlack tfoot td {
  font-size: 14px;
  background-color:#01DFA5;
}

.texto{
	
	margin: 0px;margin-top: 15px;padding-left: 5px;height: 38px;font-size: 22px;
	line-height:16px;
}

.texto2{
	
	margin: 0px;margin-top: 15px;padding-left: 5px;font-size: 15px;
	
}

.textocenter{
	
	margin: 0px;margin-top: 15px;text-align:center;font-size: 20px;color:white;
	
}

#direita {
margin-top:-520px;
width:auto;
margin-left:1300px;

height:100%;


border: 1px solid #D8D8D8;
}

.cham {
float:left;
margin-top:-610px;
font-size:12px;
width:210px;
margin-left:510px;
border: 1px solid #D8D8D8;

}

.cham1 {

height:30px;
font-size:14px;
color:white;
background-color:black;

text-align:center;
border: 1px solid #D8D8D8;


}

.chamada {


color:white;
background-color:red;
height:70px;
text-align:center;
border: 1px solid #D8D8D8;


}

.cham3 {
float:left;
margin-top:-610px;
font-size:12px;
width:210px;
margin-left:730px;

border: 1px solid #D8D8D8;


}

.cham4 {
float:left;
margin-top:-610px;
font-size:12px;
width:250px;
margin-left:950px;

border: 1px solid #D8D8D8;


}

.scroll {
height: 500px;
overflow: auto;


}

.divmedia {


font-size:25px;

height:50px;

border: 1px solid #D8D8D8;


}



</style>

</head>

<body > 


  <?php


$dataAtual=date('Y-m-d');
    $data1=date('Y-m-01');
$dataatual=date('d.m.Y');


// Create connection
$conn = '192.168.254.208:C:\Program Files (x86)\Leucotron Telecom\Banco de Dados\CONTACTION.FDB';

//conexão com o banco, se der erro mostrara uma mensagem.
if (!($dbh=ibase_connect($conn, 'SYSDBA', 'masterkey')))
die('Erro ao conectar: ' . ibase_errmsg());

//codigo form data



     $self = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '#';
     $now = date("Y-m-d");
     $today = isset($_POST['today']) ? $_POST['today'] : (new DateTime)->format('Y-m-d');
	 $todayf = isset($_POST['todayf']) ? $_POST['todayf'] : (new DateTime)->format('Y-m-d');
     $date = date('d.m.Y', strtotime($today));
	 $datef = date('d.m.Y', strtotime($todayf));
     $formattedResult = $date;
     $formattedResultf = $datef;
 

//finaliza codigo form data


function getDiasUteis($dtInicio, $dtFim, $feriados = []) {
    $tsInicio = strtotime($dtInicio);
    $tsFim = strtotime($dtFim);

    $quantidadeDias = 0;
    while ($tsInicio <= $tsFim) {
        // Verifica se o dia é igual a sábado ou domingo, caso seja continua o loop
        $diaIgualFinalSemana = (date('D', $tsInicio) === 'Sat' || date('D', $tsInicio) === 'Sun');
        // Verifica se é feriado, caso seja continua o loop
        $diaIgualFeriado = (count($feriados) && in_array(date('Y-m-d', $tsInicio), $feriados));

        $tsInicio += 86400; // 86400 quantidade de segundos em um dia

        if ($diaIgualFinalSemana || $diaIgualFeriado) {
            continue;
        }

        $quantidadeDias++;
    }

    return $quantidadeDias;
}

//echo getDiasUteis('2019-06-01', '2019-06-10'); // 25
$du= getDiasUteis($today, $todayf); // 25
//echo PHP_EOL;



//pegando usuario
//exec("wmic /node:$_SERVER[REMOTE_ADDR] COMPUTERSYSTEM Get UserName", $user);
//$usuario= substr($user[1],6);
//$usuario= strtoupper($usuario);
session_start(); // Inicia a Sessão

$usuario= $_SESSION['n'];


$sqlramal="SELECT 

pp.usu_ramal

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id
and ppp.con_nome='$usuario'

group by pp.usu_ramal";


$sqlcham ="SELECT 

p.cham_data_hora,
p.cham_identificacao

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_tipo=1 and p.cham_status=1  and p.cham_duracaoligacao>'00:00:11' and p.cham_duracaoligacao<'00:00:20'
and p.cham_data >= '$formattedResult' and p.cham_data <='$formattedResultf'
and ppp.con_nome='$usuario'
and CHAR_LENGTH(p.cham_identificacao)>5
and p.cham_comentario NOT LIKE 'Ision%'";


$sqlchamrna ="SELECT 

p.cham_data_hora,
p.cham_identificacao

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_tipo=0 and p.cham_status=1 and p.cham_duracaoligacao>'00:00:11' and p.cham_duracaoligacao<'00:00:20'
and p.cham_data >= '$formattedResult' and p.cham_data <='$formattedResultf'
and ppp.con_nome='$usuario'
and CHAR_LENGTH(p.cham_identificacao)>5
and p.cham_comentario NOT LIKE 'Ision%'";


$sql="SELECT 
pp.usu_ramal,
ppp.con_nome,


COUNT(p.cham_duracaoligacao)as qTotal,
sum(CASE WHEN p.cham_tipo=1 and p.cham_status=0  and p.cham_duracaoligacao >'00:00:20'  THEN 1 ELSE 0 END)as ORIGINADA_ATENDIDA,
sum(CASE WHEN p.cham_tipo=1 and p.cham_status=1 and p.cham_duracaoligacao>'00:00:11' and p.cham_duracaoligacao<'00:00:20'  THEN 1 ELSE 0 END) as ORIGINADA_NAO_ATENDIDA,
sum(CASE WHEN p.cham_tipo=0 and p.cham_status=0  and p.cham_duracaoligacao>'00:00:20' THEN 1 ELSE 0 END) as RECEBIDA_ATENDIDA,
sum(CASE WHEN p.cham_tipo=0 and p.cham_status=1  and p.cham_duracaoligacao>'00:00:11' and p.cham_duracaoligacao<'00:00:20' THEN 1 ELSE 0 END) as RECEBIDA_NAO_ATENDIDA,


((SUM(p.cham_duracaoligacao  - CAST('00:00:00.000' AS TIME))) / 3600) as D_SOMA_HORAS,

sum(CASE WHEN p.cham_tipo=1 and p.cham_status=0 and p.cham_duracaoligacao >'00:00:20' THEN (((p.cham_duracaoligacao  - CAST('00:00:00.000' AS TIME))) / 3600) ELSE 0 END) as TEMPO_ORIGINADA_ATENDIDA,
sum(CASE WHEN p.cham_tipo=0 and p.cham_status=0  and p.cham_duracaoligacao >'00:00:20' THEN (((p.cham_duracaoligacao  - CAST('00:00:00.000' AS TIME))) / 3600) ELSE 0 END) as TEMPO_RECEBIDA_ATENDIDA

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_data >= '$formattedResult' and p.cham_data <='$formattedResultf'
and ppp.con_nome='$usuario'
and CHAR_LENGTH(p.cham_identificacao)>5
and p.cham_comentario NOT LIKE 'Ision%'

group by pp.usu_ramal,ppp.con_nome";

$sqlmedia="select
avg(tempo) as media,

sum(CASE WHEN tempo>=1 and tempo<=2 THEN 1 ELSE 0 END)as qtdmedio,
sum(CASE WHEN tempo<1 THEN 1 ELSE 0 END)as qtdruim,
sum(CASE WHEN tempo>=3 THEN 1 ELSE 0 END)as qtdbateu

from(

SELECT 

p.cham_data,


sum(CASE WHEN p.cham_tipo=1 and p.cham_status=0  and CHAR_LENGTH(p.cham_identificacao)>5 and p.cham_duracaoligacao >'00:00:20' THEN (((p.cham_duracaoligacao  - CAST('00:00:00.000' AS TIME))) / 3600) ELSE 0 END)+
sum(CASE WHEN p.cham_tipo=0 and p.cham_status=0 and CHAR_LENGTH(p.cham_identificacao)>5 and p.cham_duracaoligacao>'00:00:20' THEN (((p.cham_duracaoligacao  - CAST('00:00:00.000' AS TIME))) / 3600) ELSE 0 END)  as TEMPO



from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_data >= '$formattedResult' and p.cham_data <='$formattedResultf'
and ppp.con_nome='$usuario '
and CHAR_LENGTH(p.cham_identificacao)>5
and p.cham_comentario NOT LIKE 'Ision%'

group by p.cham_data
) as inner_query";

$sqlchamgeral="SELECT 

p.cham_identificacao,
p.cham_duracaoligacao,
P.cham_hora


from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_data >= '$formattedResult' and p.cham_data <='$formattedResultf'
and ppp.con_nome='$usuario'

";







$query2=ibase_query ($dbh, $sqlramal);
if($row = ibase_fetch_object ($query2)) {
		
		
		$ramal2 = $row->USU_RAMAL;
		
	}


 $query=ibase_query ($dbh, $sql);
 
	
	if($row = ibase_fetch_object ($query)) {
		
		$user = $usuario;
		$ramal = $row->USU_RAMAL;
		$to=$row->TEMPO_ORIGINADA_ATENDIDA;
        $tr=$row->TEMPO_RECEBIDA_ATENDIDA;
		$tempoDiv=$to+$tr;
	    $tempoTotal=$to+$tr;
		$mediames=($to+$tr)/$du;
	  $tempoTotal = gmdate('H:i:s', floor($tempoTotal * 3600));
	   
	  $oa=$row->ORIGINADA_ATENDIDA;
	  $ra=$row->RECEBIDA_ATENDIDA;
	  $qtdtotal=$oa+$ra;
	}else
	{
		$user = $usuario;
		$ramal = $ramal2;
		$to=0;
        $tr=0;
		$tempoDiv=0;
	    $tempoTotal=0;
		$mediames=0;
	  $tempoTotal = 0;
	  $qtdtotal=0;
	}
	



//Libera a memoria usada
ibase_free_result($query);

//fecha conexão com o firebird
ibase_close($dbh);
?>
  
  
  
  

  <!-- Page Content -->
  
  <div class="dd">

<div class="d1">	
	
<form action="<?= $self; ?>" method="POST" >

<input type="date" name="today" value="<?= $today;?>">
<?php   echo "  a  ";   ?>
<input type="date" name="todayf" value="<?= $todayf;?>">

<button class="btn btn-primary btn-lg ladda-button" id="ler-pagina" 
data-style="expand-right" data-size="l0"><span class="ladda-label">Atualizar</span></button>


</form>


</div>
<!-- /script java botao de progresso -->
		<script src="dist/spin.min.js"></script>
		<script src="dist/ladda.min.js"></script>

		<script>

			// Bind normal buttons
			Ladda.bind( 'div:not(.progress-demo) button', { timeout: 20000 } );

			// Bind progress buttons and simulate loading progress
			Ladda.bind( '.progress-demo button', {
				callback: function( instance ) {
					var progress = 0;
					var interval = setInterval( function() {
						progress = Math.min( progress + Math.random() * 0.1, 1 );
						instance.setProgress( progress );

						if( progress === 1 ) {
							instance.stop();
							clearInterval( interval );
						}
					}, 200 );
				}
			} );

			
       

		</script>

 
<script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
<script type="text/javascript">



var tempo = window.setInterval(carrega, 20000);

function carrega()

{

$('#chamada').load('ultimachamada.php');

}


</script>

          
		  <div class="d">
		  <div class="textocenter"> <?php echo "Ramal: $ramal <br>";?>
		  
		  <div id="chamada" class="chamada">
		  Carregando sua ultima ligacao!
		  <p></p>
		  <img src="imagens/load.gif" > 
		  </div>
		  
		  </div>
		  
		 
		  
		  </div>
		  
		  
		  
		  <div class="d3" >
		  <div class="texto"><?php echo "Tempo Total: $tempoTotal  /  QTD: $qtdtotal"; ?></div>
		  </div>
		  

<div class="d2">
<div class="texto2" font-size="8px">
            Chamadas : <?=$formattedResult;?> 
            </div> 
           </div> 
          

		  
	  
        <table class="minimalistBlack">
<thead>
<tr>
<th>Chamadas</th>
<th>Originadas</th>
<th>Recebidas</th>
</tr>
</thead>
<tbody>
<tr>
<td>Atendidas</td>
<td><?php if($tempoTotal==null){ echo 0;}else{echo $row->ORIGINADA_ATENDIDA;} ?></td>
<td><?php if($tempoTotal==null){ echo 0;}else{echo $row->RECEBIDA_ATENDIDA;} ?></td>
</tr>
<tr>
<td>Perdidas</td>
<td><?php if($tempoTotal==null){ echo 0;}else{echo $row->ORIGINADA_NAO_ATENDIDA;} ?></td>
<td><?php if($tempoTotal==null){ echo 0; }else{echo $row->RECEBIDA_NAO_ATENDIDA;}?></td>
</tr>
<tr>
<td>Tempo Atendimento</td>
<td><?php if($tempoTotal==null){ echo 0; }else{echo gmdate('H:i:s', floor($to * 3600));}?></td>
<td><?php if($tempoTotal==null){ echo 0; }else{echo gmdate('H:i:s', floor($tr * 3600));}?></td>
</tr>
</tbody>
</table>  


<div class="d1">
		  <div class="texto"><?php echo "Meta diaria: 3:00:00";?>
		  
		  </div>
		  </div>

<?php
$query6=ibase_query ($dbh, $sqlmedia);
if($row = ibase_fetch_object ($query6)) {
		
		
		//$tempoMedia=$row->MEDIA;
		
		$row->QTDMEDIO;
		$row->QTDRUIM;
		$row->QTDBATEU;
		
	}
	
	
?>
<div id="divmedia" class="divmedia">
<div class="texto"><?php $tempoM= gmdate('H:i:s', floor($mediames * 3600));
echo "Media Mensal: $tempoM" ;

 ?></div>

</div>

<script language="javascript">

 var x = <?php print $mediames; ?>;

  var div = document.getElementById("divmedia");
  
  if(x<1){
  div.style.backgroundColor="DeepPink";}
  
  if(x>1&&x<3){
	  div.style.backgroundColor="yellow";}
  
  
  if(x>=3){
	   div.style.backgroundColor="SpringGreen";
  }
 
  

</script>

<table class="minimalistBlack">
<thead>
<tr>

<th>qtdmedio</th>
<th>qtdNaoBateu</th>
<th>qtdbateu</th>
</tr>
</thead>
<tbody>

<td><?php if($tempoTotal!=0){ echo $row->QTDMEDIO;}else{echo "0";} ?></td>



<td><?php if($tempoTotal!=0){ echo $row->QTDRUIM; }else{echo "0";}?></td>



<td><?php if($tempoTotal!=0){ echo $row->QTDBATEU; }else{echo "0";}?></td>


</tbody>
</table>  
<div class="div2">
</div>
</div>



	
<div class="cham">
   <div class="cham1"> Chamadas Perdidas Originadas </div>
 
   <?php
   $query4=ibase_query ($dbh, $sqlcham);



while($row = ibase_fetch_object ($query4)) {
$row->CHAM_DATA_HORA;
$row->CHAM_IDENTIFICACAO;		

?>
					
					<tr>
					
						<td><?php echo "$row->CHAM_DATA_HORA /"; ?></td>
						<td><?php echo "$row->CHAM_IDENTIFICACAO<br>"; ?></td>
					
					</tr>
					
					
					<?php

}
   ?>

  </div>
  
  <!-- chamadas recebidas perdidas -->
 
	<div class="cham3">
    <div class="cham1">Chamadas Perdidas Recebidas</div>
	
	<?php
   $query3=ibase_query ($dbh, $sqlchamrna);



while($row = ibase_fetch_object ($query3)) {
$row->CHAM_DATA_HORA;
$row->CHAM_IDENTIFICACAO;		

?>
					
					<tr>
					
						<td><?php echo "$row->CHAM_DATA_HORA /"; ?></td>
						<td><?php echo "$row->CHAM_IDENTIFICACAO<br>"; ?></td>
					
					</tr>
					
					
					<?php

}
   ?>

	
	
	</div>
	
	
	<!-- chamadas Geral -->
 
	<div class="cham4" >
	
    <div class="cham1">Chamadas Geral</div>
	<div class="scroll">
	<?php
   $query5=ibase_query ($dbh, $sqlchamgeral);



while($row = ibase_fetch_object ($query5)) {
$row->CHAM_IDENTIFICACAO;
$row->CHAM_DURACAOLIGACAO;
$row->CHAM_HORA;
			

?>
					
					<tr>
					<div class="div" >
						<td><?php echo "$row->CHAM_IDENTIFICACAO /"; ?></td>
						<td><?php echo "$row->CHAM_DURACAOLIGACAO /"; ?></td>
						
						<td><?php echo "$row->CHAM_HORA<br>"; ?></td>
					</div>
					</tr>
					
					
					<?php

}
   ?>

	</div>
	
	</div>
	
	
					
					
	
	
	
	<div id="direita" class="direita">
	<div class="cham1">Legendas</div>
	<img src="imagens/legenda1.jpg" >
	</div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>

</html>
