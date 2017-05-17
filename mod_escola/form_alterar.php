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
  $id_departamento = $_POST['id_escola'];
  // Monta o update
  $sql = "update escola set nome='$nome' where id_escola=$id_escola";
  // Executa o departamento
  pg_query($sql);
  // Redireciona o menino para a listagem
  ?>
  <script>
  window.location.href = "../mod_escola/listar_escola.php";
  </script>
<?php
  exit(0);
}
// Se não vier id_departamento
if(!isset($_GET['id_escola'])){
  // Tira o cara daí
  header("Location: listar_escola.php");
  exit(0);
}
// Pega o departamento do banco que o menino clicou
$id_escola = $_GET['id_escola'];
// Busca o departamento específico que o menino clicou
$sql = "select * from escola where id_escola = $id_escola";
$dados = pg_fetch_assoc(pg_query($sql));
?>

      <title>Altera Escola</title>
    
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Alteração de Escolas</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <input type="hidden" name="id_escola" 
                            value="<?php echo $dados['id_escola']; ?>" />
                            <label class="control-label" for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" value="<?php echo $dados['nome']; ?>"
                             required="required" name="nome">
                            </br><input type="submit" class="btn btn-primary" value="Alterar">
                        </div>
                    </form>
                </div>
        </div>
    </div>
<!-- /. WRAPPER  -->
