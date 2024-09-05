<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  
  
  
      <link rel="stylesheet" href="style_login.css">

  
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
		</div>
	</div>
</body>
  
  <?php
if(isset($_POST['login'])){
$nome= $_POST['nome'];
$senha= $_POST['senha'];



$conn = '192.168.254.208:C:\Program Files (x86)\Leucotron Telecom\Banco de Dados\CONTACTION.FDB';

//conexão com o banco, se der erro mostrara uma mensagem.
if (!($dbh=ibase_connect($conn, 'SYSDBA', 'masterkey')))
die('Erro ao conectar: ' . ibase_errmsg());


$sql="select * from usuarios where usu_logon='$nome'";

$query5=ibase_query ($dbh, $sql);



if($row = ibase_fetch_object ($query5)) {
$logon=$row->USU_LOGON;}else{
			echo '<script language="javascript">';
echo 'alert("usuario ou senha incorreto")';
echo '</script>';
			exit;
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
		
		
		}else{
			echo '<script language="javascript">';
echo 'alert("usuario ou senha incorreto")';
echo '</script>';
			exit;
		}
 session_start(); // Inicia a Sessão
$_SESSION['n'] = $n; // Grava na sessão chamada nome a variável 
/////////////////////////////////////////////////////////////

if($nome==$logon&&$senha==$nome){
	header('Location: geral.php'); 


}else{
	echo '<script language="javascript">';
echo 'alert("usuario ou senha incorreto")';
echo '</script>';
}


}
?>

</body>

</html>
