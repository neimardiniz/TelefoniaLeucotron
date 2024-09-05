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
$du= getDiasUteis($data1, $dataatual); // 25
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

p.cham_hora,
p.cham_identificacao

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_tipo=1 and p.cham_status=1  and p.cham_duracaoligacao>'00:00:11' and p.cham_duracaoligacao<'00:00:20'
and p.cham_data '$formattedResult'
and ppp.con_nome='$usuario'
and CHAR_LENGTH(p.cham_identificacao)>5
and p.cham_comentario NOT LIKE 'Ision%'";





$sql="SELECT 
pp.usu_ramal,
ppp.con_nome,


COUNT(p.cham_duracaoligacao)as qTotal,
COUNT(p.cham_identificacao)as QGERAL,
sum(CASE WHEN p.cham_tipo=1 and p.cham_status=0  and p.cham_duracaoligacao >'00:00:20'  THEN 1 ELSE 0 END)as ORIGINADA_ATENDIDA,
sum(CASE WHEN p.cham_tipo=1 and p.cham_status=1   THEN 1 ELSE 0 END) as ORIGINADA_NAO_ATENDIDA,

sum(CASE WHEN p.cham_tipo=0 and p.cham_status=0  and p.cham_duracaoligacao>'00:00:20' THEN 1 ELSE 0 END) as RECEBIDA_ATENDIDA,
sum(CASE WHEN p.cham_tipo=0 and p.cham_status=1   THEN 1 ELSE 0 END) as RECEBIDA_NAO_ATENDIDA,


((SUM(p.cham_duracaoligacao  - CAST('00:00:00.000' AS TIME))) / 3600) as D_SOMA_HORAS,

sum(CASE WHEN p.cham_tipo=1 and p.cham_status=0 and p.cham_duracaoligacao >'00:00:20' THEN (((p.cham_duracaoligacao  - CAST('00:00:00.000' AS TIME))) / 3600) ELSE 0 END) as TEMPO_ORIGINADA_ATENDIDA,
sum(CASE WHEN p.cham_tipo=0 and p.cham_status=0  and p.cham_duracaoligacao >'00:00:20' THEN (((p.cham_duracaoligacao  - CAST('00:00:00.000' AS TIME))) / 3600) ELSE 0 END) as TEMPO_RECEBIDA_ATENDIDA

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_data ='$formattedResult'
and ppp.con_nome='$usuario'
and CHAR_LENGTH(p.cham_identificacao)>5
and p.cham_comentario NOT LIKE 'Ision%'

group by pp.usu_ramal,ppp.con_nome";


$sqlg="SELECT 




COUNT(p.cham_identificacao)as QGERAL


from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_data ='$formattedResult'
and ppp.con_nome='$usuario' ";




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

and p.cham_data ='$formattedResult'
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

and p.cham_data ='$formattedResult'
and ppp.con_nome='$usuario'
order by P.cham_hora DESC
";

$sqlcham ="SELECT 

p.cham_data_hora,
p.cham_identificacao

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_tipo=1 and p.cham_status=1  
and p.cham_data ='$formattedResult'
and ppp.con_nome='$usuario'

and CHAR_LENGTH(p.cham_identificacao)>5
order by P.cham_hora DESC
";

$sqlchamrna ="SELECT 

p.cham_hora,
p.cham_identificacao

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id

and p.cham_tipo=0 and p.cham_status=1
and p.cham_data = '$formattedResult'
and ppp.con_nome='$usuario'
and CHAR_LENGTH(p.cham_identificacao)>5
and p.cham_comentario NOT LIKE 'Ision%'
order by P.cham_hora DESC
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
		$ona=$row->ORIGINADA_NAO_ATENDIDA;
		$rna=$row->RECEBIDA_NAO_ATENDIDA;
		$qg=$row->QGERAL;
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
		$ramal = 0;
		$ona=0;
		$rna=0;
		$to=0;
        $tr=0;
		$tempoDiv=0;
	    $tempoTotal=0;
		$mediames=0;
	  $tempoTotal = 0;
	  $qtdtotal=0;
	}



$queryg=ibase_query ($dbh, $sqlg);

if($row = ibase_fetch_object ($queryg)) {
		
		
		$qg=$row->QGERAL;
		
	}else
	{
		$qg = 0;
		
	}



$_SESSION['r'] = $ramal; // Grava na sessão chamada nome a variável


//Libera a memoria usada
//ibase_free_result($query);

//fecha conexão com o firebird
//ibase_close($dbh);
?>




