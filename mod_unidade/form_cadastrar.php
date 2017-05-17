<?php
require("../_inc/menu.inc.php");

if($_SERVER['REQUEST_METHOD']=='POST')
{
  // Inicia o buffer de saída
  ob_start();
  // requerendo a conexão com o banco
  require("../_inc/conexao.inc.php");
  // Pegar do formulário o nome digitado pelo cliente
  $unidade = $_POST['unidade'];
  $local = $_POST['local'];
  // Monta a SQL de inserção
  $sql = "INSERT INTO unidade (nome,local) VALUES ('$unidade','$local')";
  // Executo a Query
  pg_query($sql) or die(pg_last_error());
  // Redireciona para a listagem
  ?>
  <script>
  window.location.href = "listar_unidades.php";
  </script>
  <?php
}
?>

        <title>Cadastro Unidades</title>
          <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Cadastro de unidades de medida</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post">
                      <input type="hidden" name="local" value="<?php echo $_SESSION['local']; ?>">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <label class="control-label" for="unidade">Unidade</label>
                            <input type="text" class="form-control" id="unidade" required="required" name="unidade">
                            </br><input type="submit" class="btn btn-primary" value="Cadastrar">
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <!-- /. WRAPPER  -->
    
   

