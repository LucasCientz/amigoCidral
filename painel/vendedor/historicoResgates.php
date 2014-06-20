<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Histórico de Resgates";
$Sub = 2;
require_once '../../includes/requires/header.php';
$idAmigo = $_GET['idAmigo'];
$queryAmigo = mysql_query("SELECT * FROM `Amigo` where idAmigo='$idAmigo'");
$objAmigo = mysql_fetch_object($queryAmigo);

if ($objResgate->status == 0) {
    $statusResgate = "Pendente";
} elseif ($objResgate->status == 1) {
    $statusResgate = "Concluído";
} else {
    $statusResgate = "Bloqueado";
}
?>

<style>
    .PagePainel {
        height: 560px !important;
    }
</style>
<body>
    <div class="wrap">
        <div class="PagePainel">
            <div class="ContentPainel">
                <div class="content-inner">
                    <h4>Histórico de Resgates para <i style="color: red;"><?php echo $objAmigo->nome ?></i></h4>
                        <?php
                        include ('../../includes/conectar.php');
                        mysql_select_db($basedados, $conexao);

                        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
                        $cmd = "select * from Resgate where idAmigo='$idAmigo'";
                        $vendas = mysql_query($cmd);
                        $total = mysql_num_rows($vendas);
                        $registros = 10;
                        $numPaginas = ceil($total / $registros);
                        $inicio = ($registros * $pagina) - $registros;

                        $cmd = "select * from Resgate where idAmigo='$idAmigo' order by idResgate DESC limit $inicio,$registros";
                        $vendas = mysql_query($cmd);
                        $total = mysql_num_rows($vendas);
                        $queryResgate = mysql_query("SELECT * FROM Resgate where idAmigo='$idAmigo' limit $inicio,$registros");
                        if ($total > 0) {
                            echo "<table class='table table-hover'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<td>Cód.Resgate</td>";
                            echo "<td>Premio</td>";
                            echo "<td>Amigo</td>";
                            echo "<td>Vendedor</td>";
                            echo "<td>Data do Resgate</td>";
                            echo "<td>Status</td>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($objResgate = mysql_fetch_object($queryResgate)) {
                                $queryUsuario = mysql_query("SELECT * FROM `Usuario` where idUsuario='$objResgate->idUsuario'");
                                $objUsuario = mysql_fetch_object($queryUsuario);
                                $queryPremio = mysql_query("SELECT * FROM Premio where idPremio='$objResgate->idPremio'");
                                $objPremio = mysql_fetch_object($queryPremio);
                                echo "<tr>";
                                echo "<td>$objResgate->idResgate</td>";
                                echo "<td>$objPremio->nome</td>";
                                echo "<td>$objAmigo->nome</td>";
                                echo "<td>$objUsuario->nome</td>";
                                echo "<td>$objResgate->data</td>";
                                echo "<td>$statusResgate</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "<ul id='pagination-demo' class='pagination pull-right pagination-sm paginacao_historico'>";
                            for ($i = 1; $i < $numPaginas + 1; $i++) {
                                echo " <li><a style='text-align:center;' href='historicoResgates.php?pagina=$i&idAmigo=$objAmigo->idAmigo'>" . $i . "</a></li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "<h5>Sem resgates feitos.</h5>";
                        }
                        ?>
                </div>
            </div>
            </body>
            </html>