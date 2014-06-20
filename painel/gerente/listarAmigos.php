<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Listar Amigos";
$Sub = 2;
require_once '../../includes/requires/header.php';
?>
<script>
    $(document).ready(function() {
        $("#btn_listar-Gerente").addClass("active");
        $("#listarAmigo").addClass("active");
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
                    <h4>Listagem de Amigos</h4>
                    <div class="pull-left">
                        <form class="form-horizontal" method="get" action="">
                            <div class="input-group" style="width:550px;">
                                <input type="text" class="form-control" name="busca" placeholder="Digite o Código ou o nome do(a) Amigo(a)">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        Pesquisar
                                    </button>
                                    <button class="btn btn-primary" type="button" onclick="window.location.href = 'listarAmigos.php?pagina=1';
                                                                                ">
                                        <div class="glyphicon glyphicon-trash"></div>
                                        &nbsp;&nbsp;Limpar Filtro
                                    </button></span>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="pull-right">
                        <a type="button" class="btn btn-success" href="cadastrarAmigo.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Nova Venda</a>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <?php
                    include ('../../includes/conectar.php');
                    mysql_select_db($basedados, $conexao);
                    $busca = isset($_GET['busca'])  ;
                    $sql = "SELECT * FROM `Amigo` WHERE idAmigo='$busca' or nome LIKE '%$busca%'";
                    $executar = mysql_query($sql);
                    $totalGet = mysql_num_rows($executar);

                    //Calculo de Páginas
                    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
                    $totalPags = mysql_num_rows(mysql_query("select * from Amigo"));
                    $registros = 3;
                    $numPaginas = ceil($totalPags / $registros);
                    $inicio = ($registros * $pagina) - $registros;

                    $amigos = mysql_query("select * from Amigo order by idAmigo DESC limit $inicio,$registros");
                    $total = mysql_num_rows($amigos);
                    if ($totalPags > 0) {
                        echo "<table class='table table-hover'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<td>Cód.Amigo</td>";
                        echo "<td>Nome</td>";
                        echo "<td>Contato</td>";
                        echo "<td>Pontuação</td>";
                        echo "<td>Açoes</td>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        echo "<p>Digite sua busca acima.</p>";

                        if (isset($_GET['busca']) == "") {
                            while ($obj = mysql_fetch_object($amigos)) {
                                echo "<tr>";
                                echo "<td>$obj->idAmigo</td>";
                                echo "<td>$obj->nome</td>";
                                echo "<td>$obj->contato</td>";
                                echo "<td>$obj->pontuacao</td>";
                                echo "<td>
							<a title='Ver Premios Disponiveis' href='verificarPremios.php?id=$obj->idAmigo&pagina=1'><i class='glyphicon glyphicon-star'></i></a>						
							<a title='Editar' href='editarAmigo.php?id=$obj->idAmigo'><i class='glyphicon glyphicon-pencil'></i></a>						
							<a title='Remover' href='../../includes/deleteDados.php?idAmigo=$obj->idAmigo' onclick='return confirmar();'><i class='glyphicon glyphicon-trash'></i></a>
							</td>";
                                echo "</tr>";
                            }
                        } else {

                            while ($objGet = mysql_fetch_object($executar)) {
                                echo "<tr>";
                                echo "<td>$objGet->idAmigo</td>";
                                echo "<td>$objGet->nome</td>";
                                echo "<td>$objGet->contato</td>";
                                echo "<td>$objGet->pontuacao</td>";
                                echo "<td>
							<a title='Ver Premios Disponiveis' href='verificarPremios.php?id=$objGet->idAmigo&pagina=1'><i class='glyphicon glyphicon-star'></i></a>						
							<a title='Editar' href='editarAmigo.php?id=$objGet->idAmigo'><i class='glyphicon glyphicon-pencil'></i></a>						
							<a title='Remover' href='../../includes/deleteDados.php?idAmigo=$objGet->idAmigo' onclick='return confirmar();'><i class='glyphicon glyphicon-trash'></i></a>
							</td>";
                                echo "</tr>";
                            }
                        }

                        echo "</tbody>";
                        echo "</table>";
                        echo "<ul id='pagination-demo' class='pagination paginacao-farmacias pull-right pagination-sm'>";
                        for ($i = 1; $i < $numPaginas + 1; $i++) {
                            echo " <li><a style='text-align:center;' href='listarAmigos.php?pagina=$i'>" . $i . "</a></li>";
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