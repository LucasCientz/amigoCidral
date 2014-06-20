<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Histórico de Vendas";
$Sub = 2;
require_once '../../includes/requires/header.php';
$idAmigo = $_GET['idAmigo'];
$resultado = mysql_query("SELECT * FROM `Amigo` where idAmigo='$idAmigo'");
$obj = mysql_fetch_object($resultado);

$resultadoUsuario = mysql_query("SELECT * FROM `Usuario` where idUsuario='$obj->idUsuario'");
$objUsuario = mysql_fetch_object($resultadoUsuario);
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
                    <h4>Histórico de Vendas para <i style="color: red;"><?php echo $obj->nome ?></i></h4>
                        <?php
                        include ('../../includes/conectar.php');
                        mysql_select_db($basedados, $conexao);

                        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
                        $cmd = "select * from Venda where idAmigo='$idAmigo'";
                        $vendas = mysql_query($cmd);
                        $total = mysql_num_rows($vendas);
                        $registros = 10;
                        $numPaginas = ceil($total / $registros);
                        $inicio = ($registros * $pagina) - $registros;

                        $cmd = "select * from Venda where idAmigo='$idAmigo' limit $inicio,$registros";
                        $vendas = mysql_query($cmd);
                        $total = mysql_num_rows($vendas);

                        if ($total > 0) {
                            echo "<table class='table table-hover'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<td>Cód.Venda</td>";
                            echo "<td>Cód.Nota Fiscal</td>";
                            echo "<td>Valor R$</td>";
                            echo "<td>Valor em Pontos</td>";
                            echo "<td>Efetuada Por</td>";
                            echo "<td>Data</td>";
                            echo "<td>Açoes</td>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($obj = mysql_fetch_object($vendas)) {
                                echo "<tr>";
                                echo "<td>$obj->idVenda</td>";
                                echo "<td>$obj->notaFiscal</td>";
                                echo "<td>$obj->valor</td>";
                                echo "<td>$obj->valorPontos</td>";
                                echo "<td>$objUsuario->nome</td>";
                                echo "<td>$obj->data</td>";
                                echo "<td><a title='Remover' href='../../includes/deleteVenda.php?idVenda=$obj->idVenda&idAmigo=$idAmigo' onclick='return confirmar();'><i class='glyphicon glyphicon-trash'></i></a>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "<ul class='pagination  pull-right paginacao_historico'>";
                            for ($i = 1; $i < $numPaginas + 1; $i++) {
                                echo " <li><a style='text-align:center;' href='historicoVendas.php?pagina=$i&idAmigo=$idAmigo'>" . $i . "</a></li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "<h5>Sem vendas cadastradas.</h5>";
                        }
                        ?>
                </div>
            </div>
            </body>
            </html>