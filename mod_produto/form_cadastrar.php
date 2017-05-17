<?php
require("../_inc/menu.inc.php");
if($_SERVER['REQUEST_METHOD']=='POST')
{
  // Inicia o buffer de saída
  ob_start();
  // requerendo a conexão com o banco
  require("../_inc/conexao.inc.php");
  // Pegar do formulário o nome digitado pelo cliente
  $nome = $_POST['nome'];
  $unidade = $_POST['id_unidade'];
  $local = $_POST['local'];
  // Monta a SQL de inserção
  $sql = "INSERT INTO produto (nome,unidade,local) VALUES ('$nome','$unidade','$local')";
  // Executo a Query
  pg_query($sql) or die(pg_last_error());
  // Redireciona para a listagem
  ?>
  <script>
  window.location.href = "../mod_produto/listar_produto.php";
  </script>
<?php
}
?>

        <title>Cadastro Produtos</title>
          <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Cadastro de Produtos</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post">
                    <input type="hidden" name="local" value="<?php echo $_SESSION['local']; ?>">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <label class="control-label" for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" required="required" name="nome">
                            Unidade</br>
                            <?php include("select.inc.php") ?></br>
                            </br><input type="submit" class="btn btn-primary" value="Cadastrar">
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <!-- /. WRAPPER  -->
    
   

