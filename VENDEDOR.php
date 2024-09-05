<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>SistemaCofer2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
	
	<meta http-equiv="refresh" content="120" />
	
	
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
<link href="./main.css" rel="stylesheet"></head>

<style>
body{
	width:90%;
	margin-left:5%;
}


table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  
  
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 0px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}


</style>

<script>
var i = setInterval(function () {
    
    clearInterval(i);
  
    // O código desejado é apenas isto:
    document.getElementById("loading").style.display = "none";
    document.getElementById("conteudo").style.display = "inline";
	document.getElementById("loading2").style.display = "none";
	document.getElementById("conteudo2").style.display = "inline";
	document.getElementById("loading3").style.display = "none";
	document.getElementById("conteudo3").style.display = "inline";
	document.getElementById("loading4").style.display = "none";
	document.getElementById("conteudo4").style.display = "inline";
	document.getElementById("loading5").style.display = "none";
	document.getElementById("conteudo5").style.display = "inline";
	document.getElementById("loading6").style.display = "none";
	document.getElementById("conteudo6").style.display = "inline";
	document.getElementById("loading7").style.display = "none";
	document.getElementById("conteudo7").style.display = "inline";
	

}, 4000);



</script>


<body>




				
				<div class="app-main__outer">
				
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                       
										<img src="assets/images/phone.png" >
                                        
                                    </div>
									
                                    <div>Acompanhamento TMA
                                        <div class="page-title-subheading">
                                        </div>
										<button class="mb-2 mr-2 btn btn-primary active">
										<?php

											
											//require 'acomp.php'
										include 'acomp.php';
										require 'ultimachamada.php';
                                        
											
												
											

                                             
											 echo "Ramal :".$_SESSION['r'];
												
											?>
                                        </button>
                                    </div>
                                </div>
                                <div class="page-title-actions">
								<?php

										
											
											echo "Selecionar data";	
											?>

                                   
										
										<form action="<?= $self; ?>" method="POST" >

<input type="date" name="today" value="<?= $today;?>">


<button class="btn btn-primary btn-lg ladda-button" id="ler-pagina" 
data-style="expand-right" data-size="l0"><span class="ladda-label">Atualizar</span></button>


</form>
										
                               
                                </div>    </div>
                        </div>            
						<div class="row">
			
                           <div class="col-md-4 col-xl-3" >
                                <div class="card mb-3 widget-content bg-midnight-bloom">
								
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
										
                                            <div class="widget-heading">Total TMA 

											</div>
                                            <div  class="widget-subheading"><?php
											
											
											echo "QTD: $qtdtotal";?>

											</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php
											
											echo "$tempoTotal";
											
											?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
                            <div class="col-md-4 col-xl-3">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Originadas</div>
                                            <div class="widget-subheading"><?php if($tempoTotal==null){ echo 0;}else{echo "QTD: $oa";} ?></div>
                                        </div>
										
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>
											<?php if($tempoTotal==null){ echo 0; }else{echo gmdate('H:i:s', floor($to * 3600));}?></span></div>
                                        </div>
										
                                    </div>

                                </div>
							
                            </div>
                            <div class="col-md-5 col-xl-3">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Recebidas</div>
                                            <div class="widget-subheading"><?php if($tempoTotal==null){ echo 0;}else{echo "QTD: $ra";} ?></div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>
											<?php if($tempoTotal==null){ echo 0; }else{echo gmdate('H:i:s', floor($tr * 3600));}?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
							<div class="col-md-5 col-xl-3">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Ultima Ligacao</div>
                                            <div class="widget-subheading"><?php echo "$numerochamada / $ultimachamada" ?></div>
											
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo "$tempochamada" ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
                          
                        </div>
                        
						
						  <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Diaria
                                        <div class="btn-actions-pane-right">
                                           
                                        </div>
                                    </div>
									
                                     <div class="row">
									 <div class="col-md-5 col-xl-3">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Meta</div>
                                            <div class="widget-subheading"></div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>3:00:00</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
						
							
							<div class="col-md-5 col-xl-3">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Valor</div>
                                            
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>Aguarde</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<div class="col-md-5 col-xl-3">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Dias Corridos</div>
                                            
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>
											
											<div id="loading" style="display: block">
											<img src="imagens/loading.gif" >
											</div>
											<div id="conteudo" style="display: none">
											<?php echo $du; ?>
											</div>
											
											</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							</div>		 
									 
                                   
                                </div>
                            </div>
                        </div>
                       
                        <div class="row col-xl-13" >
                                   <div class="col-md-4" >
                                    <div class="main-card mb-3 card" >
									     <li class="list-group-item" style="background-color:#A9E2F3">
                                                    <div class="widget-content p-0" style="background-color:#A9E2F3">
                                                        <div class="widget-content-outer">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">Originadas Perdidas</div>
                                                                    
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    <div class="widget-numbers text-danger">
																	<div id="loading2" style="display: block">
											                       <img src="imagens/loading.gif" >
											                       </div>
																   <div id="conteudo2" style="display: none">
																	<?php echo $ona; ?>
																	</div>
																	
																	</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
									
                                       <div style="height:140px;border:solid 2px orange;overflow:scroll;overflow-x:hidden;overflow-y:scroll;" >
																
                                                                
																	<div id="loading3" style="display: block">
											                       <img src="imagens/loading.gif" >
											                       </div>
																   <div id="conteudo3" style="display: none">
<table>
<tr>
    <th>Numero</th>
    
    <th>Hora</th>
  </tr>
																   
                                                                    <?php
                                                                    $query4=ibase_query ($dbh, $sqlcham);
																	while($row = ibase_fetch_object ($query4)) {
																		$row->CHAM_HORA;
																		$row->CHAM_IDENTIFICACAO;		
																		?>
					
					<tr>
					
						<td><?php echo "$row->CHAM_HORA"; ?></td>
						<td><?php echo "$row->CHAM_IDENTIFICACAO"; ?></td>
					
					</tr>
					
					
					<?php

}
   ?>
   </table>
</div>
                                                            
                                                    
                                                 </div>         
                                                    
                                            
                                       
                                    </div>
									
                                </div>
								
                                <div class="col-md-4" >
                                    <div class="main-card mb-3 card" >
									 <li class="list-group-item" style="background-color:#A9E2F3">
                                                    <div class="widget-content p-0" style="background-color:#A9E2F3">
                                                        <div class="widget-content-outer" >
                                                            <div class="widget-content-wrapper" >
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">Recebidas Perdidas</div>
                                                                    
                                                                </div>
                                                                <div class="widget-content-right" >
                                                                    <div class="widget-numbers text-danger" >
																	<div id="loading4" style="display: block">
											                       <img src="imagens/loading.gif" >
											                       </div>
																   <div id="conteudo4" style="display: none">
																	<?php echo $rna; ?>
																	</div>
																	
																	</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                        <div style="height:140px;border:solid 2px orange;overflow:scroll;overflow-x:hidden;overflow-y:scroll;" >
                                            
                                                   
                                                        
                                                           
                                                                
																<div id="loading5" style="display: block">
											                       <img src="imagens/loading.gif" >
											                       </div>
																   <div id="conteudo5" style="display: none">
																   
																   
	<table>
<tr>
    <th>Numero</th>
    
    <th>Hora</th>
  </tr>															   
                                                                    <?php
																
																	
   $query31=ibase_query ($dbh, $sqlchamrna);



while($row = ibase_fetch_object ($query31)) {
$row->CHAM_HORA;
$row->CHAM_IDENTIFICACAO;		

?>
					
					<tr>
					    <td><?php echo "$row->CHAM_IDENTIFICACAO"; ?></td>
						<td><?php echo "$row->CHAM_HORA"; ?></td>
						
					
					</tr>
					
					
					<?php

}
   ?>
   </table>
   </div>

                                                            
                                               </div>         
                                                    
                                            
                                       
                                    </div>
									
                                </div>
                                    
									 <div class="col-md-4">
                                    <div class="main-card mb-3 card">
									 <li class="list-group-item" style="background-color:#A9E2F3">
                                                    <div class="widget-content p-0" style="background-color:#A9E2F3">
                                                        <div class="widget-content-outer">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">Registro de Chamadas</div>
                                                                    
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    <div class="widget-numbers text-warning">
																	<div id="loading6" style="display: block">
											                       <img src="imagens/loading.gif" >
											                       </div>
																   <div id="conteudo6" style="display: none">
																	<?php echo $qg; ?>
																	</div>
																	
																	</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                        <div  style="height:140px;border:solid 2px orange;overflow:scroll;overflow-x:hidden;overflow-y:scroll;">
                                            
												<div id="loading7" style="display: block">
											                       <img src="imagens/loading.gif" >
											                       </div>
																   <div id="conteudo7" style="display: none " >
																   
<table>
<tr>
    <th>Numero</th>
    <th>Duracao</th>
    <th>Hora</th>
  </tr>
  
                                                    <?php
   $query5=ibase_query ($dbh, $sqlchamgeral);



while($row = ibase_fetch_object ($query5)) {
$row->CHAM_IDENTIFICACAO;
$row->CHAM_DURACAOLIGACAO;
$row->CHAM_HORA;
			

?>

					<tr>
						<td><?php echo "$row->CHAM_IDENTIFICACAO"; ?></td>
						<td><?php echo "$row->CHAM_DURACAOLIGACAO"; ?></td>
						
						<td><?php echo "$row->CHAM_HORA"; ?></td>
					</tr>
					
					
					
					
					<?php

}

//fecha conexão com o firebird

   ?>
   </table>
   </div>	
                                                            
                                               
                                        </div>
                                    </div>
                                </div>
									
									
                                </div>
								
                            </div>
							
							
							
                        </div>

                    </div>
					
					
					
                   </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<script type="text/javascript" src="./assets/scripts/main.js"></script></body>
</html>
