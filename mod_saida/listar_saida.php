<?php
require("../_inc/conexao.inc.php");
require("../_inc/menu.inc.php");
$local = $_SESSION['local'];
if (!$local == "") {
    if ($local == "Almox. Educacao") {
        $query = pg_query("SELECT s.*,
                    p.nome as produto,
                    es.nome as escola,
                    count(*) over() as total 
                    FROM saida s
                    inner join produto p on s.id_produto = p.id_produto
                    inner join escola es on s.id_escola = es.id_escola"); 
    }
    if ($local == "Almox. Saude") {
        $query = pg_query("SELECT s.*,
                    p.nome as produto,
                    ub.nome as ubs,
                    count(*) over() as total 
                    FROM saida s
                    inner join produto p on s.id_produto = p.id_produto
                    inner join ubs ub on s.id_ubs = ub.id_ubs");        
    }
    if ($local == "Almox. Geral") {
        $query = pg_query("SELECT s.*,
                    p.nome as produto,
                    d.nome as departamento,
                    count(*) over() as total 
                    FROM saida s
                    inner join produto p on s.id_produto = p.id_produto
                    inner join departamento d on s.id_departamento = d.id_departamento");
    }
}else{
    $query = "SELECT * FROM saida";
}
?>
        <title>Saídas</title>
        <input type="hidden" id="local" name="que_local" value="<?php echo $_SESSION['local'];?>">
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Saídas Recentes <a href="cadastro_saida.php" class="btn btn-primary col-md-offset-6"> Cadastrar Nova Saída</a></h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <div class="panel panel-default col-md-12">
                                <div class="panel-heading">
                                    Selecione a Saida
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Produto</th>
                                                    <th class="geral">Departamento</th>
                                                    <th class="saude">Unidade Basica de Saude</th>
                                                    <th class="educacao">Escola</th>
                                                    <th>Quantidade</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        
                                                        while ($dados = pg_fetch_assoc($query)):
                                                            
                                                            $data2 = explode("-", $dados['data_sai']);
                                                            $data3 = explode(" ", $data2[2]);
                                                            $hora = explode(":", $data3[1]);
                                                            $data_fim = "Dia: ".$data3[0]."/".$data2[1]."/".$data2[0];
                                                            $hora_fim = "Hora:".$hora[0].":".$hora[1];
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $data_fim."</br>".$hora_fim; ?></td>
                                                        <td class="text-center"><?php echo $dados['produto']; ?></td>
                                                        <td class="text-center geral"><?php echo $dados['departamento']; ?></td>
                                                        <td class="text-center educacao"><?php echo $dados['escola']; ?></td>
                                                        <td class="text-center saude"><?php echo $dados['ubs']; ?></td>
                                                        <td class="text-center"><?php echo $dados['quantidade']; ?></td>       
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
    <!-- /. WRAPPER  -->
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
    <script type="text/javascript">
        var local=$("#local").val();

        if(local=="Almox. Geral"){
            $(".saude").remove();
            $(".educacao").remove();
            $(".geral").show();
            $("#form_produto").hide();
        }
        if(local=="Almox. Educacao"){
            $(".saude").remove();
            $(".geral").remove();
            $(".educacao").show();
            $("#form_produto").hide();   
        }
        if(local=="Almox. Saude"){
            $(".educacao").remove();
            $(".geral").remove();
            $(".saude").show();
            $("#form_produto").hide();
        }
    </script>
    
   
