<?php
require("../_inc/verifica_sessao.inc.php");
if(@$_GET['sair']){
  session_destroy();
  $_SESSION['logado'] = null;
  header("Location: ../mod_login/login.php");
  exit(0);
}
  // Inicia o buffer de saída
  ob_start();
  // requerendo a conexão com o banco
  require("../_inc/conexao.inc.php");
  // Pegar do formulário o nome digitado pelo cliente
  //$nome = $_POST['nome'];
  $teste = 1;
  $sql =  pg_query("SELECT s.*,
                    e.data as entrada,
                    sai.data as saida,
                    p.nome as produto,
                    d.nome as departamento,
                    f.nome as fornecedor,
                    u.nome as unidade,
                    count(*) over() as total 
                    FROM situacao s
                    inner join entrada e on s.id_entrada = e.id_entrada
                    inner join saida sai on s.id_saida = sai.id_saida
                    inner join departamento d on e.id_departamento = d.id_departamento
                    inner join fornecedor f on e.id_fornecedor = f.id_fornecedor
                    inner join produto p on e.id_produto = p.id_produto
                    inner join unidade u on p.unidade = u.id_unidade
                    WHERE e.id_departamento = '$teste';
                    ");

?>
<html>
<head>
      <meta charset="utf-8" />
      <link rel="shortcut icon" href="assets/img/find_user.png" type="image/x-icon">
      <title>Relatorios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div 
                style="color: white;
                    padding: 15px 50px 5px 50px;
                    float: right;
                    font-size: 22px;"class="navbar-brand">Bem vindo, <?php echo $_SESSION['login']; ?><br /></div> 
            </div>
                <div
                 style="color: white;
                padding: 15px 50px 5px 50px;
                float: right;
                font-size: 16px;"><a href="?sair=true" class="btn btn-success square-btn-adjust">Sair</a></div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="../assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a  href="../index.php"><i class="fa fa-desktop fa-3x"></i> Apresentação</a>
                    </li>
                    <li>
                        <a  href="../mod_entrada/listar_entrada.php"><i class="fa fa-edit fa-3x"></i> Entrada</a>
                    </li>
                    <li>
                        <a  href="../mod_saida/listar_saida.php"><i class="fa fa-edit fa-3x"></i> Saída</a>
                    </li>
                    <li>
                        <a  href="../mod_produto/listar_produtos.php"><i class="fa fa-edit fa-3x"></i> Produtos</a>
                    </li>
                     <li>
                        <a  href="../mod_departamento/listar_departamento.php"><i class="fa fa-edit fa-3x"></i> Departamentos</a>
                    </li>
                    <li>
                        <a  href="../mod_fornecedores/listar_fornecedores.php"><i class="fa fa-user fa-3x"></i> Fornecedores</a>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-3x"></i> Gerar Relatórios<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="active-menu" href="#">Visualizar na tela</a>
                            </li>
                            <li>
                                <a href="#">Imprimir<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#"> PDF</a>
                                    </li>
                                    <li>
                                        <a href="#"> DOC</a>
                                    </li>
                                </ul>
                               
                            </li>
                        </ul>
                      </li>
                </ul>              
            </div>
        </nav>  
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Relatórios</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <label class="control-label" for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" required="required" name="nome">
                            </br><input type="submit" class="btn btn-primary" value="Visualizar">
                        </div>
                    </form>
                </div>
                <div class="col-md-12" >
                        <div class="panel-body">
                            <div class="panel panel-default col-md-12">
                                <div class="panel-heading">
                                    Relatorio
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data Entrada</th>
                                                    <th>Data Saida</th>
                                                    <th>Departamento</th>
                                                    <th>Produto</th>
                                                    <th>Unidade</th>
                                                    <th>Quantidade</th>
                                                    <th>Fornecedor</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $total = 0;
                                                        while ($dados = pg_fetch_assoc($sql)):
                                                            $total = $dados['total'];
                                                    ?>
                                                    <tr class="odd gradeX text-center">
                                                        <td><?php echo $dados['data']; ?></td>
                                                        <td><?php echo $dados['data']; ?></td>
                                                        <td><?php echo $dados['departamento']; ?></td>
                                                        <td><?php echo $dados['produto'];?></td>
                                                        <td><?php echo $dados['unidade'];?></td>
                                                        <td><?php echo $dados['quantidade']; ?></td> 
                                                        <td><?php echo $dados['fornecedor']; ?></td>      
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
