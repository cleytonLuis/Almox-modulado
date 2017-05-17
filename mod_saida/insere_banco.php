<?php
require("../_inc/conexao.inc.php");
require("../_inc/verifica_sessao.inc.php");
if(isset($_GET['teste']))
{
     $teste =  explode(",", $_GET['teste']);
     // Pegar do formulário o nome digitado pelo cliente
    $de_quem = $teste[0];
  if(array_key_exists(1,$teste)){
    $produto = $teste[1];
    $quantidade = $teste[2];
    $local=$teste[3];
    //testar se houve entrada do produto para uma possivel saida
    $teste_saida=pg_query( "select * from situacao where id_produto='$produto'");
    $dados_teste=pg_fetch_assoc($teste_saida);
    
    if(($dados_teste['quantidade']<$quantidade)){
      echo "erro";
      
    exit(0);
    }else{
      $total=$dados_teste['quantidade']-$quantidade;
      if (!$local == "") {
        if ($local == "Almox. Geral") {
              // Monta a SQL de inserção
          $sql = "INSERT INTO saida (id_produto,id_departamento,quantidade,local) 
          VALUES ('$produto','$de_quem','$quantidade','$local')";
          // Executo a Query
          pg_query($sql) or die(pg_last_error());
          $sql = "UPDATE situacao set quantidade='$total' where id_produto='$produto'";
          // Executo a Query
          pg_query($sql) or die(pg_last_error());
          echo"Cadastro efetuado com sucesso!";

        }
        if ($local == "Almox. Saude") {
              // Monta a SQL de inserção
          $sql = "INSERT INTO saida (id_produto,id_ubs,quantidade,local) 
          VALUES ('$produto','$de_quem','$quantidade','$local')";
          // Executo a Query
          pg_query($sql) or die(pg_last_error());
          $sql = "UPDATE situacao set quantidade='$total' where id_produto='$produto'";
          // Executo a Query
          pg_query($sql) or die(pg_last_error());
          echo"Cadastro efetuado com sucesso!";
        }
        if ($local == "Almox. Educacao") {
              // Monta a SQL de inserção
          $sql = "INSERT INTO saida (id_produto,id_escola,quantidade,local) 
          VALUES ('$produto','$de_quem','$quantidade','$local')";
          // Executo a Query
          pg_query($sql) or die(pg_last_error());
          $sql = "UPDATE situacao set quantidade='$total' where id_produto='$produto'";
          // Executo a Query
          pg_query($sql) or die(pg_last_error());
          $sql = "UPDATE situacao set quantidade='$total' where id_produto='$produto'";
          // Executo a Query
          pg_query($sql) or die(pg_last_error());
          echo"Cadastro efetuado com sucesso!";
        }
      }
    }
  }
  
}
