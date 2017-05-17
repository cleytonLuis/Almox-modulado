<select name="id_produto" id="id_produto">
  <option value="">Selecione...</option>
  <?php
  $local = $_SESSION['local'];
  require("../_inc/conexao.inc.php");
  require('../_inc/verifica_sessao.inc.php');
  if (!$local == "") {
    $sql_produto = "SELECT p.*,u.nome as unidade,
    count(*) over() as total 
    FROM produto p 
    inner join unidade u on p.unidade = u.id_unidade 
    where p.local='$local' order by p.nome";  
  }else{
    $sql_produto = "SELECT p.*,u.nome as unidade,
    count(*) over() as total 
    FROM produto p 
    inner join unidade u on p.unidade = u.id_unidade order by nome";
  }
  

  $query_produto = pg_query($sql_produto);
  while($dados_produto = pg_fetch_assoc($query_produto)):
  ?>
  <option  value="<?php echo $dados_produto['id_produto']." - ".$dados_produto['nome']; ?>"
    <?php
      if(isset($dados) 
        and $dados_produto['id_produto'] == $dados['produto'])
      {
        echo " selected ";
      }
    ?>
    >
    <?php echo $dados_produto['nome']."  (".$dados_produto['unidade'].")"; ?>
  </option>
  <?php endwhile; ?>
</select>
