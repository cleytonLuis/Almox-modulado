<?php
require("../_inc/menu.inc.php");
require("../_inc/conexao.inc.php");
if(@$_GET['sair']){
  session_destroy();
  $_SESSION['logado'] = null;
  header("Location: ../mod_login/login.php");
  exit(0);
}

$query_departamento = pg_query("SELECT d.*,s.nome as secretaria,
    count(*) over() as total 
    FROM departamento d 
    inner join secretaria s on d.id_secretaria = s.id_secretaria");
$query_escola = pg_query("SELECT * FROM escola");
$query_saude = pg_query("SELECT * FROM ubs");
?>

      <title>Cadastro Saida</title>
    
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Cadastro da Saída de Produtos</h2>  
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                          <div class="panel-heading row">
                                <a href="#" id="departamento" class="btn btn-success col-xs-5 geral">Departamento</a>
                                <a href="#" id="escola" class="btn btn-success col-xs-5 col-xs-offset-1 educacao">Escola</a>
                                <a href="#" id="ubs" class="btn btn-success col-xs-5 col-xs-offset-1 saude">Unidade Basica de Saude</a>
                                <a href="#" id="produto" class="btn btn-success col-xs-5 col-xs-offset-1">Produto</a>
                            </div>
                                <div class="panel-body">
                                    <div class="row">
                                                <form role="form" method="post" id="form_produto">
                                                    <div class="panel panel-default col-md-7" style="background-color:#337AB7;height:500px;">
                                                      <div class="form-group col-md-3">
                                                        <h4>Local Solicitante:</h4><input type="text" id="val_item" readonly="readonly">
                                                        <input type="hidden" id="local" name="que_local" value="<?php echo $_SESSION['local'];?>">
                                                        <label class="control-label" for="produto"><h3>Produto</h3></label>
                                                            <?php include("../mod_entrada/select.inc.php"); ?>
                                                        </div>
                                                        <div class="form-group col-md-4 col-md-offset-2">
                                                            <label class="control-label" for="quantidade"><h3>Quantidade</h3></label>
                                                            <input type="text" class="form-control" id="quantidade" name="quantidade" required="required"></br>
                                                        </div>
                                                    </div>
                                                        <a href="#" class="btn btn-success col-md-1" onclick="tranferencia()" style="margin-top:150px;">Incluir >></a>
                                                        <div class="col-md-4" style="background-color:#337AB7;" id="tela_pre_entrada">
                                                            <table style="width:100px;" id="amostra_saida">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Produto</th>
                                                                        <th>Qtd.</th>
                                                                        <th>Ação</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <a href="#" class="btn btn-success" onclick="finaliza_saida()" style="float:right;margin-right:20px;margin-top:20px;" id="botao_finaliza">Finalizar Saída</a>
                                                    </form>
                                                      <form role="form" method="post" id="form_departamento" class="geral" >
                                                        <div class="panel panel-default col-md-12">
                                                        <div class="panel-heading">
                                                          <h4>Selecione o Departamento</h4>
                                                        </div>
                                                            <div class="panel-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover" id="table-departamento">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sel.</th>
                                                                                <th>Departamento/Secretaria</th>
                                                                            </tr>
                                                                        </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                            while ($dados_departamento = pg_fetch_assoc($query_departamento)):
                                                                        ?>
                                                                        <tr class="odd gradeX">
                                                                            <td><input type="checkbox" value="<?php echo $dados_departamento['id_departamento'];?>"
                                                                             name="<?php echo $_SESSION['local'];?>" nome="<?php echo $dados_departamento['nome']?>"></td>
                                                                            <td><?php echo $dados_departamento['nome']."/".$dados_departamento['secretaria']; ?></td>
                                                                        </tr>
                                                                        <?php endwhile; ?>
                                                                    </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="#" style="float:right;" class="btn btn-primary" onclick="aparece_produto()">Próximo >></a>
                                                      </form>
                                                      <form role="form" method="post" id="form_escola" class="educacao" name="<?php echo $_SESSION['local'];?>">
                                                        <div class="panel panel-default col-md-12">
                                                        <div class="panel-heading">
                                                          <h4>Selecione a Escola</h4>
                                                        </div>
                                                            <div class="panel-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover" id="table-escola">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sel.</th>
                                                                                <th>Escola</th>
                                                                            </tr>
                                                                        </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                            while ($dados_escola = pg_fetch_assoc($query_escola)):
                                                                        ?>
                                                                        <tr class="odd gradeX">
                                                                            <td><input type="checkbox" value="<?php echo $dados_escola['id_escola'];?>"
                                                                             name="<?php echo $_SESSION['local'];?>" nome="<?php echo $dados_escola['nome']?>"></td>
                                                                            <td><?php echo $dados_escola['nome'];?></td>
                                                                        </tr>
                                                                        <?php endwhile; ?>
                                                                    </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="#" style="float:right;" class="btn btn-primary" onclick="aparece_produto()">Próximo >></a>
                                                      </form>
                                                      <form role="form" method="post" id="form_ubs" class="saude" name="<?php echo $_SESSION['local'];?>">
                                                        <div class="panel panel-default col-md-12">
                                                        <div class="panel-heading">
                                                          <h4>Selecione a UBS</h4>
                                                        </div>
                                                            <div class="panel-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover" id="table-ubs">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sel.</th>
                                                                                <th>Unidade Basica de Saude</th>
                                                                            </tr>
                                                                        </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                            while ($dados_ubs = pg_fetch_assoc($query_saude)):
                                                                        ?>
                                                                        <tr class="odd gradeX">
                                                                            <td>
                                                                              <input type="checkbox" value="<?php echo $dados_ubs['id_ubs'];?>"
                                                                               name="<?php echo $_SESSION['local'];?>" nome="<?php echo $dados_ubs['nome']?>"></td>
                                                                            <td><?php echo $dados_ubs['nome'];?></td>
                                                                        </tr>
                                                                        <?php endwhile; ?>
                                                                    </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="#" style="float:right;" class="btn btn-primary" onclick="aparece_produto()">Próximo >></a>
                                                      </form>
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
     <!-- DATA TABLE SCRIPTS -->
    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#table-ubs').dataTable();
                $('#table-departamento').dataTable();
                $('#table-escola').dataTable();
            });
    </script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
    <script type="text/javascript">
        var local=$("#local").val();
        operacao = new Array();
        fim_saida = new Array();
        teste = new Array();
        var id_tr = 0;
        

         $('#tela_pre_entrada').hide();
         $('#botao_finaliza').hide();

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
        if(local==""){
            $(".educacao").show();
            $(".geral").show();
            $(".saude").show();
        }


        $("#departamento").click(function(event){
        event.preventDefault();
        $("#form_departamento").show(1000);
        $("#form_departamento").siblings().hide();
        });

        $("#ubs").click(function(event){
        event.preventDefault();
        $("#form_ubs").show(1000);
        $("#form_ubs").siblings().hide();
        });

        $("#escola").click(function(event){
        $("#form_escola").show(1000);
        $("#form_escola").siblings().hide();
        });

        $("#ubs").click(function(event){
        $("#form_ubs").show(1000);
        });

        $("#produto").click(function(event){
        $("#form_produto").show(1000);
        $("#form_produto").siblings().hide();
        });

        function aparece_produto(){
          var pacote = document.getElementsByName(local);
                for (i = 0; i < pacote.length; i++){
                    if ( pacote[i].checked ) {
                        var id_item = $(pacote[i]).val();
                        var nome_item = $(pacote[i]).attr('nome');
                    }
                }
          operacao[0] = id_item;
          operacao[1] = nome_item;
          $("#val_item").val(operacao[1]);
          $("#form_produto").show(1000);
          $("#form_produto").siblings().hide();
        };

        function remove_line(essa){
            var id_remover = $(essa).parent().parent().attr('id');
            $(essa).parent().parent().remove();
            fim_saida.pop(id_remover);
            
        }

        function tranferencia() {
            var linha = 0;
            var produto = $('#id_produto').val();
            id_produto = produto.split('-');
            var quantidade = $('#quantidade').val();
            var local = $('#local').val();
            var erro="";
            if(!produto == "" && !quantidade == ""){
            $.ajax({
                      url:  "verifica_quantidade.php",
                      async: false,
                      data: "produto="+id_produto[0]+"&quantidade="+quantidade,
                      success: function(retorno){
                            if(retorno!="ok"){
                                alert(retorno);
                                erro=1;
                            }
                      },
                      error: function(retorno){
                        alert(retorno);
                      },
                      complete: function(){
                        
                      }
            });
            if(erro!=1){
                $('#tela_pre_entrada').show();
                $('#botao_finaliza').show();
                operacao[2] = produto; 
                operacao[3] = quantidade;
                operacao[4] = local;
                $('#amostra_saida').append('<tr id="'+id_tr+'"><td><input size="12" readonly value="'+operacao[2]+'"></td>"'+'"<td><input size="3" readonly value="'+operacao[3]+'"></td>"'+'"<td><button type="button" class="btn btn-danger glyphicon glyphicon-remove" onclick="remove_line(this)"></button></td></tr>');
                teste[id_tr] = new Array(operacao[0],id_produto[0],operacao[3],operacao[4]);
                fim_saida[id_tr] = teste[id_tr];
                id_tr = id_tr + 1;
                }
            }else{
                    alert("Impossivel cadastrar por falta de informações!!");
            }    
        }

        function finaliza_saida(){
            for ( i = 0; i < fim_saida.length; i++) {
              
                    $.ajax({
                      url:  "insere_banco.php",
                      async: false,
                      data: "teste="+fim_saida[i],
                      success: function(retorno){
                           if(retorno=="erro"){
                            alert('Quantidade informada é maior que a quantidade em estoque!!')
                           } 
                           //location.href="cadastro_saida.php"; 
                      },
                      error: function(retorno){
                        alert ("Falha no cadastro");
                      },
                      complete: function(){
                        
                      }
                    });                                     
             }
             alert ("Cadastro Efetuado com sucesso!!!");
             location.href="listar_saida.php";
        }
    </script>
   
</body>
</html>
