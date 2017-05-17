<?php
require("../_inc/menu.inc.php");
require("../_inc/conexao.inc.php");
$local = $_SESSION['local'];
if (!$local == "") {
$query = pg_query("SELECT * FROM fornecedor where local='$local'");
}else{
    $query = pg_query("SELECT * FROM fornecedor");
    }
?>
      <title>Fornecedores</title>
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Fornecedores<a href="form_cadastrar.php" class="btn btn-primary col-md-offset-6"> Cadastrar Novo Fornecedor</a></h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <div class="panel panel-default col-md-12">
                                <div class="panel-heading">
                                    Selecione o Fornecedor
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data Inicio</th>
                                                    <th>Data Fim</th>
                                                    <th>Nome</th>
                                                    <th>Contato</th>
                                                    <th>Email</th>
                                                    <th>Cnpj</th>
                                                    <th>Opções</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        while ($dados = pg_fetch_assoc($query)):
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $dados['data_ini']; ?></td>
                                                        <td><?php echo $dados['data_fim']; ?></td>
                                                        <td><?php echo $dados['nome']; ?></td>
                                                        <td><?php echo $dados['contato']; ?></td>
                                                        <td><?php echo $dados['email']; ?></td>
                                                        <td><?php echo $dados['cnpj']; ?></td>
                                                        <td>
                                                            <a class="btn btn-default" href="form_alterar.php?id_fornecedor=<?php echo $dados['id_fornecedor']; ?>">
                                                                Alterar</a>
                                                            <a class="btn btn-default" href="excluir.php?id_fornecedor=<?php echo $dados['id_fornecedor']; ?>">
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
   
