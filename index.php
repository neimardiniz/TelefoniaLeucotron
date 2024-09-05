<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
      <link rel="stylesheet" href="style_login.css">
	  <style>
.modal-login {
		width: 320px;
	}
	.modal-login .modal-content {
		border-radius: 1px;
		border: none;
	}
	.modal-login .modal-header {
        position: relative;
		justify-content: center;
        background: #f2f2f2;
	}
    .modal-login .modal-body {
        padding: 30px;
    }
    .modal-login .modal-footer {
        background: #f2f2f2;
    }
	.modal-login h4 {
		text-align: center;
		font-size: 26px;
	}
    .modal-login label {
        font-weight: normal;
        font-size: 13px;
    }
	.modal-login .form-control, .modal-login .btn {
		min-height: 38px;
		border-radius: 2px; 
	}
	.modal-login .hint-text {
		text-align: center;
	}
	.modal-login .close {
        position: absolute;
		top: 15px;
		right: 15px;
	}
    .modal-login .checkbox-inline {
        margin-top: 12px;
    }
    .modal-login input[type="checkbox"]{
        margin-top: 2px;
    }
	.modal-login .btn {
        min-width: 100px;
		background: #3498db;
		border: none;
		line-height: normal;
	}
	.modal-login .btn:hover, .modal-login .btn:focus {
		background: #248bd0;
	}
	.modal-login .hint-text a {
		color: #999;
	}
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}
</style>
  
</head>

<body>

  <body>
	<div class="login">
		<div class="login-screen">
			<div class="app-title">
				<h1>Login</h1>
				
			</div>
			
<form name="form" action="" method="post" >
			<div class="login-form">
				<div class="control-group">
				<input type="text" class="login-field" value="" placeholder="Ramal" id="nome" name="nome">
				<label class="login-field-icon fui-user" for="login-name"></label>
				</div>

				<div class="control-group">
				<input type="password" class="login-field" value="" placeholder="Password" id="senha" name="senha">
				<label class="login-field-icon fui-lock" for="login-pass"></label>
				</div>

				
				<button type="submit" name="login" class="btn btn-primary btn-large btn-block">Acessar</button>
				
			</div>
			</form>
			
			<div class="text-center">
	<!-- Button HTML (to Trigger Modal) -->
	<p></p>
	<a href="#myModal"  data-toggle="modal">Alterar Senha</a>
	<p></p>
	Problemas: <a target="_blank"  href="http://192.168.254.218/glpi">Clique aqui</a>
	
</div>


<!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<form action="" method="post">
				<div class="modal-header">				
					<h4 class="modal-title">Alterar Senha</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">				
					<div class="form-group">
						<label>Ramal</label>
						<input type="text" class="form-control" required="required" name="ramal" id="ramal">
					</div>
					<div class="form-group">
						<label>Senha Atual</label>
						<input type="password" class="form-control" required="required" name="senhaatual" id="senhaatual">
					</div>
					<div class="form-group">
						<label>Nova Senha</label>
						<input type="password" class="form-control" required="required" name="senhanova" id="senhanova">
					</div>
					<div class="form-group">
						<label>Repetir Senha</label>
						<input type="password" class="form-control" required="required" name="repetir" id="repetir">
					</div>
					
					
				</div>
				
			
				<div class="modal-footer">
					
					<input type="submit" class="btn btn-primary btn-large btn-block" value="Salvar" name="salvar">
				</div>
			</form>
			
		</div>
	</div>
</body>
  
  <?php
  

  
if(isset($_POST['login'])){
$nome= $_POST['nome'];
$senha= $_POST['senha'];


$servername = "192.168.254.208";
$username = "%";
$password = "";
$dbname = "telefonia";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sqlw = $conn->query("select * from usuarios where ramal=$nome");

 $row = $sqlw->fetch_row();

 $ramalb= $row[0];
 $senhab= $row[1];
 
 
 ////////////////////////////////////////////////
 $conn = '192.168.254.208:C:\Program Files (x86)\Leucotron Telecom\Banco de Dados\CONTACTION.FDB';

//conexão com o banco, se der erro mostrara uma mensagem.
if (!($dbh=ibase_connect($conn, 'SYSDBA', 'masterkey')))
die('Erro ao conectar: ' . ibase_errmsg());



$sqlnn="select * from usuarios where usu_logon='$nome'";

$query5=ibase_query ($dbh, $sqlnn);



if($row = ibase_fetch_object ($query5)) {
$logon=$row->USU_LOGON;

		}

////////////////////////////////////////////////
 $sqluser="SELECT 

ppp.con_nome

from  usuarios pp,contatos ppp where
ppp.contato_id = pp.usu_contato_id
and pp.usu_logon='$logon'

group by ppp.con_nome";


$queryu=ibase_query ($dbh, $sqluser);

	if($row = ibase_fetch_object ($queryu)) {
		
		$n= $row->CON_NOME ;
		
		
		}
		
		
$sqlcargo="select con_cargo from contatos where con_nome='$n'";


$query11=ibase_query ($dbh, $sqlcargo);

	while($row = ibase_fetch_object ($query11)) {
		
		$cargo= $row->CON_CARGO ;
		
		
		}		
		
		
 session_start(); // Inicia a Sessão
$_SESSION['n'] = $n; // Grava na sessão chamada nome a variável 
$_SESSION['c'] = $cargo; // Grava na sessão chamada nome a variável 



if($nome==$senha){
	echo '<script language="javascript">';
echo 'alert("Favor alterar sua senha para logar")';
echo '</script>';
exit;	
}

if($ramalb==$nome&&$senhab==$senha){
 
	
header('Location: geral.php');	
}else{
	echo '<script language="javascript">';
echo 'alert("usuario ou senha incorreto")';
echo '</script>';
}



}


?>


<?php
	if(isset($_POST['salvar'])){
$ramal= $_POST['ramal'];
$senha= $_POST['senhaatual'];
$senhanova= $_POST['senhanova'];
$repetir= $_POST['repetir'];			
				
$servername = "192.168.254.208";
$username = "%";
$password = "";
$dbname = "telefonia";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sqlw = $conn->query("select * from usuarios where ramal=$ramal");

 $row = $sqlw->fetch_row();

 $ramalb= $row[0];
 $senhab= $row[1];
 
 if($ramalb==$ramal&&"$senha"=="$senhab"&&"$senhanova"=="$repetir"){
	
  $sql = "UPDATE usuarios SET senha='$senhanova' WHERE ramal=$ramalb";
 mysqli_query($conn, $sql);
	
   echo '<script language="javascript">';
echo 'alert("Senha alterada com sucesso")';
echo '</script>';
} else {
    echo '<script language="javascript">';
echo 'alert("Senha ou Ramal incorretos")';
echo '</script>';

        echo "<script>$('#myModal').modal('show')</script>";
exit;


	 
 }

$conn->close();	
	 
 	 
 
 
	}
 

?>	

</body>

</html>
