<?php
if(isset($_GET['teste'])){
    session_start();
    $solicitante=$_SESSION[id_usuario];
    $pedido=$_SESSION[pedido];
    if($_GET['teste']=='fim'){
    	require('../_inc/conexao.inc.php');
    	$sql=pg_query("INSERT INTO solicitacao (id_solicitante,pedido) values ('$solicitante','$pedido') ");
       	$_SESSION[pedido]="";
    }else{
	    $teste =explode(",", $_GET['teste']);
		$produto = $teste[0];
		$quantidade= $teste[1];
		$guardado=$_SESSION[pedido];
		$_SESSION[pedido]=$guardado.'<br>Produto: '.$produto.' --- Quantidade: '.$quantidade;
		
	}	
}
