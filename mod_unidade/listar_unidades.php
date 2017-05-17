<?php
require("../_inc/menu.inc.php");
require("../_inc/conexao.inc.php");
$local = $_SESSION['local'];
if (!$local == "") {
$query = pg_query("SELECT * FROM  unidade where local='$local'");
}else{
    $query = pg_query("SELECT * FROM  unidade");
}
?>

      <title>Unidades de Medida</title>
    
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Unidades de Medida<a href="form_cadastrar.php" class="btn btn-primary" style="float:right;"> Cadastrar nova unidade de medida</a></h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <div class="panel panel-default col-md-12">
                                <div class="panel-heading">
                                    Selecione a unidade de medida
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Unidade de Med.</th>
                                                    <th>Opções</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        while ($dados = pg_fetch_assoc($query)):
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $dados['nome']; ?></td>
                                                        <td>
                                                            <a class="btn btn-default" href="form_alterar.php?id_unidade=<?php echo $dados['id_unidade']; ?>">
                                                                Alterar</a>
                                                            <a class="btn btn-default" href="excluir.php?id_unidade=<?php echo $dados['id_unidade']; ?>">
                                                                Excluir</a>
                                                        </td>       
                                                    </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


     <!-- /. WRAPPER  -->
    