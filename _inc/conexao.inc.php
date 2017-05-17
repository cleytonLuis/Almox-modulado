<?php
// Configura para que o PHP sempre mostre erros
ini_set('display_errors','1');
// Configura o nível de erro a ser mostrado - todos
error_reporting(E_ALL);
// Conecta no postgres
$conexao = pg_connect("host=sgacarambei.postgresql.dbaas.com.br user=sgacarambei password=commandostech dbname=sgacarambei");
// Testa a conexao
if(!$conexao)
{
  die("Não foi possível conectar-se ao banco de dados");
}

?>
