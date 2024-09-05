<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

		<link rel="stylesheet" href="dist/ladda-themeless.min.css">

		<link rel="stylesheet" href="css/prism.css">





  <title>TMA-CoferAtacadista</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
 

</head>

<body > 


  <?php

$dataAtual=date("d.m.Y");

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



$usuario="ANDREZA.APARECIDA";

$sql="SELECT 
pp.usu_ramal,
ppp.con_nome,


COUNT(p.cham_duracaoligacao)as qTotal,
sum(CASE WHEN p.cham_identificacao like '0%' and p.cham_duracaoligacao >'00:00:20'  THEN 1 ELSE 0 END)as ORIGINADA_ATENDIDA,
sum(CASE WHEN p.cham_identificacao like '0%' and p.cham_duracaoligacao>'00:00:11' and p.cham_duracaoligacao<'00:00:20'  THEN 1 ELSE 0 END) as ORIGINADA_NAO_ATENDIDA,
sum(CASE WHEN p.cham_identificacao not like '0%' and p.cham_duracaoligacao >'00:00:20' THEN 1 ELSE 0 END) as RECEBIDA_ATENDIDA,
sum(CASE WHEN p.cham_identificacao not like '0%' and p.cham_duracaoligacao>'00:00:11' and p.cham_duracaoligacao<'00:00:20' THEN 1 ELSE 0 END) as RECEBIDA_NAO_ATENDIDA,


((SUM(p.cham_duracaoligacao  - CAST('00:00:00.000' AS TIME))) / 3600) as D_SOMA_HORAS,

sum(CASE WHEN p.cham_identificacao like '0%' and p.cham_duracaoligacao >'00:00:20' THEN (((p.cham_duracaoligacao  - CAST('00:00:00.000' AS TIME))) / 3600) ELSE 0 END) as TEMPO_ORIGINADA_ATENDIDA,
sum(CASE WHEN p.cham_identificacao not like '0%' and p.cham_duracaoligacao>'00:00:20' THEN (((p.cham_duracaoligacao  - CAST('00:00:00.000' AS TIME))) / 3600) ELSE 0 END) as TEMPO_RECEBIDA_ATENDIDA

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_data >= '$formattedResult' and p.cham_data <='$formattedResultf'
and ppp.con_nome='$usuario'

and p.cham_comentario NOT LIKE 'Ision%'

group by pp.usu_ramal,ppp.con_nome

";


 $query=ibase_query ($dbh, $sql);


	
	if($row = ibase_fetch_object ($query)) {
		
		$user = $usuario;
		$ramal = $row->USU_RAMAL;
		$to=$row->TEMPO_ORIGINADA_ATENDIDA;
        $tr=$row->TEMPO_RECEBIDA_ATENDIDA;
		$tempoDiv=$to+$tr;
	    $tempoTotal=$to+$tr;
	  $tempoTotal = gmdate('H:i:s', floor($tempoTotal * 3600));
	}else
	{
		$user = $usuario;
		$ramal = 3532;
		$to=0;
        $tr=0;
		$tempoDiv=0;
	    $tempoTotal=0;
	  $tempoTotal = 0;
	}
	


//Libera a memoria usada
ibase_free_result($query);

//fecha conexão com o firebird
ibase_close($dbh);
?>
  
  
  
  

  <!-- Page Content -->
  <div class="container">

   

    <div class="row">
      <div class="col-lg-8 mb-8">
        <div class="card h-100">
          <h4 class="card-header">
		  
			

			
<form action="<?= $self; ?>" method="POST" >

<input type="date" name="today" value="<?= $today;?>">
<?php   echo "  a  ";   ?>
<input type="date" name="todayf" value="<?= $todayf;?>">

<button class="btn btn-primary btn-lg ladda-button" id="ler-pagina" 
data-style="expand-right" data-size="l0"><span class="ladda-label">Atualizar</span></button>


</form>

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


          
		  <h4 class="card-header"><?php echo "Ramal: $ramal"; ?></h4>
		  <h4 class="card-header"><?php echo $user; ?></h4>
		  
		  <h4 class="card-header"><?php echo "Meta: 3:00:00";?>
		  <img src="imagens/legenda.jpg" id="direita"></h4>
		  <div class="htab" id="teste"><?php echo "Tempo Total: $tempoTotal"; ?></div>
          



	
		  
		  <style>
		  
 
.grid-container {
  display: grid;
  grid-column-gap: 5px;
  grid-template-columns: auto auto auto;
  background-color: #2196F3;
  padding: 5px;
  
}

.grid-item {
  background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 1px;
  font-size: 20px;
  text-align: center;
}

.htab {

	
  height:50px;
  
  font-size: 30px;
	text-align: left;
}

#direita {
right:0px;
 position:fixed;	
  height:40px;
  left: 48%;
  font-size: 30px;
	
}


.tabela {

	
  height:200px;
  width: 500px;
 
}

</style>


<script language="javascript">

 var x = <?php print $tempoDiv; ?>;

  var div = document.getElementById("teste");
  
  if(x<=1){
  div.style.backgroundColor="DeepPink";}
  
  if(x>1&&x<3){
	  div.style.backgroundColor="Khaki";}
  
  
  if(x>=3){
	   div.style.backgroundColor="SpringGreen";
  }
 
  

</script>


<div class="card-footer">
            Chamadas : <?=$formattedResult;?> <?php if($tempoTotal==0){ echo "(Sem chamadas ate o momento)";}else{echo "";} ?>
<div class="tabela">
<div class="grid-container">
  <div class="grid-item"></div>
  <div class="grid-item">Originadas</div>
  <div class="grid-item">Recebidas</div>  
  <div class="grid-item">Atendidas</div>
  <div class="grid-item"><?php if($tempoTotal!=0){ echo $row->ORIGINADA_ATENDIDA;}else{echo "0";} ?></div>
  <div class="grid-item"><?php if($tempoTotal!=0){ echo $row->RECEBIDA_ATENDIDA;}else{echo "0";} ?></div>  
  <div class="grid-item">Perdidas</div>
  <div class="grid-item"><?php if($tempoTotal!=0){ echo $row->ORIGINADA_NAO_ATENDIDA;}else{echo "0";} ?></div>
  <div class="grid-item"><?php if($tempoTotal!=0){ echo $row->RECEBIDA_NAO_ATENDIDA; }else{echo "0";}?></div>
  <div class="grid-item">Tempo Atendimento</div> 
  <div class="grid-item"><?php if($tempoTotal!=0){ echo gmdate('H:i:s', floor($to * 3600)); }else{echo "0";}?></div> 
  <div class="grid-item"><?php if($tempoTotal!=0){ echo gmdate('H:i:s', floor($tr * 3600)); }else{echo "0";}?></div>   
   </div>
    
  </div>
            
          </div>

		  
		  
          
      
	  
    
	 
             
   

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>

</html>
