<?php
require("_inc/verifica_sessao.inc.php");
require("_inc/conexao.inc.php");

if(@$_GET['sair']){
  session_destroy();
  $_SESSION['logado'] = null;
  header("Location: mod_login/login.php");
  exit(0);
}
if($_SESSION['tipo']=='externo'){
   header("Location: mod_solicitacao/solicitacao.php"); 
}
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
                    where e.local='$local' order by data_ent");
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
                    inner join anexo a on e.id_anexo = a.id_anexo order by data_ent");
}
?>
<html>
<head>
      <meta charset="utf-8" />
      <link rel="shortcut icon" href="assets/img/find_user.png" type="image/x-icon">
      <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
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
                font-size: 16px;"><a href="?sair=true" class="btn btn-success square-btn-adjust">Sair</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
                    <div class="nome_sistema" style="text-align:center;color:white;font-size:20px;font-weight:bold;"><h1>SGA</h1>Sistema Gerenciador de Almoxarifado</div>
					</li>
									
                    <li>
                        <a  href="mod_entrada/listar_entrada.php"><i class="fa fa-edit fa-3x <?php echo $_SESSION['local']; ?>"></i> Entrada</a>
                    </li>
                    <li>
                        <a  href="mod_saida/listar_saida.php"><i class="fa fa-edit fa-3x <?php echo $_SESSION['local']; ?>"></i> Saída</a>
                    </li>
                     <li>
                        <a  href="mod_solicitacao/listar_solicitacoes.php"><i class="fa fa-edit fa-3x <?php echo $_SESSION['local']; ?>"></i> Solicitações de Materiais</a>
                    </li>
                    <li>
                        <a  href="mod_produto/listar_produto.php"><i class="fa fa-edit fa-3x <?php echo $_SESSION['local']; ?>"></i> Produto</a>
                    </li>
                     <li class="geral">
                        <a  href="mod_departamento/listar_departamento.php"><i class="fa fa-edit fa-3x "></i> Departamentos</a>
                    </li>
                    <li class="educacao">
                        <a  href="mod_escola/listar_escola.php"><i class="fa fa-edit fa-3x "></i> Escolas</a>
                    </li>
                    <li class="saude">
                        <a  href="mod_escola/listar_ubs.php"><i class="fa fa-edit fa-3x "></i>UBS</a>
                    </li>
                    <li>
                        <a  href="mod_unidade/listar_unidades.php"><i class="fa fa-edit fa-3x <?php echo $_SESSION['local']; ?>"></i> Unidades de Medida</a>
                    </li>
                    <li>
                        <a  href="mod_fornecedores/listar_fornecedores.php"><i class="fa fa-user fa-3x <?php echo $_SESSION['local']; ?>"></i> Fornecedores</a>
                    </li>
                    <li class="admin">
                        <a  href="mod_login/register.php"><i class="fa fa-user fa-3x"></i> Cadastro de Usuário</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-3x"></i> Gerar Relatórios<span class="fa arrow <?php echo $_SESSION['local']; ?>"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <li class="geral">
                                    <a href="mod_relatorios/relatorio_departamento.php">Por Departamento</a>
                                </li>
                                <li class="educacao">
                                    <a href="mod_relatorios/relatorio_departamento.php">Por Escola</a>
                                </li>
                                <li class="saude">
                                    <a href="mod_relatorios/relatorio_departamento.php">Por UBS</a>
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
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner" style="background-image: url(assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">             
            <!-- /. PAGE INNER  -->
            <div class="row">
                <div class="col-md-6 col-md-offset-1">
                    <div class="jumbotron"  style="margin-top:200px;" id="jumbo_apre">
                        <h2>SGA - Sistema Gerenciador de Almoxarifado</h2>
                        <p>O SGA tem por objetivo fazer controle de movimentações (entrada e saída de produtos),bem como gerar relatórios impressos em tela ou em arquivos.
                            Inclui também um moderno sistema de notificações de mensagens de vencimento de produtos bem como prazos de contrato.</p>
                    </div>
                </div>
                <div class="col-md-3 col-md-offset-1" style="background-color:white;height:840px;float:right;margin-right:20px;" id="vencimento">
                    <strong>Produtos que irão vencer</strong>
                    <?php 
                        $total = 0;
                        $cont = 1;
                        while (($dados = pg_fetch_assoc($query)) && ($cont<=8)):
                            $total = $dados['total'];
                            $cont++;

                            //pega a data atual
                            $data_atual=date('Y-m-d');
                            $data_val= $dados['data_validade'];
                            $one= new DateTime($data_atual);
                            $two= new DateTime($data_val);
                             
                            // Resgata diferença entre as datas
                            $dateInterval = $one->diff($two);
                            //mostra o resultado em dias
                            $intervalo=$dateInterval->days;
                            if($intervalo<7 && !$data_val==""){
                    ?>
                                <section style="background-color:#337AB7;color:white;height:100px;">
                                    <tr>
                                        <td><p>Produto: <?php echo $dados['produto'] ?></br>
                                                Validade: <?php echo $dados['data_validade'] ?></p>
                                        </td>
                                        <td>
                                            <span>-----------------------</span>
                                        </td>   
                                    </tr>
                                    

                                </section>
                    <?php   }
                            endwhile; ?>
                </div>
            </div>
            </div>
         <!-- /. PAGE WRAPPER  -->
       <div style="text-align:center;">©CommandosTech - Todos os direitos reservados.</div>
        </div>
     <!-- /. WRAPPER  -->
     <input id='local' type="hidden" value="<?php echo $_SESSION['local'];?>">
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
     <script type="text/javascript">
        var local=$("#local").val();
        
        if(local=="Almox. Geral"){
            $(".saude").hide();
            $(".educacao").hide();
            $(".admin").hide();
            $(".geral").show();
        }
        if(local=="Almox. Educacao"){
            $(".saude").hide();
            $(".geral").hide();
            $(".admin").hide();
            $(".educacao").show();
        }
        if(local=="Almox. Saude"){
            $(".educacao").hide();
            $(".geral").hide();
            $(".admin").hide();
            $(".saude").show();
        }
        if(local==""){
            $(".educacao").show();
            $(".geral").show();
            $(".saude").show();
        }
    </script>
   
</body>
</html>
