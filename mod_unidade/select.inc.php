<select name="id_unidade">
  <option value="">Selecione...</option>
  <?php
  $local = $_SESSION['local'];
  require("../_inc/conexao.inc.php");
  if (!$local == "") {
   $sql_unidade = "select * from unidade where local='$local' order by nome"; 
  }else{
    $sql_unidade = "select * from unidade order by nome";
  }
  $query_unidade = pg_query($sql_unidade);
  while($dados_unidade = pg_fetch_assoc($query_unidade)):
  ?>
  <option value="<?php echo $dados_unidade['id_unidade']; ?>"
    <?php
      if(isset($dados) 
        and $dados_unidade['id_unidade'] == $dados['unidade'])
      {
        echo " selected ";
      }
    ?>
    >
    <?php echo $dados_unidade['nome']; ?>
  </option>
  <?php endwhile; ?>
</select>
