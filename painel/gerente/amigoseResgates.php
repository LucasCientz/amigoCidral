<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Listar Vendas";
$Sub = 2;
require_once '../../includes/requires/header.php';
?>
<script>
    $(document).ready(function() {
        $("#btn_amigoseResgate-Gerente").addClass("active");
    });
    function confirmar() {
        if (confirm("Você realmente deseja alterar o status do Resgate?")) {
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
            require_once 'requires/topoPainel_gerente.php';
            ?>
            <div class="ContentPainel">
                <div class="content-inner">
                    <h4>Listagem de Resgates</h4>
                    <div class="pull-left">
                        <form class="form-horizontal" method="get" action="">
                            <div class="input-group" style="width:900px;">
                                <input type="text" class="form-control" name="busca" placeholder="Digite o Código ou o Nome do Amigo">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        Pesquisar
                                    </button>
                                    <button class="btn btn-warning" type="button" onclick="window.location.href = 'amigoseResgates.php?pagina=1&filter=pendentes';
                                            ">
                                        <div class="glyphicon glyphicon-minus"></div>
                                        &nbsp;&nbsp;Pendentes
                                    </button>
                                    <button class="btn btn-success" type="button" onclick="window.location.href = 'amigoseResgates.php?pagina=1&filter=concluidos';
                                            ">
                                        <div class="glyphicon glyphicon-ok"></div>
                                        &nbsp;&nbsp;Concluidos
                                    </button>
                                    <button class="btn btn-danger" type="button" onclick="window.location.href = 'amigoseResgates.php?pagina=1&filter=bloqueados';
                                            ">
                                        <div class="glyphicon glyphicon-ban-circle"></div>
                                        &nbsp;&nbsp;Bloqueados
                                    </button>
                                    <button class="btn btn-primary" type="button" onclick="window.location.href = 'amigoseResgates.php?pagina=1&filter=padrao'">
                                        <div class="glyphicon glyphicon-trash"></div>
                                        &nbsp;&nbsp;Limpar Filtro
                                    </button></span>
                                </span>
                            </div>
                        </form>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <?php if ($_GET['filter'] == 'padrao') :
                        ?>

                        <?php
                        require_once 'requires/filtroPadraoResgates.php';
                        ?>

                    <?php endif; ?>
                    <?php if ($_GET['filter'] == 'pendentes') :
                        ?>

                        <?php
                        require_once 'requires/filterPendentesResgates.php';
                        ?>

                    <?php endif; ?>

                    <?php if ($_GET['filter'] == 'concluidos') :
                        ?>

                        <?php
                        require_once 'requires/filterConcluidosResgates.php';
                        ?>

                    <?php endif; ?>

                    <?php if ($_GET['filter'] == 'bloqueados') :
                        ?>

                        <?php
                        require_once 'requires/filterBloqueadosResgates.php';
                        ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>