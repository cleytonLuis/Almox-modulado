<?php
// Testa se veio o id_departamento
if(!isset($_GET['id_produto'])){
  // manda o carinha pra listagem 
  header("Location: listar_produto.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_departamento a ser removido
$id_produto = $_GET['id_produto'];
// Conecta
require("../_inc/conexao.inc.php");
// Deleta
$dados = pg_query("delete from produto where id_produto = $id_produto");
// manda o carinha pra listagem 
header("Location: listar_produto.php");
?>

