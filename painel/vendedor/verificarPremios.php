<?php
include ("../../includes/seguranca.php");
include ('../../includes/conectar.php');
mysql_select_db($basedados, $conexao);
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Verificar Prêmios";
$Sub = 2;
require_once '../../includes/requires/header.php';
$idAmigo = $_GET['id'];
$resultado = mysql_query("SELECT * FROM `Amigo` where idAmigo='$idAmigo'");
$obj = mysql_fetch_object($resultado);

//Identificar Usuário
$idUsuario = $_SESSION["usuarioID"];
$selectUsuario = mysql_query("SELECT * FROM `Usuario` where idUsuario='$idUsuario'");
$objUsuario = mysql_fetch_object($selectUsuario);
?>

<script>
    $(document).ready(function() {
        $("#btn_listar-Gerente").addClass("active");
        $("#listarAmigo").addClass("active");
    });
    function confirmar() {
        if (confirm("Você deseja efetuar o resgate? O processo é irreversível.")) {
            return true;
        } else {
            return false;
        }
    }
    ;
</script>
<body>
    <div class="wrap">
        <div class="PagePainel">
            <?php
            require_once 'requires/topoPainel_vendedor.php';
            ?>
            <div class="ContentPainel">
                <?php if ($_GET['resgate'] == 'success') :
                    ?>
                    <br/>
                    <div style="width: 439px; position: fixed; left: 39%; bottom: 80%;" class="alert alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×
                        </button>
                        <b>Uhul!</b> Resgate Efetuado com sucesso! Agora o gerente, tem que alterar o status para concluído após a entrega
                        do prêmio.
                    </div>
                    <br/>
                <?php endif; ?>
                <div class="content-inner">
                    <div class="painelInfos">
                        <h4>Prêmios disponíveis para <i><?php echo $obj->nome ?>.</i></h4>
                        <br/>
                        <ul>
                            <li><b>Pontuação: 
                                    <?php
                                    if ($obj->pontuacao == 0) {
                                        echo "0";
                                    } else {
                                        echo $obj->pontuacao;
                                    }
                                    ?>
                                </b></li>
                            <li><b>Contato: <?php echo $obj->contato ?></b></li>
                            <li><b>CPF: <?php echo $obj->cpf ?></b></li>
                            <li><b>Profissão: <?php echo $obj->profissao ?></b></li>
                            <li><b>Endereço: <?php echo $obj->endereco ?></b></li>
                            <br/>
                            <li><b>Amigo criado por: <?php echo $objUsuario->nome ?></b></li>
                        </ul>
                        <div id="btns_historico">
                            <br/>
                            <a class="btn btn-primary" type="button" rel="shadowbox" href="historicoVendas.php?idAmigo=<?php echo $obj->idAmigo ?>&pagina=1"><div class="glyphicon glyphicon-shopping-cart"></div>&nbsp;&nbsp;Ver histório de Compras</a>
                            <br/><br/>
                            <a class="btn btn-primary" type="button" rel="shadowbox" href="historicoResgates.php?idAmigo=<?php echo $obj->idAmigo ?>"><div class="glyphicon glyphicon-star"></div>&nbsp;&nbsp;Ver histório de Resgates</a>
                        </div>
                    </div>
                    <div class="painelPremios">
                        <?php
                        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
                        //Listar Premios
                        $queryPremios = "SELECT * FROM `Premio` where valor<='$obj->pontuacao'";
                        $premio = mysql_query($queryPremios);
                        $totalPremios = mysql_num_rows($premio);

                        $registros = 3;
                        $numPaginas = ceil($totalPremios / $registros);
                        $inicio = ($registros * $pagina) - $registros;

                        $cmdPag = "select * from `Premio` where valor<='$obj->pontuacao' order by idPremio DESC limit $inicio,$registros";
                        $pag = mysql_query($cmdPag);
                        $totalPag = mysql_num_rows($pag);

                        if ($totalPag > 0) {
                            while ($objPremio = mysql_fetch_object($pag)) {
                                echo "<div class='boxPremio'>";
                                echo "<div class='imgPremio'>";
                                if ($objPremio->imagem == "") {
                                    echo "<img src='../../imagens/holder.png' alt='$objPremio->nome' width='300' height='210' />";
                                } else {
                                    echo "<a href='resgatarPremio.php?idPremio=$objPremio->idPremio'  title='$objPremio->nome'><img src='../../imagens/miniaturas/" . $objPremio->imagem . "' alt='$objPremio->nome' width='150' /></a>";
                                }
                                echo "</div>";
                                echo "<div class='nomePremio'>";
                                echo "<a href='resgatarPremio.php?idPremio=$objPremio->idPremio'>$objPremio->nome<br/>Valor: $objPremio->valor</a>" . "<br/>";
                                echo "</div>";
                                echo "<div class='resgatarPremio'>";
                                echo "<a class='btn btn-success type='button' onclick='return confirmar();' href='../../includes/functions/cadastros/resgate.php?idPremio=$objPremio->idPremio&idAmigo=$obj->idAmigo&idUsuario=$idUsuario'><div class='glyphicon glyphicon-star'></div>&nbsp;&nbsp;Resgatar</a>";
                                echo "</div>";
                                echo "</div>";
                            }
                            echo "<div class='clear'></div>";
                            echo "<ul class='pagination pull-right paginacao paginacao'>";
                            for ($i = 1; $i < $numPaginas + 1; $i++) {
                                echo " <li><a style='text-align:center;' href='verificarPremios.php?id=$obj->idAmigo&pagina=$i'>" . $i . "</a></li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "<p>Não há prêmios disponíveis para o amigo :( <br/>Você pode aplicar uma venda a ele, <a href='cadastrarVenda.php?codAmigo=$idAmigo'>clique aqui.</a><p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>