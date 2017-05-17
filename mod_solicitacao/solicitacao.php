<?php
require("../_inc/verifica_sessao.inc.php");
if(@$_GET['sair']){
  session_destroy();
  $_SESSION['logado'] = null;
  header("Location: ../mod_login/login.php");
  exit(0);
}
?>

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
<title>Solicitação de materiais</title>
</head>
<body style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">

    <div style="color: white;
                padding: 15px 50px 5px 50px;
                float: right;
                font-size: 16px;"><a href="?sair=true" class="btn btn-success square-btn-adjust">Sair</a> </div>
    <div id="page-inner">
      <div class="nome_sistema container" style="text-align:center;color:black;font-size:20px;font-weight:bold;">
                        <img src="../assets/img/find_user.png" class="user-image img-responsive container" style="margin-left: 43%" />
                        <h1>SGA</h1>Sistema Gerenciador de Almoxarifado
                    </div>
        <div class="row">
        	<div class="col-xs-11 col-xs-offset-1">
            	<h2 style="background-color:#ffffff;width:400px;padding-left:25px;">Solicitação de materiais</h2>                       
            </div>
        </div>
                <!-- /. ROW  -->
                
        <div class="row col-md-11 fluid col-md-offset-1">
            <div class="col-md-12 fluid">
                        <!-- Form Elements -->
                <div class="panel panel-default fluid">
					<div class="panel-body fluid ">
					<div class="row fluid">
					            <form role="form" method="post" id="form_produto" class="row ">
					                <div class="panel panel-default col-md-6 fluid" style="background-color:#337AB7;height:500px;">
					                    <div class="form-group col-md-5 container">
					                        <label class="control-label " for="produto"><h3>Produto</h3></label>
					                        <?php include("select.inc.php"); ?>
					                        
					                    </div>
					                    <div class="form-group col-md-2 col-md-offset-3" style="margin-left:120px;">
					                        <label class="control-label" for="quantidade"><h3>Quantidade</h3></label>
					                        <input type="text" class="form-control col-md-offset-6" id="quantidade" name="quantidade" required="required" style="margin-left:50px;"></br>
					                    </div>
					                </div>
					                    <a href="#" class="btn btn-success col-md-1" title="Incluír produto no pedido" onclick="tranferencia()" style="margin-top:150px;">Incluir >></a>
					                    <div class="panel panel-default col-md-5" style="background-color:#337AB7;" id="tela_pre_entrada">
					                        <table class="form-group col-md-4 container " style="width:140px;" id="amostra_entrada">
					                            <thead class="fluid">
					                                <tr >
					                                    <th>Produto</th>
					                                    <th >Qtd.</th>
					                                    <th >Acao</th>
					                                </tr>
					                            </thead>
					                            <tbody class="fluid">
					                                
					                            </tbody>
					                        </table>
					                    </div>
					                    <a href="#" class="btn btn-success " title="Finalizar pedido" onclick="finaliza_entrada()" id="botao_finaliza" style="float:right;margin-right:20px;margin-top:20px;">Finalizar</a>
					                </form>                                                    
					            </div>
					        </div>
					    </div>
					</div>
				</div>
			</div>

  <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../mod_entrada/jquery-3.1.0.min.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
     <script src="../mod_fornecedores/jquery.maskedinput.js"></script>
    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#table-produto').dataTable();
                $('#table-fornecedor').dataTable();
            });
    </script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
    <script type="text/javascript">
    operacao = new Array();
    fim_entrada = new Array();
    teste = new Array();
    var id_tr = 0; 
    $('#tela_pre_entrada').hide();
    $('#botao_finaliza').hide();

    	function remove_line(essa){
            var id_remover = $(essa).parent().parent().attr('id');
            $(essa).parent().parent().remove();
            fim_entrada.splice(id_remover, 1);
        }

        function tranferencia() {
            var linha = 0;
            var produto = $('#id_produto').val();
            var quantidade = $('#quantidade').val();
            if (!produto == "" && !quantidade =="") {
	            $('#tela_pre_entrada').show();
	            $('#botao_finaliza').show();
	            operacao[0] = produto; 
	            operacao[1] = quantidade;
	            id_produto = produto.split('-');
	            $('#amostra_entrada').append('<tr class="fluid" id="'+id_tr+'"><td><input size="25" readonly value="'+operacao[0]+'"></td>"'+'"<td><input size="2" readonly value="'+operacao[1]+'"></td>"'+'"<td><button type="button" class="btn btn-danger glyphicon glyphicon-remove"  title="Excluir" onclick="remove_line(this)"></button></td></tr>');
	            teste[id_tr] = new Array(operacao[0],operacao[1]);
	            fim_entrada[id_tr] = teste[id_tr];
	            id_tr = id_tr + 1;
	        }else{
	            alert("Impossivel cadastrar por falta de informações!!");
	        }
        }
        function finaliza_entrada(){
          
            for ( i = 0; i < fim_entrada.length; i++) {
               
                $.ajax({
                  url:  "insere_banco.php",
                  async: false,
                  data: "teste="+fim_entrada[i],
                  success: function(retorno){
                    
                  },
                  error: function(retorno){
                    alert ("Falha no cadastro");
                  },
                  complete: function(){
                                       
                  }
                });
            }
            $.ajax({
                  url:  "insere_banco.php",
                  async: false,
                  data: "teste=fim",
                  success: function(retorno){
                    alert('Pedido efetuado com sucesso!');
                    location.href='solicitacao.php';
                  },
                  error: function(retorno){
                    alert ("Falha no cadastro");
                  },
                  complete: function(){
                                       
                  }
                });    
        };
    </script>  
</body>
