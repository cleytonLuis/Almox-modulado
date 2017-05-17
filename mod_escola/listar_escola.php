<?php
require("../_inc/menu.inc.php");
require("../_inc/conexao.inc.php");

$query = pg_query("SELECT * FROM escola order by nome");
?>
      <title>Escolas</title>
   
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Escolas<a href="form_cadastrar.php" class="btn btn-primary col-md-offset-6"> Cadastrar Nova Escola</a></h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <div class="panel panel-default col-md-12">
                                <div class="panel-heading">
                                    Selecione a Escola
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Escola</th>
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
                                                            <a class="btn btn-default" href="form_alterar.php?id_escola=<?php echo $dados['id_escola']; ?>">
                                                                Alterar</a>
                                                            <a class="btn btn-default" href="excluir.php?id_escola=<?php echo $dados['id_escola']; ?>">
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
   