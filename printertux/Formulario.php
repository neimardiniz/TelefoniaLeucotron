    
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    
    Pesquisar:<input type="text" name="pesquisar" placeholder="conteudo">
    
    <input type="submit" value="ENVIAR" name="envia">

</form>




<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

	<select name="selecionar" class="select" id="selecionar" >

    <option value="ativo" <?php if (isset($_POST['selecionar']) && $_POST['selecionar'] == "ativo") {
  echo 'selected="selected"';} ?> >ativo</option>

  <option value="inativo" <?php if (isset($_POST['selecionar']) && $_POST['selecionar'] == "inativo") {
  echo 'selected="selected"';} ?> >inativo</option>
  </select>
    
    


    <input type="submit" value="selecionar" name="seleciona">

</form>

<?php
if(isset($_POST['seleciona'])){
$selected_val = $_POST['selecionar'];  
echo  $selected_val;  
}
?>




	
<div id="retorno">

<?php


if (isset($_POST['envia'])){

include 'conexao.php';

}


if (isset($_POST['seleciona'])){


switch($_POST['selecionar']){
    case 'ativo' : 
        $s=1;

        break;
    case 'inativo':
        $s=0;
        break;
    default:
        echo "algum erro";
}

include 'conexao.php';

}



?>

</div>
