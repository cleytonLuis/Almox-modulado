
<?php
require("../_inc/menu.inc.php");
require("../_inc/conexao.inc.php");
$local = $_SESSION['local'];
$query_produto =  pg_query("SELECT p.*,u.nome as unidade,
    count(*) over() as total 
    FROM produto p 
    inner join unidade u on p.unidade = u.id_unidade  where u.local='$local'");

$query_fornecedor = pg_query("SELECT * FROM fornecedor where local='$local'");
$query_entrada = pg_query("SELECT e.*,
                    p.nome as produto,
                    f.nome as fornecedor,
                    u.nome as unidade,
                    count(*) over() as total 
                    FROM entrada e
                    inner join produto p on e.id_produto = p.id_produto
                    inner join fornecedor f on e.id_fornecedor = f.id_fornecedor
                    inner join unidade u on p.unidade = u.id_unidade order by data_ent");

?>

      <title>Cadastro Entrada</title>
    
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                     <h2>Cadastro da entrada de produtos</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading row">
                                <a href="#" id="fornecedor" class="btn btn-success col-xs-3">Fornecedor</a>
                                <a href="#" id="nota_fiscal" class="btn btn-success col-xs-3 col-xs-offset-1">Nota Fiscal</a>
                                <a href="#" id="produto" class="btn btn-success col-xs-3 col-xs-offset-1">Produto</a>
                            </div>
                                <div class="panel-body">
                                    <div class="row">
                                                <form role="form" method="post" id="form_produto" class="row">
                                                    <div class="panel panel-default col-md-7" style="background-color:#337AB7;height:500px;">
                                                        <div class="form-group col-md-4">
                                                            <h5>Fornecedor:</h5><input class="inp_forne_nome" readonly>
                                                            <h5>Nota:</h5><input id="inp_nf_numero" readonly name="numero_nota">
                                                            <input type="hidden" id="data_nota" name="data_nota" readonly>
                                                            <input type="hidden" id="inp_forne_id" name="id_fornecedor">
                                                            <input type="hidden" id="inp_local" name="local" value="<?php echo $_SESSION['local'];?>">                                                            
                                                            <input type="hidden" id="arquivo_nota"  name="arquivo_nota"></br>
                                                            <label class="control-label" for="produto"><h3>Produto</h3></label>
                                                            <?php include("select.inc.php"); ?>
                                                            <a href="#janela1" rel="modal"><button class="btn btn-success" rel="modal">(+)</button>
                                                            </a>
                                                        </div>
                                                        <div class="form-group col-md-5 col-md-offset-2">
                                                            <label class="control-label" for="data_validade"><h3>Data de Validade</h3></label>
                                                            <input type="date" class="form-control" id="data_validade" name="data_validade">
                                                            <label class="control-label" for="valor_unit"><h3>Valor Unitario(R$)</h3></label>
                                                            <input type="text" class="form-control" id="valor_unit" name="valor_unit" required="required" onKeyUp="moeda(this);"></br>
                                                            <label class="control-label" for="quantidade"><h3>Quantidade</h3></label>
                                                            <input type="text" class="form-control" id="quantidade" name="quantidade" required="required"></br>
                                                        </div>
                                                    </div>
                                                        <a href="#" class="btn btn-success col-md-1" onclick="tranferencia()" style="margin-top:150px;">Incluir >></a>
                                                        <div class="col-md-4" style="background-color:#337AB7;" id="tela_pre_entrada">
                                                            <table style="width:150px;" id="amostra_entrada">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Produto</th>
                                                                        <th>Validade</th>
                                                                        <th>Valor</th>
                                                                        <th>Qtd.</th>
                                                                        <th>Acao</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <a href="#" class="btn btn-success" onclick="finaliza_entrada()" id="botao_finaliza" style="float:right;margin-right:20px;margin-top:20px;">Finalizar Entrada</a>
                                                    </form>                                                    
                                                </div>
                                            </div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <form role="form" method="post" id="form_fornecedor">
                                                                <div class="panel panel-default col-md-12">
                                                                    <div class="panel-heading">
                                                                        <h4>Selecione o Fornecedor
                                                                        <a href="#janela2" rel="modal2"><button class="btn btn-primary" rel="modal2" style="float:right;">Novo Fronecedor(+)</button>
                                                                        </a>    
                                                                        </h4>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped table-bordered table-hover" id="table-fornecedor">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sel.</th>
                                                                                        <th>Fornecedor</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php 
                                                                                        while ($dados_fornecedor = pg_fetch_assoc($query_fornecedor)):
                                                                                    ?>
                                                                                    <tr class="odd gradeX">
                                                                                        <td><input type="checkbox"
                                                                                            value="<?php echo $dados_fornecedor['id_fornecedor'];?>" name="fornecedor"
                                                                                            nome="<?php echo $dados_fornecedor['nome']?>"></td>
                                                                                        <td name="fornecedor"><?php echo $dados_fornecedor['nome']?></td>
                                                                                    </tr>
                                                                                    <?php endwhile; ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                        <a href="#" style="float:right;" class="btn btn-primary" onclick="aparece_nota()">Próximo >></a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <form action="insere_banco.php" role="form" method="post" id="form_nota_fiscal" enctype="multipart/form-data" name="nota">
                                                                <div class="form-group row col-md-offset-1">
                                                                Fornecedor:<input class="inp_forne_nome">
                                                                <input type="hidden" id="inp_forne_nf" name="nota_no_post">
                                                                <input type="hidden" id="entrada" name="entrada">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label" for="numero_serie"><h3>Numero/Serie</h3></label>
                                                                    <input type="text" class="form-control" id="numero_serie" name="numero_serie" required="required">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label" for="digi_nota"><h3>Arquivo</h3></label>
                                                                    <input type="file" class="form-control" id="digi_nota" name="arquivo">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="control-label" for="digi_data"><h3>Data da Nota</h3></label>
                                                                    <input type="date" class="form-control" id="digi_data" name="digi_data" required="required"></br>
                                                                    <a href="#" style="float:right;" class="btn btn-primary" onclick="aparece_produto()">Próximo >></a>
                                                            </form>
                                                        </div>
                                                    </div>
                              
                        </div>
                    </div>
            </div>
        </div>
    </div>

<div class="window " id="janela1">
    <p>Adicionar novo produto</p>
    Nome:<input type="text" id="novo_produto">
    <br>
    Unidade:<?php include("../mod_produto/select.inc.php") ?></br>
    <button class="ok">Incluir</button><button class="cancel">Cancelar</button>
        
</div>
<div class="window2 " id="janela2">
    <p>Adicionar novo fornecedor</p>
    <label class="control-label" for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" required="required" name="nome">
                            <label class="control-label" for="data_ini">Data de Inicio de Contrato</label>
                            <input type="date" class="form-control" id="data_ini" required="required" name="data_ini">
                            <label class="control-label" for="data_fim">Data de Fim de Contrato</label>
                            <input type="date" class="form-control" id="data_fim" required="required" name="data_fim">
                            <label class="control-label" for="contato">Contato</label>
                            <input type="text" class="form-control" id="contato" required="required" name="contato">
                            <label class="control-label" for="email">Email</label>
                            <input type="text" class="form-control" id="email" required="required" name="email">
                            <label class="control-label" for="cnpj">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" required="required" name="cnpj">
                            </br><input type="button" class="btn btn-primary ok2" value="Cadastrar">
                            </br><br><input class="cancel2" type="button"  value="Cancelar">
        
</div>
<!-- mascara para cobrir o site -->  
<div id="mascara"></div>

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
        
         $('#form_produto').hide();
         $('#form_nota_fiscal').hide();
         $('#tela_pre_entrada').hide();
         $('#botao_finaliza').hide();

          function aparece_produto(){
        operacao[2]=$('#numero_serie').val();
        operacao[3]=$('#digi_data').val();
        //operacao[4]=$('#digi_nota').val();
        $("#form_produto").show(1000);
        $("#form_nota_fiscal").hide();
        $("#form_fornecedor").hide();
        $('#inp_nf_numero').val(operacao[2]);
        $('#data_nota').val(operacao[3]);
        };

        function aparece_nota(){
            var pacote = document.getElementsByName('fornecedor');
                for (i = 0; i < pacote.length; i++){
                    if ( pacote[i].checked ) {
                        var id_fornecedor = $(pacote[i]).val();
                        var nome_fornecedor = $(pacote[i]).attr('nome');
                    }
                }
            $("#form_nota_fiscal").show(1000);
            $("#form_fornecedor").hide();
            $("#form_produto").hide();
            operacao[0] = id_fornecedor;
            operacao[1] = nome_fornecedor;
            $("#inp_forne_nf").val(operacao[0]);
            $(".inp_forne_nome").val(operacao[1]);
            $("#inp_forne_id").val(operacao[0]);  
        };

        $("#nota_fiscal").click(function(event){
        event.preventDefault();
        $("#form_nota_fiscal").show(1000);
        $("#form_fornecedor").hide();
        $("#form_produto").hide();
        });

        $("#produto").click(function(event){
        $("#form_produto").show(1000);
        $("#form_nota_fiscal").hide();
        $("#form_fornecedor").hide();
        });

       
        
        $("#fornecedor").click(function(event){
        event.preventDefault();
        $("#form_fornecedor").show(1000);
        $("#form_nota_fiscal").hide();
        $("#form_produto").hide();
        });

        function remove_line(essa){
            var id_remover = $(essa).parent().parent().attr('id');
            $(essa).parent().parent().remove();
            fim_entrada.splice(id_remover, 1);
        }

        function tranferencia() {
            var linha = 0;
            var produto = $('#id_produto').val();
            var data_validade = $('#data_validade').val();
            var valor_unit = $('#valor_unit').val();
            var quantidade = $('#quantidade').val();
            var local = $('#inp_local').val();
            if (!produto == "" && !valor_unit == "" && !quantidade =="") {
            $('#tela_pre_entrada').show();
            $('#botao_finaliza').show();
            operacao[5] = produto; 
            operacao[6] = data_validade;
            operacao[7] = valor_unit;
            operacao[8] = quantidade;
            operacao[9] = local;
            id_produto = produto.split('-');
            $('#amostra_entrada').append('<tr id="'+id_tr+'"><td><input size="7" readonly value="'+operacao[5]+'"></td>"'+'"<td><input size="7" readonly value="'+operacao[6]+'"></td>"'+'"<td><input size="3" readonly value="'+operacao[7]+'"></td>"'+'"<td><input size="2" readonly value="'+operacao[8]+'"></td>"'+'"<td><button type="button" class="btn btn-danger glyphicon glyphicon-remove" onclick="remove_line(this)"></button></td></tr>');
            teste[id_tr] = new Array(operacao[0],operacao[2],operacao[3],operacao[4],id_produto[0],operacao[6],operacao[7],operacao[8],operacao[9]);
            fim_entrada[id_tr] = teste[id_tr];
            id_tr = id_tr + 1;
        }else{
            alert("Impossivel cadastrar por falta de informações!!");
        }
        }

        function finaliza_entrada(){
           id_entrada=new Array();
            for ( i = 0; i < fim_entrada.length; i++) {
               
                $.ajax({
                  url:  "insere_banco.php",
                  async: false,
                  data: "teste="+fim_entrada[i],
                  success: function(retorno){
                    id_entrada[i]=retorno;
                  },
                  error: function(retorno){
                    alert ("Falha no cadastro");
                  },
                  complete: function(){
                                       
                  }
                });
        };
            $("#entrada").val(id_entrada);
            $("#form_nota_fiscal").submit();
            
        }
        $("a[rel=modal]").click( function(ev){
                    ev.preventDefault();
 
                    var id = $(this).attr("href");
 
                    var alturaTela = $(document).height();
                    var larguraTela = $(window).width();
     
                 //colocando o fundo preto
                    $('#mascara').css({'width':larguraTela,'height':alturaTela});
                    $('#mascara').fadeIn(1000); 
                    $('#mascara').fadeTo("slow",0.8);
    
                    var left = ($(window).width() /2) - ( $(id).width() / 2 );
                    var top = ($(window).height() / 2) - ( $(id).height() / 2 );
     
                    $(id).css({'top':top,'left':left});
                    $(id).show();   
                });
                $('.ok').click(function(ev){
                //ev.preventDefault();
                  var novo_produto=$('#novo_produto').val();
                  var id_unidade=$('#id_unidade').val();
                    $.ajax({
                      url:  "adiciona_produto.php",
                      async: false,
                      data: "nome="+novo_produto+"&id_unidade="+id_unidade,
                      success: function(retorno){
                        $('#id_produto').append('<option value="'+retorno+' - '+novo_produto+'" selected>'+novo_produto+'</option>');
                      },
                      error: function(retorno){
                        alert ("Falha no cadastro");
                      },
                      complete: function(){
                                           
                      }
                    });
        
                  $("#mascara").hide();
                  $(".window").hide();
                  

                });
                $('.cancel').click(function(){
                  $("#mascara").hide();
                  $(".window").hide(); 
                });
                $('#mascara').click(function(){
                  $("#mascara").hide();
                  $(".window").hide(); 
                });

                $("a[rel=modal2]").click( function(ev){
                    ev.preventDefault();
 
                    var id = $(this).attr("href");
 
                    var alturaTela = $(document).height();
                    var larguraTela = $(window).width();
     
                 //colocando o fundo preto
                    $('#mascara').css({'width':larguraTela,'height':alturaTela});
                    $('#mascara').fadeIn(1000); 
                    $('#mascara').fadeTo("slow",0.8);
    
                    var left = ($(window).width() /2) - ( $(id).width() / 2 );
                    var top = ($(window).height() / 2) - ( $(id).height() / 2 );
     
                    $(id).css({'top':top,'left':left});
                    $(id).show();   
                });
                $('.ok2').click(function(ev){
                ev.preventDefault();
                  var nome=$('#nome').val();
                  var data_ini=$('#data_ini').val();
                  var data_fim=$('#data_fim').val();
                  var contato=$('#contato').val();
                  var email=$('#email').val();
                  var cnpj=$('#cnpj').val();
                    $.ajax({
                      url:  "adiciona_fornecedor.php",
                      async: false,
                      data: "nome="+nome+"&data_ini="+data_ini+"&data_fim="+data_fim+"&contato="+contato+"&email="+email+"&cnpj="+cnpj,
                      success: function(retorno){
                       $('#table-fornecedor').append('<tr class="odd gradeX"><td><input type="checkbox" checked value="'+retorno+'" name="fornecedor" nome="'+nome+'"></td><td name="fornecedor">'+nome+'</td></tr>');

                      },
                      error: function(retorno){
                        alert ("Falha no cadastro");
                      },
                      complete: function(){
                                           
                      }
                    });
        
                  $("#mascara").hide();
                  $(".window2").hide();
                  

                });
                $('.cancel2').click(function(){
                  $("#mascara").hide();
                  $(".window2").hide(); 
                });
                $('#mascara').click(function(){
                  $("#mascara").hide();
                  $(".window2").hide(); 
                });

      $("#contato").mask("(99) 9999-9999");
      $("#cnpj").mask("99.999.999/9999-99");
      //$("#data_ini").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});
      //$("#data_fim").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});

    function moeda(z){
    v = z.value;
    v=v.replace(/\D/g,"")
    v=v.replace(/[0-9]{12}/,"inválido")   //limita pra máximo 999.999.999,99
    v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 8 digitos
    v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  
    v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2")    //coloca virgula antes dos últimos 2 digitos
    z.value = v;
    }
</script>