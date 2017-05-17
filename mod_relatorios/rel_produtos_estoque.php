<?php
require("../_inc/menu.inc.php");
require("../_inc/conexao.inc.php");
$local = $_SESSION['local'];
?>
    <title>Relatórios</title>
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Relatório de produtos em estoque</h2>                       
                    </div>
                </div>
                
                <!-- /. ROW  -->
                <table class="table">
                    <thead>
                        <td>Produto</td>
                        <td>Unidade</td>
                        <td>Quantidade</td>
                    </thead>
                    <tbody>
                       <?php
                       $sql=pg_query("SELECT s.*,u.nome as unidade,p.nome as nome from situacao s 
                        inner join produto p on s.id_produto=p.id_produto
                        inner join unidade u on p.unidade=u.id_unidade");
                         while($dados=pg_fetch_assoc($sql)):?>
                        <tr>
                            <td><?php echo $dados['nome']; ?></td>
                            <td><?php echo $dados['unidade']; ?></td>
                            <td><?php echo $dados['quantidade']; ?></td>
                        </tr>
                    <?php endwhile; ?>
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
