<!DOCTYPE html>
<html lang="en">

<head>

<link rel="stylesheet" href="dist/ladda-themeless.min.css">

		<link rel="stylesheet" href="css/prism.css">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
{
  box-sizing: border-box;
}

.footer {
  text-align: center;
   position:fixed;
   height:50px;
   width:100%;
   background:#000000;
   bottom:0px;
   color:white;
   font-size:15px;
   line-height: 50px;
}

    iframe{

        width: 100%;
        frameBorder=0;
        

    }
	
	
body {
	
  margin: 0px;
  font-family: 'segoe ui';
}

.nav {
  height: 50px;
  width: 100%;
  background-color: #4d4d4d;
  position: relative;
}

.nav > .nav-header {
  display: inline;
}

.nav > .nav-header > .nav-title {
  display: inline-block;
  font-size: 22px;
  color: #fff;
  padding: 10px 10px 10px 10px;
}

.nav > .nav-btn {
  display: none;
}

.nav > .nav-links {
  display: inline;
  float: right;
  font-size: 18px;
}

.nav > .nav-links > a {
  display: inline-block;
  padding: 13px 10px 13px 10px;
  text-decoration: none;
  color: #efefef;
}

.nav > .nav-links > a:hover {
  background-color: #6E6E6E;
}

.nav > #nav-check {
  display: none;
}

@media (max-width:600px) {
  .nav > .nav-btn {
    display: inline-block;
    position: absolute;
    right: 0px;
    top: 0px;
  }
  .nav > .nav-btn > label {
    display: inline-block;
    width: 50px;
    height: 50px;
    padding: 13px;
  }
  .nav > .nav-btn > label:hover,.nav  #nav-check:checked ~ .nav-btn > label {
    background-color: rgba(0, 0, 0, 0.3);
  }
  .nav > .nav-btn > label > span {
    display: block;
    width: 25px;
    height: 10px;
    border-top: 2px solid #eee;
  }
  .nav > .nav-links {
    position: absolute;
    display: block;
    width: 100%;
    background-color: #333;
    height: 0px;
    transition: all 0.3s ease-in;
    overflow-y: hidden;
    top: 50px;
    left: 0px;
  }
  .nav > .nav-links > a {
    display: block;
    width: 100%;
  }
  .nav > #nav-check:not(:checked) ~ .nav-links {
    height: 0px;
  }
  .nav > #nav-check:checked ~ .nav-links {
    height: calc(100vh - 50px);
    overflow-y: auto;
  }
}
</style>

<link rel="stylesheet" href="dist/prelodr.min.css">

  <title>SistemaCofer</title>

 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
 
</head>

<script" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<body>

<div class="nav">
  <input type="checkbox" id="nav-check">
  <div class="nav-header">
    <div class="nav-title">
      Sistemas - Cofer Atacadista
	  </div>
	   
  </div>
  <div class="nav-btn">
    <label for="nav-check">
      <span></span>
      <span></span>
      <span></span>
    </label>
  </div>
  
  <div class="nav-links" id="btn-preloadr">
   
	<a href="supervisor/index.php" target="conteudo">Supervisor</a>
    <a href="acompanhamento.php"  target="conteudo">Acompanhamento</a>
	<a href="printertux/index.php"  target="conteudo">Cota de Impressao</a>
	
	
  </div>
  
</div>

    <!-- primeira div -->
    
	
<iframe src="http://free.timeanddate.com/clock/i6sarri7/n652/tlbr5/fs30/tct/pct/ahl/ftb/bls0/brs0/btcfff/bbs0/bbcfff" 
frameborder="0" width="122" height="37" allowTransparency="true"></iframe>

	



   <iframe  id="conteudo" name="conteudo" scrolling="no" frameBorder="0" src="principal.html" height="100%"

 
   ></iframe>
	  

  <!-- Footer -->
  
    <div class="footer" id="footer" >

      Copyright &copy; Cofer Atacadista
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
