<?php
// Testa se veio o id_departamento
if(!isset($_GET['id_ubs'])){
  // manda o carinha pra listagem 
  header("Location: listar_ubs.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_departamento a ser removido
$id_ubs = $_GET['id_ubs'];
// Conecta
require("../_inc/conexao.inc.php");
// Deleta
$dados = pg_query("delete from ubs where id_ubs = $id_ubs");
// manda o carinha pra listagem 
header("Location: listar_ubs.php");
?>

