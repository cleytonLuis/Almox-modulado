<select name="id_escola">
  <option value="">Selecione...</option>
  <?php
  require("../_inc/conexao.inc.php");
  $sql_escola = "select * from escola order by nome";
  $query_escola = pg_query($sql_escola);
  while($dados_escola = pg_fetch_assoc($query_escola)):
  ?>
  <option value="<?php echo $dados_escola['id_escola']; ?>"
    <?php
      if(isset($dados) 
        and $dados_escola['id_escola'] == $dados['id_escola'])
      {
        echo " selected ";
      }
    ?>
    >
    <?php echo $dados_escola['nome']; ?>
  </option>
  <?php endwhile; ?>
</select>
