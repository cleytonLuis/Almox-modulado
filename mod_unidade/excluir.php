<?php
// Testa se veio o id_unidade
if(!isset($_GET['id_unidade'])){
  // manda o carinha pra listagem 
  header("Location: listar_unidades.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_unidade a ser removida
$id_unidade = $_GET['id_unidade'];
// Conecta
require("../_inc/conexao.inc.php");
// Deleta
$dados = pg_query("delete from unidade where id_unidade = $id_unidade");
// manda o carinha pra listagem 
header("Location: listar_unidades.php");
?>

