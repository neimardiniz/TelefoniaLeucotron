<!DOCTYPE html>
<html lang="en">
<head>
<title>Supervisor</title>

<link href="bootstrap.min.css" rel="stylesheet">
<link href="dataTables.bootstrap.css" rel="stylesheet">
<link href="dataTables.responsive.css" rel="stylesheet">

<link rel="stylesheet" href="dist/ladda-themeless.min.css">



		
<style>
	.mytable{
		
    
font-size:11px;	
  width: 100%;
 
  padding: 10px;
	}
</style>

<style>
	.data{
 

font-size: 15px;
background-color:white; 
border-bottom: 1px solid black;
     


  padding: 10px;
	}
	
.v{
 

color:white;
	}
	
	.legenda{
 position:absolute;
float:right;


	}
	
</style>




</head>
<body>




<?php
//codigo form data



     $self = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '#';
     $now = date("Y-m-d");
     $today = isset($_POST['today']) ? $_POST['today'] : (new DateTime)->format('Y-m-d');
	 $todayf = isset($_POST['todayf']) ? $_POST['todayf'] : (new DateTime)->format('Y-m-d');
     $date = date('d.m.Y', strtotime($today));
	 $datef = date('d.m.Y', strtotime($todayf));
     $formattedResult = $date;
     $formattedResultf = $datef;

	 if(isset($_POST['b']))
{
  if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['today'] = $_POST;
    unset($_POST);
    header("Location: ".$_SERVER['PHP_SELF']);
	
    
}
}
if(isset($_POST['c']))
{
  echo "<meta HTTP-EQUIV='refresh' CONTENT='5;URL=vai.php'>";
} 
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

?>
<div class="data">

<form action="<?= $self; ?>" method="POST"  >

<input type="date" name="today" value="<?= $today;?>">
<?php   echo "  a  ";   ?>
<input type="date" name="todayf" value="<?= $todayf;?>">

<button class="btn btn-primary btn-lg ladda-button" 
data-style="expand-right" data-size="l0"><span class="ladda-label">Atualizar</span></button>

<img src="../imagens/legendasup.jpg" class="legenda" id="legenda">
</form>
</div>
	
	<div class="mytable" >
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
            <tr>
				<th>RAMAL</th>
                <th>NOME</th>
				
				<th>ORIG_ATEND</th>
				<th>ORIG_NAO_ATEND</th>
                <th>REC_ATEND</th>
				<th>REC_NAO_ATENDIDA</th>
				<th>T_ORIG_ATEND</th>
				<th>T_REC_ATEND</th>
				<th>QTD_GERAL</th>
				<th>T_GERAL</th>
				
				<th>QTD_REAL</th>
				<th>T_REAL</th>
				<th>MEDIA</th>
            </tr>
        </thead>
		<tbody>
		
	
		
			<?php
				include('conn.php');

//pegando usuario
session_start(); // Inicia a Sessão

$usuario=$_SESSION['n'];




$sqlcargo="select con_cargo from contatos where con_nome='$usuario'";


$query1=ibase_query ($dbh, $sqlcargo);

	while($row = ibase_fetch_object ($query1)) {
		
		$cargo= $row->CON_CARGO ;
		
		
		}



$sql="SELECT 
pp.usu_ramal,
ppp.con_nome,
ppp.con_cargo,


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
and ppp.con_cargo in ('SUPERVISOR','RCA')
and CHAR_LENGTH(p.cham_identificacao)>5
and p.cham_comentario NOT LIKE 'Ision%'

group by pp.usu_ramal,ppp.con_nome,ppp.con_cargo

";

				$query=ibase_query ($dbh, $sql);
				while($row=ibase_fetch_object ($query)){
					
					$to=$row->TEMPO_ORIGINADA_ATENDIDA;
                    $tr=$row->TEMPO_RECEBIDA_ATENDIDA;
					$totaltempo=$to+$tr;
					$qtd=$row->ORIGINADA_ATENDIDA+$row->RECEBIDA_ATENDIDA;
					$mediames=($to+$tr)/$du;
				
						
					
					?>
					
					<tr>
					
						<td><?php echo $row->USU_RAMAL; ?></td>
						<td><?php echo $row->CON_NOME; ?></td>
						
						<td><?php echo $row->ORIGINADA_ATENDIDA; ?></td>
						<td><?php echo $row->ORIGINADA_NAO_ATENDIDA; ?></td>
						<td><?php echo $row->RECEBIDA_ATENDIDA; ?></td>
						<td><?php echo $row->RECEBIDA_NAO_ATENDIDA; ?></td>
						<td><?php echo gmdate('H:i:s', floor($to * 3600)); ?></td>
						<td><?php echo gmdate('H:i:s', floor($tr * 3600)); ?></td>
						<td><?php echo $row->QTOTAL; ?></td>
						<td><?php echo gmdate('H:i:s', floor($row->D_SOMA_HORAS * 3600)); ?></td>
						
						<td><?php echo $qtd; ?></td>
						<td><?php echo gmdate('H:i:s', floor($totaltempo * 3600)); ?></td>
						<td><?php echo gmdate('H:i:s', floor($mediames * 3600)); ?></td>
					</tr>
					
					
					<?php
					
				}
				
				
				
				
			?>
		</tbody>
	</table>
	<div id="v" name="v" class="v">
		<p>fsdfsfd</p>	
<p>fsdfsfd</p>
<p>fsdfsfd</p>	
<p>fsdfsfd</p>	
	</div>
	
	</div>
	
	
	<script src="jquery.min.js"></script>
	<script src="jquery.dataTables.min.js"></script>
    <script src="dataTables.bootstrap.min.js"></script>
    <script src="dataTables.responsive.js"></script>
	<script src="bootstrap.min.js"></script>
	
	<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
			
            responsive: true
			
        });
    });
    </script>
	

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
		
		<!-- Bootstrap core JavaScript -->
  
	
</body>
</html>