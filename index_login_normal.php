<html>
<body>
<style>

</style>

<form name="form" action="" method="post" >
  Ramal: <input type="text" name="nome" id="nome" placeholder="Username"><br>
  Senha:<input type="password" name="senha" id="senha" placeholder="Password"><br>
  <button type="submit" name="login">Acessar</button>
</form>


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



while($row = ibase_fetch_object ($query5)) {
$logon=$row->USU_LOGON;}

////////////////////////////////////////////////
 $sqluser="SELECT 

ppp.con_nome

from usuarios_chamadas p, usuarios pp,contatos ppp where p.cham_usuario_id = pp.usuario_id 
and ppp.contato_id = pp.usu_contato_id
and pp.usu_logon='$logon'

group by ppp.con_nome";


$queryu=ibase_query ($dbh, $sqluser);

	while($row = ibase_fetch_object ($queryu)) {
		
		$n= $row->CON_NOME ;
		
		
		}
 session_start(); // Inicia a Sessão
$_SESSION['n'] = $n; // Grava na sessão chamada nome a variável 
/////////////////////////////////////////////////////////////

if($nome==$logon&&$senha==$nome){
	header('Location: geral.php'); 


}else{
	echo "senha ou usuario errados";
}


}






//echo $_POST['senha'];






 
   ?>

</body> 
 </html>

  