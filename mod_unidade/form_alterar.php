<?php
// Conecta no banco
require("../_inc/conexao.inc.php");
require("../_inc/menu.inc.php");
// Se veio os dados do formulário
if($_SERVER['REQUEST_METHOD']=='POST')
{
  ob_start();
  // Pega os dados do formulário
  $unidade = $_POST['unidade'];
  $id_unidade = $_POST['id_unidade'];
  // Monta o update
  $sql = "update unidade set nome='$unidade' where id_unidade=$id_unidade ";
  // Executa o departamento
  pg_query($sql);
  // Redireciona o menino para a listagem
  ?>
  <script>
  window.location.href = "listar_unidades.php";
  </script>
  <?php
  exit(0);
}
// Se não vier id_departamento
if(!isset($_GET['id_unidade'])){
  // Tira o cara daí
  ?>
  <script>
  window.location.href = "listar_unidades.php";
  </script>
  <?php
  exit(0);
}
// Pega o departamento do banco que o menino clicou
$id_unidade = $_GET['id_unidade'];
// Busca o departamento específico que o menino clicou
$sql = "select * from unidade where id_unidade = $id_unidade";
$dados = pg_fetch_assoc(pg_query($sql));
?>

      <title>Alterar Unidade de Medida</title>
   
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Alteração de unidade de medida</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <input type="hidden" name="id_unidade" 
                            value="<?php echo $dados['id_unidade']; ?>" />
                            <label class="control-label" for="nome">Unidade de Medida</label>
                            <input type="text" class="form-control" id="unidade" value="<?php echo $dados['nome']; ?>"
                             required="required" name="unidade">
                            </br><input type="submit" class="btn btn-primary" value="Alterar">
                        </div>
                    </form>
                </div>
        </div>
    </div>
<!-- /. WRAPPER  -->
    