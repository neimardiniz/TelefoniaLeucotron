<!DOCTYPE html>
<html lang="en">

<head>



<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />

<link rel="stylesheet" href="dist/ladda-themeless.min.css">

		<link rel="stylesheet" href="css/prism.css">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

@media screen and (max-width: 43.68em) --( device width < 219px)

@media screen and (min-width: 43.69em) and (max-width: 59.49em) -- (Device witdh >= 219px and width < 952px)

@media screen and (min-width: 59.5em) and (max-width: 80.99em) -- (Device width >= 953px and width < 1296px)

@media screen and (min-width: 81em) -- (Device with >= 1296px)

{
  box-sizing: border-box;
}



.footer {
  text-align: center;
   position:fixed;
   height:45px;
   width:100%;
   background:#000000;
   bottom:0;
   color:white;
   font-size:15px;
   line-height: 50px;
   margin-top: -50px;
}


.divgeral {
height: 650px;
overflow: auto;


}


    iframe{

        width: 100%;
        frameBorder=0;
        

    }
	
	
	
body {
 min-height: 100%;
  heigth:100%;	
  margin: 0px;
  font-family: 'segoe ui';
}


.jj{
	border-bottom: 1px solid #BDBDBD;
	height:50px;
}

h3 {
  font-size: 30px;
  line-height: 34px;
  text-align: center;
  color: #FFF;
}

h3 a { color: #FFF; }

a { color: #FFF; }

h1 {
  margin-top: 100px;
  text-align: center;
  font-size: 60px;
  line-height: 70px;
  font-family: 'roboto', sans-serif;
}

#container {
  margin: 0 auto;
  max-width: auto;
}

p { text-align: center; }
 .toggle, [id^=drop] {
 display: none;
}

nav {
  margin: 0 ;
  padding: 0;
  background-color: #2E2E2E;
  
}

#logo {
  display: block;
  padding: 0 30px;
  float: left;
  font-size: 20px;
  line-height: 60px;
  color:#FAFAFA;
}

nav:after {
  content: "";
  display: table;
  clear: both;
 
}

nav ul {
  float:left;
  
  padding: 0;
  margin: 0;
  list-style: none;
  position: relative;
}

nav ul li {
  margin: 0px;
  display: inline-block;
  float: left;
  background-color: #2E2E2E;
}

nav a {
  display: block;
  padding: 0 20px;
  color: #FFF;
  font-size: 20px;
  line-height: 60px;
  text-decoration: none;
}

nav ul li ul li:hover { background: #0B6138; }

nav a:hover { background-color: #0B6138; }

nav ul ul {
  display: none;
  position: absolute;
  top: 60px;
}

nav ul li:hover > ul { display: inherit; }

nav ul ul li {
  width: 250px;
  float: none;
  display: list-item;
  position: relative;
}

nav ul ul ul li {
  position: relative;
  top: -60px;
  left: 170px;
}

li > a:after { content: url('imagens/setab.png');
 
 }

li > a:only-child:after { content: ''; }


/* Media Queries
--------------------------------------------- */

@media all and (max-width : 768px) {

#logo {
  display: block;
  padding: 0;
  width: 100%;
  text-align: center;
  float: none;
  
}

nav { margin: 0; }

.toggle + a,
 .menu { display: none; }

.toggle {
	
  display: block;
  background-color: #2E2E2E;
  padding: 0 20px;
  color: #FFF;
  font-size: 20px;
  line-height: 60px;
  text-decoration: none;
  border: none;
}

.toggle:hover { background-color: #0B6138; }

[id^=drop]:checked + ul { display: block; }

nav ul li {
  display: block;
  width: 100%;
}

nav ul ul .toggle,
 nav ul ul a { padding: 0 40px; }

nav ul ul ul a { padding: 0 80px; }

nav a:hover,
 nav ul ul ul a { background-color: #0B6138; }

nav ul li ul li .toggle,
 nav ul ul a { background-color: #2E2E2E; }

nav ul ul {
  float: none;
  position: static;
  color: #ffffff;
}

nav ul ul li:hover > ul,
nav ul li:hover > ul { display: none; }

nav ul ul li {
  display: block;
  width: 100%;
}

nav ul ul ul li { position: static;

}
}

@media all and (max-width : 330px) {

nav ul li {
  display: block;
  width: 94%;
}

}



</style>

<link rel="stylesheet" href="dist/prelodr.min.css">

  <title>SistemaCofer</title>

 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
 
</head>

<script" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<body>


  
  <?php
  include('supervisor/conn.php');
 session_start(); // Inicia a Sessão
 
if (empty($_SESSION['n'])) {
	
	 header('Location: index.php');  
     exit;
}
	
	$usuario=$_SESSION['n'];
	
	
    
  
  $sqlcargo="select con_cargo from contatos where con_nome='$usuario'";


$query1=ibase_query ($dbh, $sqlcargo);

	while($row = ibase_fetch_object ($query1)) {
		
		$cargo= $row->CON_CARGO ;
		
		
		}
		
	if($cargo=='SUPERVISOR'){	
	$link= "supervisor/index.php";
	
	}
	
	if($cargo=='TI'){
	$link= "supervisor/index.php";	
	}
	else{
		
	$func="Acompanhamento Individual";
	}
	
  

	
	
  ?>
  
 <nav>
 
  <div id="logo">Sistemas Cofer |</div>
   
  <label for="drop" class="toggle">Menu </label>
  <input type="checkbox" id="drop">
  <ul class="menu">
    <li>
  <a><?php echo "$usuario"; ?></a></li>
  <li><a href="index.php"  >Login</a>
  </li>
    <li> 
	
      <!-- First Tier Drop Down -->
      <label for="drop-1" class="toggle">Supervisor </label>
	  
      <a href="#">Supervisor</a>
      <input type="checkbox" id="drop-1">
      <ul id="btn-preloadr">
        <li>
		
      <a href="supervisor/index.php" target="conteudo" >Supervisao</a></li>
	  
        <li ><a href="acompcompleto.php"  target="conteudo">Analise de chamadas</a></li>
        
      </ul>
    </li>
    <li> 
      
      <!-- First Tier Drop Down -->
      <label for="drop-2" class="toggle">Vendedor </label>
      <a href="#">Vendedor</a>
      <input type="checkbox" id="drop-2">
	  
      <ul id="btn-preloadr2">
        <li><a href="vendedor.php"  target="conteudo">Acompanhamento</a></li>
        <li ><a href="acompcompleto.php"  target="conteudo">Analise de chamadas</a></li>
		
     
      </ul>
	  
    </li>
	
	
	   <li> 
      
      <!-- First Tier Drop Down -->
      <label for="drop-3" class="toggle">Impressao </label>
      <a href="#">Impressao</a>
      <input type="checkbox" id="drop-3">
	  
      <ul id="btn-preloadr3">
        <li><a href="http://192.168.254.218/printertux/"  target="conteudo">Cota de Impressao</a></li>
        
     
      </ul>
	  
    </li>
 
 <!-- sic -->
 <li><a href="http://192.168.254.208/sic/index.php" target="_blank" >Sic</a>
  </li>
  
   <li><a href="https://web.whatsapp.com/" target="_blank" >Whatsapp Web</a>
  </li>
  
  <li><a href="https://outlook.live.com/owa/" target="_blank" >E-mail Cofer</a>
  </li>
 
     <li> 
      
      <!-- vendas -->
      <label for="drop-2" class="toggle">Vendas </label>
      <a href="#">Vendas</a>
      <input type="checkbox" id="drop-4">
	  
      <ul id="btn-preloadr2">
       
        <li ><a href="../../sic/modulos/supervisao1"  target="_blank">Resumo de vendas</a></li>
		<li ></li>
     
      </ul>
	  
    </li>
 
 
 
 
  </ul>
   
</nav> 
  




    <!-- primeira div -->
    
	







	<div class="divgeral">



   <iframe  id="conteudo" name="conteudo" scrolling="yes" frameBorder="0" src="principal.html" height="600px" />
    
     
   </iframe>
	  
</div>
  <!-- Footer -->
  
    <div class="footer" id="footer" >

      Copyright &copy; Cofer Atacadista - v.2.0.1 - Neimar
	  
    </div>
    <!-- /.container -->
  

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	
   
  <!-- /script java botao de progresso -->
		<script src="dist/spin.min.js"></script>
		<script src="dist/ladda.min.js"></script>

		<script>

			// Bind normal buttons
			Ladda.bind( 'div:not(.progress-demo) button', { timeout: 2000 } );

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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 
  
  <!-- script preload -->
 <script src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="dist/prelodr.js"></script>
    <script>
	
	
      $(function() {

        $('body').prelodr({
          prefixClass: 'prelodr',
          show: function(){
            console.log('Show callback')
          },
          hide: function(){
            console.log('Hide callback')
          }
        })

        $('#btn-preloadr').on('click', function(){
          // Show prelodr (Chaining support)
		  
          $('body').prelodr('in', 'Comecando...');
          $('body').prelodr('out');
          $('body').prelodr('in', 'Processando...');
          $('body').prelodr('out', function (done) {
            setTimeout(function () {
              done();
			  
            }, 2000);
          });
          $('body').prelodr('in', 'Carregado...');
          $('body').prelodr('out');
		  
        })
 $('#btn-preloadr2').on('click', function(){
          // Show prelodr (Chaining support)
		  
          $('body').prelodr('in', 'Comecando...');
          $('body').prelodr('out');
          $('body').prelodr('in', 'Processando...');
          $('body').prelodr('out', function (done) {
            setTimeout(function () {
              done();
			  
            }, 2000);
          });
          $('body').prelodr('in', 'Carregado...');
          $('body').prelodr('out');
		  
        })
		
		$('#btn-preloadr3').on('click', function(){
          // Show prelodr (Chaining support)
		  
          $('body').prelodr('in', 'Comecando...');
          $('body').prelodr('out');
          $('body').prelodr('in', 'Processando...');
          $('body').prelodr('out', function (done) {
            setTimeout(function () {
              done();
			  
            }, 50);
          });
          $('body').prelodr('in', 'Carregado...');
          $('body').prelodr('out');
		  
        })

      })
	
    </script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


    <script>

    // Selecting the iframe element

    var iframe = document.getElementById("conteudo");

    

    // Adjusting the iframe height onload event

    iframe.onload = function(){

        iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';

    }

    </script>
	
	



</body>

</html>
