<?php
require("../_inc/menu.inc.php");
require("../_inc/conexao.inc.php");
$local = $_SESSION['local'];
if (!$local == "") {
    $query = pg_query("SELECT e.*,
                    p.nome as produto,
                    f.nome as fornecedor,
                    u.nome as unidade,
                    a.nome as nome_anexo,
                    a.id_anexo as id_anexo,
                    count(*) over() as total 
                    FROM entrada e
                    inner join produto p on e.id_produto = p.id_produto
                    inner join fornecedor f on e.id_fornecedor = f.id_fornecedor
                    inner join unidade u on p.unidade = u.id_unidade
                    inner join anexo a on e.id_anexo = a.id_anexo
                    where e.local='$local' order by id_entrada desc");
}else{
    $query = pg_query("SELECT e.*,
                    p.nome as produto,
                    f.nome as fornecedor,
                    u.nome as unidade,
                    a.nome as nome_anexo,
                    a.id_anexo as id_anexo,
                    count(*) over() as total 
                    FROM entrada e
                    inner join produto p on e.id_produto = p.id_produto
                    inner join fornecedor f on e.id_fornecedor = f.id_fornecedor
                    inner join unidade u on p.unidade = u.id_unidade
                    inner join anexo a on e.id_anexo = a.id_anexo order by id_entrada desc");
}
?>
      <title>Entradas</title>
           
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Entradas Recentes <a href="cadastro_entrada.php" class="btn btn-primary col-md-offset-6"> Cadastrar nova entrada</a></h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <div class="panel panel-default col-md-12">
                                <div class="panel-heading">
                                    Selecione a Entrada
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Produto</th>
                                                    <th>Unidade</th>
                                                    <th>Quantidade</th>
                                                    <th>Fornecedor</th>
                                                    <th>Arquivo Nota</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $total = 0;
                                                        while ($dados = pg_fetch_assoc($query)):
                                                            $total = $dados['total'];
                                                            $data2 = explode("-", $dados['data_ent']);
                                                            $data3 = explode(" ", $data2[2]);
                                                            $hora = explode(":", $data3[1]);
                                                            $data_fim = "Dia: ".$data3[0]."/".$data2[1]."/".$data2[0];
                                                            $hora_fim = "Hora:".$hora[0].":".$hora[1];
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $data_fim."</br>".$hora_fim; ?></td>
                                                        <td class="text-center"><?php echo $dados['produto'];?></td>
                                                        <td class="text-center"><?php echo $dados['unidade'];?></td>
                                                        <td class="text-center"><?php echo $dados['quantidade']; ?></td>
                                                        <td class="text-center"><?php echo $dados['fornecedor']; ?></td>
                                                        <td class="text-center">
                                                            <a href="anexos/<?php echo $dados['id_anexo']; ?>" download='<?php echo $dados['nome_anexo']; ?>'>Download</a>
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
    