<head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
</head>

<?php
function cria_select($tabela,$pk,$visual){
?>
	<select name="id_tabela" class="input-sm">
  		<option value="">Selecione...</option>
<?php
  require("conexao.inc.php");
  $sql_tabela = "select * from $tabela order by $visual";
  $query_tabela = pg_query($sql_tabela);
  while($dados = pg_fetch_assoc($query_tabela)):
?>
  <option value="<?php echo $dados[$pk]?>" name="<?php echo $pk?>" >
    <?php echo $dados[$visual]; ?>
  </option>
  <?php endwhile; ?>
	</select>
<?php
}
?>