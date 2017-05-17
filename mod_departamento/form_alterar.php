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
  $id_secretaria = $_POST['id_secretaria'];
  $id_departamento = $_POST['id_departamento'];
  // Monta o update
  $sql = "update departamento set nome='$nome',id_secretaria='$id_secretaria' where id_departamento=$id_departamento ";
  // Executa o departamento
  pg_query($sql);
  // Redireciona o menino para a listagem
  ?>
  <script>
  window.location.href = "../mod_departamento/listar_departamento.php";
  </script>
<?php
  //header("Location: listar_departamento.php");
  exit(0);
}
// Se não vier id_departamento
if(!isset($_GET['id_departamento'])){
  // Tira o cara daí
  header("Location: listar_departamento.php");
  exit(0);
}
// Pega o departamento do banco que o menino clicou
$id_departamento = $_GET['id_departamento'];
// Busca o departamento específico que o menino clicou
$sql = "select * from departamento where id_departamento = $id_departamento";
$dados = pg_fetch_assoc(pg_query($sql));
?>

      <title>Altera Departamento</title>
    
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Alteração de Departamentos</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <input type="hidden" name="id_departamento" 
                            value="<?php echo $dados['id_departamento']; ?>" />
                            <label class="control-label" for="secretaria">Secretaria</label></br>
                            <?php include("select.inc_2.php"); ?><br />
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
