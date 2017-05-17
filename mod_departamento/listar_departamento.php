<?php
require("../_inc/menu.inc.php");
require("../_inc/conexao.inc.php");

$query = pg_query("SELECT d.*,s.nome as secretaria,
    count(*) over() as total 
    FROM departamento d 
    inner join secretaria s on d.id_secretaria = s.id_secretaria");
?>
      <title>Departamentos</title>
   
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Departamentos<a href="form_cadastrar.php" class="btn btn-primary col-md-offset-6"> Cadastrar Novo Departamento</a></h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <div class="panel panel-default col-md-12">
                                <div class="panel-heading">
                                    Selecione o Departamento
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Departamento</th>
                                                    <th>Secretaria</th>
                                                    <th>Opções</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $total = 0;
                                                        while ($dados = pg_fetch_assoc($query)):
                                                            $total = $dados['total'];
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $dados['nome']; ?></td>
                                                        <td><?php echo $dados['secretaria']; ?></td>
                                                        <td>
                                                            <a class="btn btn-default" href="form_alterar.php?id_departamento=<?php echo $dados['id_departamento']; ?>">
                                                                Alterar</a>
                                                            <a class="btn btn-default" href="excluir.php?id_departamento=<?php echo $dados['id_departamento']; ?>">
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
   