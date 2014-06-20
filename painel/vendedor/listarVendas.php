<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Listar Vendas";
$idUsuarioSession = $_SESSION["usuarioID"];
$Sub = 2;
require_once '../../includes/requires/header.php';
?>
<script>
    $(document).ready(function() {
        $("#btn_listar-Gerente").addClass("active");
        $("#listarVenda").addClass("active");
    });
</script>
<body>
    <div class="wrap">
        <div class="PagePainel">
            <?php
            require_once 'requires/topoPainel_vendedor.php';
            ?>
            <div class="ContentPainel">
                <div class="content-inner">
                    <h4>Listagem de Vendas</h4>
                    <div class="pull-left">
                        <form class="form-horizontal" method="get" action="">
                            <div class="input-group" style="width:550px;">
                                <input type="text" class="form-control" name="busca" placeholder="Digite o Código da Venda">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        Pesquisar
                                    </button>
                                    <button class="btn btn-primary" type="button" onclick="window.location.href = 'listarVendas.php?pagina=1';
                                                                                ">
                                        <div class="glyphicon glyphicon-trash"></div>
                                        &nbsp;&nbsp;Limpar Filtro
                                    </button></span>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="pull-right">
                        <a type="button" class="btn btn-success" href="cadastrarVenda.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Nova Venda</a>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <?php
                    include ('../../includes/conectar.php');
                    mysql_select_db($basedados, $conexao);
                    $busca = isset($_GET['busca']);
                    $sql = "SELECT * FROM `Venda` WHERE idVenda='$busca'";
                    $executar = mysql_query($sql);
                    $totalGet = mysql_num_rows($executar);

                    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
                    $cmd = "select * from Venda";
                    $vendas = mysql_query($cmd);
                    $total = mysql_num_rows($vendas);
                    $registros = 3;
                    $numPaginas = ceil($total / $registros);
                    $inicio = ($registros * $pagina) - $registros;

                    $cmd = "select * from Venda order by idVenda DESC limit $inicio,$registros";
                    $vendas = mysql_query($cmd);
                    $total = mysql_num_rows($vendas);

                    if ($total > 0) {
                        echo "<table class='table table-hover'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<td>Cód.Venda</td>";
                        echo "<td>Amigo</td>";
                        echo "<td>Efetuada por</td>";
                        echo "<td>Nota Fiscal</td>";
                        echo "<td>Data</td>";
                        echo "<td>Valor em R$</td>";
                        echo "<td>Pontos</td>";
                        echo "<td>Açoes</td>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        echo "<p>Digite sua busca acima.</p>";
                        if ($totalGet != 0) {
                            while ($objGet = mysql_fetch_object($executar)) {
                                //Selects para saber a qual amigo e usuario pertence a venda
                                $idAmigo = $objGet->idAmigo;
                                $idUsuario = $objGet->idUsuario;
                                $selectAmigo = mysql_query("SELECT * from Amigo where idAmigo='$idAmigo'");
                                $objAmigo = mysql_fetch_object($selectAmigo);
                                $selectUsuario = mysql_query("SELECT * from Usuario where idUsuario='$idUsuario'");
                                $objUsuario = mysql_fetch_object($selectUsuario);
                                echo "<tr>";
                                echo "<td>$objGet->idVenda</td>";
                                echo "<td>$objAmigo->nome</td>";
                                echo "<td>$objUsuario->nome</td>";
                                echo "<td>$objGet->notaFiscal</td>";
                                echo "<td>$objGet->data</td>";
                                echo "<td>$objGet->valor</td>";
                                echo "<td>$objGet->valorPontos</td>";
                                echo "<td>			
							<a title='Remover' href='../../includes/functions/deletarVenda-vendedor.php?idVenda=$obj->idVenda&idAmigo=$idAmigo&idUsuario=$idUsuarioSession' onclick='return confirmar();'><i class='glyphicon glyphicon-trash'></i></a>
							</td>";
                                echo "</tr>";
                            }
                        } elseif (empty($totalGet)) {
                            while ($obj = mysql_fetch_object($vendas)) {
                                //Selects para saber a qual amigo e usuario pertence a venda
                                $idAmigo = $obj->idAmigo;
                                $idUsuario = $obj->idUsuario;
                                $selectAmigo = mysql_query("SELECT * from Amigo where idAmigo='$idAmigo'");
                                $objAmigo = mysql_fetch_object($selectAmigo);
                                $selectUsuario = mysql_query("SELECT * from Usuario where idUsuario='$idUsuario'");
                                $objUsuario = mysql_fetch_object($selectUsuario);
                                echo "<tr>";
                                echo "<td>$obj->idVenda</td>";
                                echo "<td>$objAmigo->nome</td>";
                                echo "<td>$objUsuario->nome</td>";
                                echo "<td>$obj->notaFiscal</td>";
                                echo "<td>$obj->data</td>";
                                echo "<td>$obj->valor</td>";
                                echo "<td>$obj->valorPontos</td>";
                                echo "<td>			
							<a title='Remover' href='../../includes/functions/deletarVenda-vendedor.php?idVenda=$obj->idVenda&idAmigo=$idAmigo&idUsuario=$idUsuarioSession' onclick='return confirmar();'><i class='glyphicon glyphicon-trash'></i></a>
							</td>";
                                echo "</tr>";
                            }
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "<ul id='pagination-demo' class='pagination paginacao-farmacias pull-right pagination-sm'>";
                        for ($i = 1; $i < $numPaginas + 1; $i++) {
                            echo " <li><a style='text-align:center;' href='listarVendas.php?pagina=$i'>" . $i . "</a></li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<h5>Sem registros no banco</h5>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>