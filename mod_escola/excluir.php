<?php
// Testa se veio o id_departamento
if(!isset($_GET['id_escola'])){
  // manda o carinha pra listagem 
  header("Location: listar_escola.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_departamento a ser removido
$id_escola = $_GET['id_escola'];
// Conecta
require("../_inc/conexao.inc.php");
// Deleta
$dados = pg_query("delete from escola where id_escola = $id_escola");
// manda o carinha pra listagem 
header("Location: listar_escola.php");
?>

