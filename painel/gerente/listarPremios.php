<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Listar Premios";
$Sub = 2;
require_once '../../includes/requires/header.php';
?>
<script>
    $(document).ready(function() {
        $("#btn_listar-Gerente").addClass("active");
        $("#listarPremio").addClass("active");
    });
</script>
<body>
    <div class="wrap">
        <div class="PagePainel">
            <?php
            require_once 'requires/topoPainel_gerente.php';
            ?>
            <div class="ContentPainel">
                <div class="content-inner">
                    <h4>Listagem de Premios</h4>
                    <div class="pull-left">
                        <form class="form-horizontal" method="get" action="">
                            <div class="input-group" style="width:550px;">
                                <input type="text" class="form-control" name="busca" placeholder="Digite o Código ou o Nome do Prêmio">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        Pesquisar
                                    </button>
                                    <button class="btn btn-primary" type="button" onclick="window.location.href = 'listarPremios.php?pagina=1';
                                                                                ">
                                        <div class="glyphicon glyphicon-trash"></div>
                                        &nbsp;&nbsp;Limpar Filtro
                                    </button></span>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="pull-right">
                        <a type="button" class="btn btn-success" href="cadastrarPremio.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Novo Premio</a>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <?php
                    include ('../../includes/conectar.php');
                    mysql_select_db($basedados, $conexao);
                    $busca = isset($_GET['busca']);
                    $sql = "SELECT * FROM `Premio` WHERE idPremio='$busca' or nome LIKE '%$busca%'";
                    $executar = mysql_query($sql);
                    $totalGet = mysql_num_rows($executar);

                    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
                    $cmd = "select * from Premio";
                    $premios = mysql_query($cmd);
                    $total = mysql_num_rows($premios);
                    $registros = 5;
                    $numPaginas = ceil($total / $registros);
                    $inicio = ($registros * $pagina) - $registros;

                    $cmd = "select * from Premio order by idPremio DESC limit $inicio,$registros";
                    $premios = mysql_query($cmd);
                    $total = mysql_num_rows($premios);

                    if ($total > 0) {
                        echo "<table class='table table-hover'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<td>Cód.Premio</td>";
                        echo "<td>Nome</td>";
                        echo "<td>Valor em Pontos</td>";
                        echo "<td>Açoes</td>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        echo "<p>Digite sua busca acima.</p>";
                        if ($totalGet != 0) {
                            while ($objGet = mysql_fetch_object($executar)) {
                                echo "<tr>";
                                echo "<td>$objGet->idPremio</td>";
                                echo "<td>$objGet->nome</td>";
                                echo "<td>$objGet->valor</td>";
                                echo "<td>
							<a title='Editar' href='editarPremio.php?id=$objGet->idPremio'><i class='glyphicon glyphicon-pencil'></i></a>						
							<a title='Remover' href='../../includes/deleteDados.php?idPremio=$objGet->idPremio' onclick='return confirmar();'><i class='glyphicon glyphicon-trash'></i></a>
							</td>";
                                echo "</tr>";
                            }
                        } elseif (empty($totalGet)) {
                            while ($obj = mysql_fetch_object($premios)) {
                                echo "<tr>";
                                echo "<td>$obj->idPremio</td>";
                                echo "<td>$obj->nome</td>";
                                echo "<td>$obj->valor</td>";
                                echo "<td>
							<a title='Editar' href='editarPremio.php?id=$obj->idPremio'><i class='glyphicon glyphicon-pencil'></i></a>						
							<a title='Remover' href='../../includes/deleteDados.php?idPremio=$obj->idPremio' onclick='return confirmar();'><i class='glyphicon glyphicon-trash'></i></a>
							</td>";
                                echo "</tr>";
                            }
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "<ul id='pagination-demo' class='pagination paginacao-farmacias pull-right pagination-sm'>";
                        for ($i = 1; $i < $numPaginas + 1; $i++) {
                            echo " <li><a style='text-align:center;' href='farmaciasHome.php?pagina=$i'>" . $i . "</a></li>";
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