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
  $data_ini = $_POST['data_ini'];
  $data_fim = $_POST['data_fim'];
  $contato = $_POST['contato'];
  $email = $_POST['email'];
  $cnpj = $_POST['cnpj'];
  $local = $_POST['local'];
  // Monta a SQL de inserção
  $sql = "INSERT INTO fornecedor (nome,data_ini,data_fim,contato,email,cnpj,local) VALUES ('$nome','$data_ini','$data_fim','$contato','$email','$cnpj','$local')";
  // Executo a Query
  pg_query($sql) or die(pg_last_error());
  // Redireciona para a listagem
  ?>
  <script>
  window.location.href = "../mod_fornecedores/listar_fornecedores.php";
  </script>
<?php
}
?>
      <title>Cadastro Fornecedores</title>
    
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Cadastro de Fornecedores</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <input type="hidden" name="local" value="<?php echo $_SESSION['local'];?>">
                            <label class="control-label" for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" required="required" name="nome">
                            <label class="control-label" for="data_ini">Data de Inicio de Contrato</label>
                            <input type="text" class="form-control" id="data_ini" required="required" name="data_ini">
                            <label class="control-label" for="data_fim">Data de Fim de Contrato</label>
                            <input type="text" class="form-control" id="data_fim" required="required" name="data_fim">
                            <label class="control-label" for="contato">Contato</label>
                            <input type="text" class="form-control" id="contato" required="required" name="contato">
                            <label class="control-label" for="email">Email</label>
                            <input type="text" class="form-control" id="email" required="required" name="email">
                            <label class="control-label" for="cnpj">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" required="required" name="cnpj">
                            </br><input type="submit" class="btn btn-primary" value="Cadastrar">
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <!-- /. WRAPPER  -->
    
    <script src="jquery.maskedinput.js" type="text/javascript"></script>
    <script type="text/javascript">
      $("#contato").mask("(99) 9999-9999");
      $("#cnpj").mask("99.999.999/9999-99");
      $("#data_ini").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});
      $("#data_fim").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});
    </script>