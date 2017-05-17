<?php
require("../_inc/menu.inc.php");
require("../_inc/conexao.inc.php");
$local = $_SESSION['local'];
if (!$local == "") {
$query = pg_query("SELECT p.*,u.nome as unidade,
    count(*) over() as total 
    FROM produto p 
    inner join unidade u on p.unidade = u.id_unidade
    where p.local='$local'");
}else{
    $query = pg_query("SELECT p.*,u.nome as unidade,
    count(*) over() as total 
    FROM produto p 
    inner join unidade u on p.unidade = u.id_unidade");
}
?>

      <title>Produtos</title>
    
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Produtos<a href="form_cadastrar.php" class="btn btn-primary btn-primary col-md-offset-6"> Cadastrar Novo Produto</a></h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <div class="panel panel-default col-md-12">
                                <div class="panel-heading">
                                    Selecione o Produto
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Produto</th>
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
                                                        <td><?php echo $dados['unidade']; ?></td>
                                                        <td>
                                                            <a class="btn btn-default" href="form_alterar.php?id_produto=<?php echo $dados['id_produto']; ?>">
                                                                Alterar</a>
                                                            <a class="btn btn-default" href="excluir.php?id_produto=<?php echo $dados['id_produto']; ?>">
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
    