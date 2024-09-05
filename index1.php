<!DOCTYPE html>
<html lang="en">

<head>




  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TMA-CoferAtacadista</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>



  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">Sistema Cofer</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.html">Acompanhamento</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Supervisor</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Relatorios
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
              <a class="dropdown-item" href="portfolio-1-col.html">1 Column Portfolio</a>
              <a class="dropdown-item" href="portfolio-2-col.html">2 Column Portfolio</a>
              <a class="dropdown-item" href="portfolio-3-col.html">3 Column Portfolio</a>
              <a class="dropdown-item" href="portfolio-4-col.html">4 Column Portfolio</a>
              <a class="dropdown-item" href="portfolio-item.html">Single Portfolio Item</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Blog
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="blog-home-1.html">Blog Home 1</a>
              <a class="dropdown-item" href="blog-home-2.html">Blog Home 2</a>
              <a class="dropdown-item" href="blog-post.html">Blog Post</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Other Pages
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="full-width.html">Full Width Page</a>
              <a class="dropdown-item" href="sidebar.html">Sidebar Page</a>
              <a class="dropdown-item" href="faq.html">FAQ</a>
              <a class="dropdown-item" href="404.html">404</a>
              <a class="dropdown-item" href="pricing.html">Pricing Table</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>



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
     $date = date('d.m.Y', strtotime($today));
     $formattedResult = $date;
	 
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



$usuario="ANDREZA.APARECIDA";

$sql="SELECT 
pp.usu_ramal,
ppp.con_nome,
p.cham_data,
COUNT(p.cham_duracaoligacao) AS qtd,

((SUM(p.cham_duracaoligacao - CAST('00:00:00.000' AS TIME))) / 3600) as D_SOMA_HORAS

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id
and p.cham_data='$formattedResult'
and ppp.con_nome='ANDREZA.APARECIDA'

group by pp.usu_ramal,con_nome,p.cham_data";


 $query=ibase_query ($dbh, $sql);


	
	while($row = ibase_fetch_object ($query)) {
		
		$user = $row->CON_NOME;
		$ramal = $row->USU_RAMAL;
		$tempoTotal= $row->D_SOMA_HORAS;
	}   $tempoTotal = gmdate('H:i:s', floor($tempoTotal * 3600));


////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$sqloriginadaatendida="SELECT 
pp.usu_ramal,
ppp.con_nome,
p.cham_data,
COUNT(p.cham_duracaoligacao) AS qtd,

((SUM(p.cham_duracaoligacao - CAST('00:00:00.000' AS TIME))) / 3600) as D_SOMA_HORAS

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id
and p.cham_data='$formattedResult'
and ppp.con_nome='ANDREZA.APARECIDA'
and p.cham_tipo=1 and p.cham_status=0 and cham_duracaoligacao >'00:00:11'
and p.cham_comentario NOT LIKE 'Ision%'
group by pp.usu_ramal,con_nome,p.cham_data";




$sqloriginadanaoatendida="SELECT 
pp.usu_ramal,
ppp.con_nome,
p.cham_data,
COUNT(p.cham_duracaoligacao) AS qtd



from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id
and p.cham_data='$formattedResult'
and ppp.con_nome='ANDREZA.APARECIDA'
and p.cham_tipo=1 and p.cham_status=0 and cham_duracaoligacao <'00:00:12' 
and p.cham_comentario NOT LIKE 'Ision%'
group by pp.usu_ramal,con_nome,p.cham_data";



$sqlrecebidaatendida="SELECT 
pp.usu_ramal,
ppp.con_nome,
p.cham_data,
COUNT(p.cham_duracaoligacao) AS qtd,

((SUM(p.cham_duracaoligacao - CAST('00:00:00.000' AS TIME))) / 3600) as D_SOMA_HORAS

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id
and p.cham_data='$formattedResult'
and ppp.con_nome='ANDREZA.APARECIDA'
and p.cham_tipo=0 and p.cham_status=0
and p.cham_comentario NOT LIKE 'Ision%'
group by pp.usu_ramal,con_nome,p.cham_data";

//////////////////////////////////////////////////////////////////////////

$sqlrecebidanaoatendida="SELECT 
pp.usu_ramal,
ppp.con_nome,
p.cham_data,
COUNT(p.cham_duracaoligacao) AS qtd

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id
and p.cham_data='$formattedResult'
and ppp.con_nome='ANDREZA.APARECIDA'
and p.cham_tipo=0 and p.cham_status=1
and p.cham_comentario NOT LIKE 'Ision%'
group by pp.usu_ramal,con_nome,p.cham_data";

$query1=ibase_query ($dbh, $sqloriginadaatendida);
$query2=ibase_query ($dbh, $sqloriginadanaoatendida);
$query3=ibase_query ($dbh, $sqlrecebidaatendida);
$query4=ibase_query ($dbh, $sqlrecebidanaoatendida);

while($row = ibase_fetch_object ($query1)) {
		
		$qtdoa=$row->QTD;
		$tempooa= $row->D_SOMA_HORAS;
	}   $tempooa = gmdate('H:i:s', floor($tempooa * 3600));


while($row = ibase_fetch_object ($query2)) {
		
		$qtdona=$row->QTD;
		//$tempoona= $row->D_SOMA_HORAS;
	}   //$tempoona = gmdate('H:i:s', floor($tempoona * 3600));
	
	
if($row = ibase_fetch_object ($query3)) {
		
		$qtdra=$row->QTD;
		$tempora= $row->D_SOMA_HORAS;
	    $tempora = gmdate('H:i:s', floor($tempora * 3600));
}else{
	$qtdra=0;
    $tempora= 0;
}

if($row = ibase_fetch_object ($query4)) {
		
		$qtdrna=$row->QTD;
		//$temporna= $row->D_SOMA_HORAS;
		//$temporna = gmdate('H:i:s', floor($temporna * 3600));
		
}else{
	$qtdrna=0;
	
}






//Libera a memoria usada
ibase_free_result($query);

//fecha conexão com o firebird
ibase_close($dbh);

?>
  
  
  
  

  <!-- Page Content -->
  <div class="container">

    <h1 class="my-4">TMA</h1>
     
   



    <div class="row">
      <div class="col-lg-8 mb-8">
        <div class="card h-100">
          <h4 class="card-header">
<form action="<?= $self; ?>" method="POST">

    <input type="date" name="today" value="<?= $today;?>">
	<input type="submit" name="a" value="Consultar">
	<input type="submit" name="b" value="Atualizar Pagina">
	<input type="submit" name="c" value="Atualizar Resultado">
	
    <button name="a" onclick="update()">Consulte</button>
    
</form>
<?=$formattedResult;?>
           
		  <h4 class="card-header"><?php echo "Ramal: $ramal"; ?></h4>
		  <h4 class="card-header"><?php echo $user; ?></h4>
		  <h4 class="card-header"><?php echo "Tempo Total: $tempoTotal"; ?></h4>
          



	
		  
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
</style>

<div class="card-footer">
            <h1>Chamadas:</h1>

<div class="grid-container">
  <div class="grid-item"></div>
  <div class="grid-item">Originadas</div>
  <div class="grid-item">Recebidas</div>  
  <div class="grid-item">Atendidas</div>
  <div class="grid-item"><?php echo $qtdoa; ?></div>
  <div class="grid-item"><?php echo $qtdra; ?></div>  
  <div class="grid-item">Perdidas</div>
  <div class="grid-item"><?php echo $qtdona; ?></div>
  <div class="grid-item"><?php echo $qtdrna; ?></div>
  <div class="grid-item">Tempo Atendimento</div> 
  <div class="grid-item"><?php echo $tempooa; ?></div> 
  <div class="grid-item"><?php echo $tempora; ?></div>   
  </div>
            
          </div>

		  
		  
          <div class="card-footer">
            <a href="JavaScript:location.reload(true);" class="btn btn-primary">Atualizar</a>
          </div>
        </div>
      </div>
	  
      





  
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>

</html>
