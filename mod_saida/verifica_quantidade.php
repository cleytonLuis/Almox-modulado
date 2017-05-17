<?php
require('../_inc/conexao.inc.php');
require("../_inc/verifica_sessao.inc.php");
if(isset($_GET['produto']))
{
	$id_produto=$_GET['produto'];
	$quantidade=$_GET['quantidade'];
	$sql=pg_query("select * from situacao where id_produto='$id_produto'");
	$dados_teste=pg_fetch_assoc($sql);
    
    if($dados_teste['quantidade']<$quantidade){
      echo "Quantidade informada é maior que a quantidade em estoque!!";
    exit(0);
	}else{
		echo "ok";
	}
}