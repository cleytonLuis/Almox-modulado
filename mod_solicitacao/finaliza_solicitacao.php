<?php
require('../_inc/conexao.inc.php');
$id_solicitacao=$_GET['id_solicitacao'];
$query=pg_query("UPDATE solicitacao set status='finalizada' where id_solicitacao='$id_solicitacao'");
