<?php
require("../_inc/menu.inc.php");
?>
    <title>Relatórios</title>
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Relatório por Departamento</h2>                       
                    </div>
                </div>
                
                <!-- /. ROW  -->
                <div class="row col-md-5 col-xs-offset-1">
                    <form action="" method="post">
                        Departamento<br>
                        <?php include('../mod_departamento/select.inc.php');?>
                        <input type="submit" value="Gerar relatório">
                    </form>
                </div>
                <div class="row col-md-5 col-md-offset-1">
                    <a href="#" class="btn btn-primary">Gerar PDF</a>
                </div>
                <table class="table">
                    <thead>
                        <td>Produto</td>
                        <td>Unidade</td>
                        <td>Quantidade</td>
                    </thead>
                    <tbody>
                       <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $departamento=$_POST['id_departamento'];
                        if ($departamento == "") {
                            ?>
                                <td>Nao foi informado nenhum departamento</td>
                            <?php   
                            exit(0);
                        }else{
                        $sql=pg_query("SELECT s.*,
                        p.nome as produto,
                        d.nome as departamento,
                        u.nome as unidade,
                        s.quantidade as quantidade,
                        count(*) over() as total 
                        FROM saida s
                        inner join departamento d on s.id_departamento = d.id_departamento
                        inner join produto p on s.id_produto = p.id_produto
                        inner join unidade u on p.unidade = u.id_unidade
                        WHERE s.id_departamento = '$departamento';
                        ");


                         while($dados=pg_fetch_assoc($sql)):?>
                        <tr>
                            <td><?php echo $dados['produto']; ?></td>
                            <td><?php echo $dados['unidade']; ?></td>
                            <td><?php echo $dados['quantidade']; ?></td>
                        </tr>
                    <?php endwhile;
                    }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
        
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="../assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="../assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
    
   <script type="text/javascript">
    $(document).ready(function () {
        ('#resultado').hide();
        });
   </script>
</body>
</html>
