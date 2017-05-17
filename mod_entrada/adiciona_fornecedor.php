<?php
if($_SERVER['REQUEST_METHOD']=='GET')
{
  // requerendo a conexão com o banco
  require('../_inc/verifica_sessao.inc.php');
  require("../_inc/conexao.inc.php");
  // Pegar do formulário o nome digitado pelo cliente
  $nome = $_GET['nome'];
  $data_ini = $_GET['data_ini'];
  $data_fim = $_GET['data_fim'];
  $contato = $_GET['contato'];
  $email = $_GET['email'];
  $cnpj = $_GET['cnpj'];
  $local=$_SESSION['local'];
  // Monta a SQL de inserção
  $sql = "INSERT INTO fornecedor (nome,data_ini,data_fim,contato,email,cnpj,local) VALUES ('$nome','$data_ini','$data_fim','$contato','$email','$cnpj','$local') RETURNING id_fornecedor";
  // Executo a Query
  $query=pg_query($sql) or die(pg_last_error());
  $id_fornecedor = pg_result($query,0,'id_fornecedor');
  echo $id_fornecedor;
    
}