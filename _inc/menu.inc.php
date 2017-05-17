<?php
require("verifica_sessao.inc.php");
if(@$_GET['sair']){
  session_destroy();
  $_SESSION['logado'] = null;
  header("Location: ../mod_login/login.php");
  exit(0);
}
?>
<html>
<head>
      <meta charset="utf-8" />
      <link rel="shortcut icon" href="../assets/img/find_user.png" type="image/x-icon">
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

    <script src="../mod_fornecedores/jquery-3.1.0.min.js"></script>
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
                <div style="color: white;
                    padding: 15px 50px 5px 50px;
                    float: right;
                    font-size: 22px;"class="navbar-brand">Bem vindo, <?php echo $_SESSION['login']; ?><br /></div> 
            </div>
                <div style="color: white;
                padding: 15px 50px 5px 50px;
                float: right;
                font-size: 16px;"><a href="?sair=true" class="btn btn-success square-btn-adjust">Sair</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <a href="../index.php"><img src="../assets/img/find_user.png" class="user-image img-responsive"/></a>
                    <div class="nome_sistema" style="text-align:center;color:white;font-size:20px;font-weight:bold;">
                        <h1>SGA</h1>Sistema Gerenciador de Almoxarifado</div>
                <ul class="nav" id="main-menu">
                    <li>
                        <a  href="../mod_entrada/listar_entrada.php"><i class="fa fa-edit fa-3x " ></i> Entrada</a>
                    </li>
                    <li>
                        <a  href="../mod_saida/listar_saida.php"><i class="fa fa-edit fa-3x "></i> Saída</a>
                    </li>
                    <li>
                        <a  href="../mod_solicitacao/listar_solicitacoes.php"><i class="fa fa-edit fa-3x <?php echo $_SESSION['local']; ?>"></i> Solicitações de Materiais</a>
                    </li>
                    <li>
                        <a  href="../mod_produto/listar_produto.php"><i class="fa fa-edit fa-3x "></i> Produto</a>
                    </li>
                     <li class="geral">
                        <a  href="../mod_departamento/listar_departamento.php"><i class="fa fa-edit fa-3x "></i> Departamentos</a>
                    </li>
                    <li class="educacao">
                        <a  href="../mod_escola/listar_escola.php"><i class="fa fa-edit fa-3x "></i> Escolas</a>
                    </li>
                    <li class="saude">
                        <a  href="../mod_ubs/listar_ubs.php"><i class="fa fa-edit fa-3x "></i>UBS</a>
                    </li>
                    <li>
                        <a  href="../mod_unidade/listar_unidades.php"><i class="fa fa-edit fa-3x "></i> Unidades de Medida</a>
                    </li>
                    <li>
                        <a  href="../mod_fornecedores/listar_fornecedores.php"><i class="fa fa-user fa-3x "></i> Fornecedores</a>
                    </li>
					<li class="admin">
                        <a  href="../mod_login/register.php"><i class="fa fa-user fa-3x"></i> Cadastro de Usuário</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-3x "></i> Gerar Relatórios<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <li class="geral">
                                    <a href="../mod_relatorios/relatorio_departamento.php">Por Departamento</a>
                                </li>
                                <li class="educacao">
                                    <a href="../mod_relatorios/relatorio_departamento.php">Por Escola</a>
                                </li>
                                <li class="saude">
                                    <a href="../mod_relatorios/relatorio_departamento.php">Por UBS</a>
                                </li>
                                <li>
                                    <a href="../mod_relatorios/rel_produtos_estoque.php">Produtos em estoque</a>
                                </li>
                            </li>
                        </ul>
                    </li>
                </ul>              
            </div>
        </nav>
        <input id='local' type="hidden" value="<?php echo $_SESSION['local'];?>">
  
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
    <!-- DATA TABLE SCRIPTS -->
    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
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
            $(".saude").hide();
            $(".educacao").hide();
            $(".geral").show();
        }
        if(local=="Almox. Educacao"){
            $(".saude").hide();
            $(".geral").hide();
            $(".educacao").show();
        }
        if(local=="Almox. Saude"){
            $(".educacao").hide();
            $(".geral").hide();
            $(".saude").show();
        }
    </script>
   
</body>