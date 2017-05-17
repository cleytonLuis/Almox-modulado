<?php
// Conecta no banco
require("../_inc/conexao.inc.php");
require("../_inc/menu.inc.php");

// Se veio os dados do formulário
if($_SERVER['REQUEST_METHOD']=='POST')
{
  ob_start();
  // Pega os dados do formulário
  $nome = $_POST['nome'];
  $data_ini = $_POST['data_ini'];
  $data_fim = $_POST['data_fim'];
  $contato = $_POST['contato'];
  $email = $_POST['email'];
  $cnpj = $_POST['cnpj'];
  $id_fornecedor = $_POST['id_fornecedor'];
  // Monta o update
  $sql = "update fornecedor set nome='$nome',data_ini='$data_ini',data_fim='$data_fim',contato='$contato',email='$email',cnpj='$cnpj' where id_fornecedor=$id_fornecedor ";
  // Executa o departamento
  pg_query($sql);
  // Redireciona o menino para a listagem
  ?>
  <script>
  window.location.href = "../mod_fornecedores/listar_fornecedores.php";
  </script>
<?php
  //header("Location: listar_fornecedores.php");
  exit(0);
}
// Se não vier id_departamento
if(!isset($_GET['id_fornecedor'])){
  // Tira o cara daí
  header("Location: listar_fornecedores.php");
  exit(0);
}
// Pega o departamento do banco que o menino clicou
$id_fornecedor = $_GET['id_fornecedor'];
// Busca o departamento específico que o menino clicou
$sql = "select * from fornecedor where id_fornecedor = $id_fornecedor";
$dados = pg_fetch_assoc(pg_query($sql));
?>

      <title>Alterar Fornecedores</title>
   
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Alteração de Produtos</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <input type="hidden" name="id_fornecedor" 
                            value="<?php echo $dados['id_fornecedor']; ?>" />
                            <label class="control-label" for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" value="<?php echo $dados['nome']; ?>"
                             required="required" name="nome">
                             <label class="control-label" for="data_ini">Data Inicio</label>
                            <input type="text" class="form-control" id="data_ini" value="<?php echo $dados['data_ini']; ?>"
                             required="required" name="data_ini">
                             <label class="control-label" for="data_fim">Data Fim</label>
                            <input type="text" class="form-control" id="data_fim" value="<?php echo $dados['data_fim']; ?>"
                             required="required" name="data_fim">
                             <label class="control-label" for="contato">Contato</label>
                            <input type="text" class="form-control" id="contao" value="<?php echo $dados['contato']; ?>"
                             required="required" name="contato">
                             <label class="control-label" for="email">Email</label>
                            <input type="text" class="form-control" id="email" value="<?php echo $dados['email']; ?>"
                             required="required" name="email">
                             <label class="control-label" for="cnpj">Cnpj</label>
                            <input type="text" class="form-control" id="cnpj" value="<?php echo $dados['cnpj']; ?>"
                             required="required" name="cnpj">
                            </br><input type="submit" class="btn btn-primary" value="Alterar">
                        </div>
                    </form>
                </div>
        </div>
    </div>
<!-- /. WRAPPER  -->
   
