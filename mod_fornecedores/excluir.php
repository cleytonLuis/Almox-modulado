<?php
// Testa se veio o id_departamento
if(!isset($_GET['id_fornecedor'])){
  // manda o carinha pra listagem 
  header("Location: listar_fornecedores.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_departamento a ser removido
$id_fornecedor = $_GET['id_fornecedor'];
// Conecta
require("../_inc/conexao.inc.php");
// Deleta
$dados = pg_query("delete from fornecedor where id_fornecedor = $id_fornecedor");
// manda o carinha pra listagem 
header("Location: listar_fornecedores.php");
?>

