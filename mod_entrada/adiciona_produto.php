<?php
if($_SERVER['REQUEST_METHOD']=='GET'){

  require("../_inc/conexao.inc.php");
  require("../_inc/verifica_sessao.inc.php");
  $nome=$_GET['nome'];
  $unidade=$_GET['id_unidade'];
  $local=$_SESSION['local'];
  $sql = "INSERT INTO produto (nome,unidade,local) VALUES ('$nome','$unidade','$local') RETURNING id_produto";
  // Executo a Query
  $query=pg_query($sql) or die(pg_last_error());
  $id_produto = pg_result($query,0,'id_produto');
  echo $id_produto;
}