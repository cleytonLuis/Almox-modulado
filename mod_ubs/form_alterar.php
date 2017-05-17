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
  $id_ubs = $_POST['id_ubs'];
  // Monta o update
  $sql = "update ubs set nome='$nome' where id_ubs=$id_ubs ";
  // Executa o departamento
  pg_query($sql);
  // Redireciona o menino para a listagem
  ?>
  <script>
  window.location.href = "../mod_ubs/listar_ubs.php";
  </script>
<?php
  //header("Location: listar_departamento.php");
  exit(0);
}
// Se não vier id_departamento
if(!isset($_GET['id_ubs'])){
  // Tira o cara daí
  header("Location: listar_ubs.php");
  exit(0);
}
// Pega o departamento do banco que o menino clicou
$id_ubs = $_GET['id_ubs'];
// Busca o departamento específico que o menino clicou
$sql = "select * from ubs where id_ubs = $id_ubs";
$dados = pg_fetch_assoc(pg_query($sql));
?>

      <title>Altera UBS's</title>
    
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Alteração de UBS's</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <input type="hidden" name="id_ubs" 
                            value="<?php echo $dados['id_ubs']; ?>" />
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
