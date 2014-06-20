<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Listar Vendedores";
$Sub = 2;
require_once '../../includes/requires/header.php';
?>
<script>
    $(document).ready(function() {
        $("#btn_listar-Gerente").addClass("active");
        $("#listarVendedor").addClass("active");
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
                    <h4>Listagem de Vendedores e Gerentes</h4>
                    <div class="pull-left">
                        <form class="form-horizontal" method="get" action="">
                            <div class="input-group" style="width:550px;">
                                <input type="text" class="form-control" name="busca" placeholder="Digite o Código do Vende">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        Pesquisar
                                    </button>
                                    <button class="btn btn-primary" type="button" onclick="window.location.href = 'listarVendedores.php?pagina=1';
                                                                                ">
                                        <div class="glyphicon glyphicon-trash"></div>
                                        &nbsp;&nbsp;Limpar Filtro
                                    </button></span>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="pull-right">
                        <a type="button" class="btn btn-success" href="cadastrarVendedor.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Novo Vendedor</a>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <?php
                    include ('../../includes/conectar.php');
                    mysql_select_db($basedados, $conexao);
                    $busca = isset($_GET['busca']);
                    $sql = "SELECT * FROM `Usuario` WHERE idUsuario='$busca' or nome LIKE '%$busca%'";
                    $executar = mysql_query($sql);
                    $totalGet = mysql_num_rows($executar);

                    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
                    $cmd = "select * from Usuario";
                    $vendedores = mysql_query($cmd);
                    $total = mysql_num_rows($vendedores);
                    $registros = 5;
                    $numPaginas = ceil($total / $registros);
                    $inicio = ($registros * $pagina) - $registros;

                    $cmd = "select * from Usuario order by idUsuario DESC limit $inicio,$registros";
                    $vendedores = mysql_query($cmd);
                    $total = mysql_num_rows($vendedores);

                    if ($total > 0) {
                        echo "<table class='table table-hover'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<td>Cód.Vendedor</td>";
                        echo "<td>Nome</td>";
                        echo "<td>Login</td>";
                        echo "<td>Função</td>";
                        echo "<td>Ações</td>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        echo "<p>Digite sua busca acima.</p>";
                        if ($totalGet != 0) {
                            while ($objGet = mysql_fetch_object($executar)) {
                                echo "<tr>";
                                echo "<td>$objGet->idUsuario</td>";
                                echo "<td>$objGet->nome</td>";
                                echo "<td>$objGet->usuario</td>";
                                if ($objGet->tipo == 3) {
                                    echo "<td>Vendedor</td>";
                                    echo "<td>
							<a title='Editar' href='editarVendedor.php?id=$objGet->idUsuario'><i class='glyphicon glyphicon-pencil'></i></a>						
							<a title='Remover' href='../../includes/deleteDados.php?idUsuario=$objGet->idUsuario' onclick='return confirmar();'><i class='glyphicon glyphicon-trash'></i></a>
							</td>";
                                } else {
                                    echo "<td>Gerente</td>";
                                }

                                echo "</tr>";
                            }
                        } elseif (empty($totalGet)) {
                            while ($obj = mysql_fetch_object($vendedores)) {
                                echo "<tr>";
                                echo "<td>$obj->idUsuario</td>";
                                echo "<td>$obj->nome</td>";
                                echo "<td>$obj->usuario</td>";
                                if ($obj->tipo == 3) {
                                    echo "<td>Vendedor</td>";
                                    echo "<td>
							<a title='Editar' href='editarVendedor.php?id=$obj->idUsuario'><i class='glyphicon glyphicon-pencil'></i></a>						
							<a title='Remover' href='../../includes/deleteDados.php?idUsuario=$obj->idUsuario' onclick='return confirmar();'><i class='glyphicon glyphicon-trash'></i></a>
							</td>";
                                } else {
                                    echo "<td>Gerente</td>";
                                }
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