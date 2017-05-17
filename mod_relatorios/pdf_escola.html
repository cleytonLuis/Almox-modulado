<?php
require_once('../_inc/dompdf/dompdf_config.inc.php');
require('../_inc/conexao.inc.php');
require('../_inc/verifica_sessao.inc.php');

ob_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
                        $departamento=$_POST['departamento'];
                        $sql=pg_query("SELECT s.*,
                        p.nome as produto,
                        d.nome as departamento,
                        u.nome as unidade,
                        s.quantidade as quantidade,
                        s.data_sai as data,
                        count(*) over() as total 
                        FROM saida s
                        inner join departamento d on s.id_departamento = d.id_departamento
                        inner join produto p on s.id_produto = p.id_produto
                        inner join unidade u on p.unidade = u.id_unidade
                        WHERE s.id_departamento = '$departamento';
                        ");
                        $sql_nome=pg_query("SELECT * from departamento where id_departamento='$departamento'");
			          	
}
?>
<!DOCTYPE html>
<head>
      <title>Relatórios</title>
      <meta charset="utf-8" />
      
</head>
<body>
	<div style="text-align:center;">
		<img src="../assets/img/find_user.png" width="15%" />
		<h3>Prefeitura Municipal de Carambeí</h3>
		<h4>SGA-Sistema gerenciador de almoxarifado</h4>
	</div>
	<br><br>
	<h1 align="center">Relatório de produtos por departamento</h1>
	Departamento: <h2><?php $dados_nome=pg_fetch_assoc($sql_nome); echo $dados_nome['nome']; ?></h2>                       
<table  cellpadding="20" border="1" align="center">
	<tr>
		<th width="200" align="left">Produto</th>
	    <th width="50" align="left">Unidade</th>
	    <th width="10" align="left">Quantidade</th>
      <th width="80" align="left">Data da saída</th>
	</tr>
	<?php while($dados=pg_fetch_assoc($sql)):?>
    <tr >
    	<td width="200"><?php echo $dados['produto'];?></td>
	    <td width="50"><?php echo $dados['unidade'];?></td>
	    <td width="10"><?php echo $dados['quantidade'];?></td>
      <td width="80"><?php echo $dados['data'];?></td>
	</tr>
	<?php endwhile;?>
  
</table>
   
</body>

                  
<?php

$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('a4', 'portraite');
$dompdf->render();
// add the header
$canvas = $dompdf->get_canvas();
$font = Font_Metrics::get_font("helvetica", "bold");

// the same call as in my previous example
$canvas->page_text(10, 800, "relatório emitido por: ".$_SESSION['nome']."                                                                 Pag. {PAGE_NUM} de {PAGE_COUNT}",
                   $font, 6, array(0,0,0));

$dompdf->stream("produtos_por_departamento.pdf");

?> 