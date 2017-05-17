<?php
require("../_inc/menu.inc.php");
require("../_inc/conexao.inc.php");

if($_SERVER['REQUEST_METHOD']=='POST')
{
  // Inicia o buffer de saída
  ob_start();
  // requerendo a conexão com o banco
  require("../_inc/conexao.inc.php");
  // Pegar do formulário o nome digitado pelo cliente
  $nome = $_POST['nome'];
  // Monta a SQL de inserção
  $sql = "INSERT INTO ubs (nome) VALUES ('$nome')";
  // Executo a Query
  pg_query($sql) or die(pg_last_error());
  // Redireciona para a listagem
  ?>
  <script>
  window.location.href = "../mod_ubs/listar_ubs.php";
  </script>
<?php
}
?>

      <title>Cadastro UBS's</title>

        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Cadastro de UBS's</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <label class="control-label" for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" required="required" name="nome">
                            </br><input type="submit" class="btn btn-primary" value="Cadastrar">
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <!-- /. WRAPPER  -->
    