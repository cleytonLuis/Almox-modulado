<select name="id_ubs">
  <option value="">Selecione...</option>
  <?php
  require("../_inc/conexao.inc.php");
  $sql_ubs = "select * from ubs order by nome";
  $query_ubs = pg_query($sql_ubs);
  while($dados_ubs = pg_fetch_assoc($query_ubs)):
  ?>
  <option value="<?php echo $dados_ubs['id_ubs']; ?>"
    <?php
      if(isset($dados) 
        and $dados_ubs['id_ubs'] == $dados['id_ubs'])
      {
        echo " selected ";
      }
    ?>
    >
    <?php echo $dados_ubs['nome']; ?>
  </option>
  <?php endwhile; ?>
</select>
