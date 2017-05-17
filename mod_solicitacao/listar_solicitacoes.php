<?php
require('../_inc/verifica_sessao.inc.php');
require('../_inc/menu.inc.php');
require('../_inc/conexao.inc.php');
if(@$_GET['sair']){
  session_destroy();
  $_SESSION['logado'] = null;
  header("Location: mod_login/form.php");
  exit(0);
}
$local=$_SESSION['local'];
$query=pg_query("SELECT * from solicitacao s
				inner join usuario u on s.id_solicitante=u.id_usuario where u.local='$local' and status is null");
?>
<div id="page-wrapper" style="background-image: url(assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">             
            <!-- /. PAGE INNER  -->
        
       
                    <div class="row">
                        <div class="col-md-12">
                             <div class="panel panel-default col-md-12">
                                <div class="panel-heading">
                                    <h2>Solicitações em aberto</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Solicitante</th>
                                                    <th>Pedido</th>
                                                    <th>Data/Hora</th>
                                                 </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        while ($dados = pg_fetch_assoc($query)):
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $dados['nome']; echo "<br>".$dados['local']; ?></td>
                                                        <td width="450px"><?php echo $dados['pedido']; ?></td>
                                                        <td><?php echo $dados['data']; ?></td>
                                                        <td><button class="finalizar" solicitacao="<?php echo $dados['id_solicitacao'];?>">Finalizar</button>
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
        <script type="text/javascript">
        	
        	$('.finalizar').click(function(){
        		var id_solicitacao=$(this).attr('solicitacao');
        		$.ajax({
                  url:  "finaliza_solicitacao.php",
                  async: false,
                  data: "id_solicitacao="+id_solicitacao,
                  success: function(retorno){
                   location.href='listar_solicitacoes.php';
                  },
                  error: function(retorno){
                    alert ("Falha no cadastro");
                  },
                  complete: function(){
                                       
                  }
                });
        	});
        </script>