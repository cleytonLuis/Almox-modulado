<?php
// Conecta
require("../_inc/conexao.inc.php");
$id_entrada = "";
if(isset($_GET['teste'])){
  $teste =  explode(",", $_GET['teste']);
$id_fornecedor = $teste[0];
$numero_nota= $teste[1];
$data_nota= $teste[2];
$id_produto= $teste[4];
$data_validade= $teste[5];
$valor_unit= $teste[6].",".$teste[7];
$quantidade = $teste[8];
$local = $teste[9];

$sql_entrada = "INSERT INTO entrada (id_produto,id_fornecedor,quantidade,valor_unit,numero_nota,data_nota,data_validade,local)
            VALUES ('$id_produto','$id_fornecedor','$quantidade','$valor_unit','$numero_nota','$data_nota','$data_validade','$local')RETURNING id_entrada";
          // Executo a Query
        $query=pg_query($sql_entrada) or die(pg_last_error());
        $id_entrada = pg_result($query,0,'id_entrada');
        echo $id_entrada;
        $sql=pg_query("select * from situacao where id_produto=$id_produto");
        if(pg_num_rows($sql)!=0){
          $dados=pg_fetch_assoc($sql);
          $quant_atual=$dados['quantidade'];
          $quantidade=$quant_atual+$quantidade;
          $sql=pg_query("UPDATE situacao set quantidade=$quantidade where id_produto=$id_produto");
        }else{
          $sql=pg_query("INSERT INTO situacao (id_produto,quantidade) values ('$id_produto','$quantidade')");
        }

}


if($_SERVER['REQUEST_METHOD']=='POST'){
  $id_entrada=explode(",",$_POST['entrada']);
  $id_fornecedor = $_POST['nota_no_post'];
  $numero_nota= $_POST['numero_serie'];
  $data_nota= $_POST['digi_data'];

  $sql_arquivo = "INSERT INTO nf (numero,data,id_fornecedor) VALUES ('$numero_nota','$data_nota','$id_fornecedor') RETURNING id_nf";
          // Executo a Query
    $query=pg_query($sql_arquivo) or die(pg_last_error());
  
  if(isset($_FILES['arquivo'])and$_FILES['arquivo']['error']===0){
             // Pega os dados do formulário
             $nome = $_FILES['arquivo']['name'];
             $nome_tmp = $_FILES['arquivo']['tmp_name'];
             $id_nf = pg_result($query,0,'id_nf');
             // Monta a inserção
             $sql = "INSERT INTO anexo (id_nf,nome) VALUES ('$id_nf','$nome') RETURNING id_anexo";
              // Executa a SQL
             $query = pg_query($sql) or die(pg_last_error());
              // Extrair o id inserido
             $id_anexo = pg_result($query,0,'id_anexo');
             // Salva na pasta anexos
             move_uploaded_file($nome_tmp,'anexos/'.$id_anexo);
             //Adiciona o id do anexo  em cada item da entrada
             foreach ($id_entrada as $id){
                $sql_entrada="UPDATE entrada SET id_anexo=$id_anexo WHERE id_entrada=$id";
                $query=pg_query($sql_entrada) or die(pg_last_error()); 
             }
                          
          }
         else{
            if(isset($_FILES['arquivo'])){
              switch($_FILES['arquivo']['error']){
                case 1:
                case 2:
                  echo "ERRO: Arquivo muito grande ({$_FILES['arquivo']['error']})</br>";
                  break;
                case 3: 
                  echo "ERRO: Upload Interrompido</br>";
                  break;
                case 4:
                  echo "Ausência de arquivos";
                  break;
              }
            }  
          }
         ?>
         <script>
          alert("Cadastro efetuado com sucesso!!");
          location.href='cadastro_entrada.php';
         </script>";
         <?php
  }       
?>