<?php

include ('../../includes/conectar.php');
mysql_select_db($basedados, $conexao);

$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$cmd = "select * from Resgate where status=3";
$vendas = mysql_query($cmd);
$total = mysql_num_rows($vendas);
$registros = 5;
$numPaginas = ceil($total / $registros);
$inicio = ($registros * $pagina) - $registros;

$cmd = "select * from Resgate where status=3 order by data DESC limit $inicio,$registros";
$resgate = mysql_query($cmd);
$total = mysql_num_rows($resgate);

if ($total > 0) {
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<td>Cód.Resgate</td>";
    echo "<td>Amigo</td>";
    echo "<td>Efetuado por</td>";
    echo "<td>Premio</td>";
    echo "<td>Data</td>";
    echo "<td>Status</td>";
    echo "<td>Açoes</td>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($objResgate = mysql_fetch_object($resgate)) {
        //Selects para saber a qual amigo e usuario pertence a venda
        $idAmigo = $objResgate->idAmigo;
        $idUsuario = $objResgate->idUsuario;
        $idPremio = $objResgate->idPremio;

        $objAmigo = mysql_fetch_object(mysql_query("SELECT * from Amigo where idAmigo='$idAmigo'"));
        $objUsuario = mysql_fetch_object(mysql_query("SELECT * from Usuario where idUsuario='$idUsuario'"));
        $objPremio = mysql_fetch_object(mysql_query("SELECT * from Premio where idPremio='$idPremio'"));

        if ($objResgate->status == 0) {
            $status = "<div style='color:#cdb302;'>Pendente</div>";
        } elseif ($objResgate->status == 1) {
            $status = "<div style='color:green;'>Concluído</div>";
        } else {
            $status = "<div style='color:red;'>Bloqueado</div>";
        }

        echo "<tr>";
        echo "<td>$objResgate->idResgate</td>";
        echo "<td>$objAmigo->nome</td>";
        echo "<td>$objUsuario->nome</td>";
        echo "<td>$objPremio->nome</td>";
        echo "<td>$objResgate->data</td>";
        echo "<td>$status</td>";
        if ($objResgate->status == 0) {
            echo "<td>			
							<a title='Alterar Status para Concluído' href='../../includes/functions/edicoes/statusResgate.php?alterar=concluido&idResgate=$objResgate->idResgate' onclick='return confirmar();'><i class='glyphicon glyphicon-ok'></i></a>
							&nbsp;
							<a title='Alterar Status para Bloqueado' href='../../includes/functions/edicoes/statusResgate.php?alterar=bloqueado&idResgate=$objResgate->idResgate' onclick='return confirmar();'><i class='glyphicon glyphicon-ban-circle'></i></a>
							</td>";
        } elseif ($objResgate->status == 1) {
            echo "<td>			
							<a title='Alterar Status para Pendente' href='../../includes/functions/edicoes/statusResgate.php?alterar=pendente&idResgate=$objResgate->idResgate' onclick='return confirmar();'><i class='glyphicon glyphicon-minus'></i></a>	
							&nbsp;
							<a title='Alterar Status para Bloqueado' href='../../includes/functions/edicoes/statusResgate.php?alterar=bloqueado&idResgate=$objResgate->idResgate' onclick='return confirmar();'><i class='glyphicon glyphicon-ban-circle'></i></a>
							</td>";
        } else {
            echo "<td>			
							<a title='Alterar Status para Concluido' href='../../includes/functions/edicoes/statusResgate.php?alterar=concluido&idResgate=$objResgate->idResgate' onclick='return confirmar();'><i class='glyphicon glyphicon-ok'></i></a>
							&nbsp;
							<a title='Alterar Status para Pendente' href='../../includes/functions/edicoes/statusResgate.php?alterar=pendente&idResgate=$objResgate->idResgate' onclick='return confirmar();'><i class='glyphicon glyphicon-minus'></i></a>
							</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "<ul class='pagination pull-right paginacaoResgates'>";
    for ($i = 1; $i < $numPaginas + 1; $i++) {
        echo " <li><a style='text-align:center;' href='amigoseResgates.php?pagina=$i&filter=bloqueados'>" . $i . "</a></li>";
    }
    echo "</ul>";
} else {
    echo "<h5>Sem registros no banco</h5>";
}
?>