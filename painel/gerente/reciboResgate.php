<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Editar Amigo";
$Sub = 2;
require_once '../../includes/requires/header.php';
//Pega dados para ediçao
$idResgate = base64_decode($_GET['idResgate']);
$queryResgate = mysql_query("SELECT * FROM `Resgate` where idResgate='$idResgate'");
$objResgate = mysql_fetch_object($queryResgate);

$objAmigo = mysql_fetch_object(mysql_query("SELECT * FROM Amigo where idAmigo='$objResgate->idAmigo'"));
$objUsuario = mysql_fetch_object(mysql_query("SELECT * FROM Usuario where idUsuario='$objResgate->idUsuario'"));
$objPremio = mysql_fetch_object(mysql_query("SELECT * FROM Premio where idPremio='$objResgate->idPremio'"));
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
                    <h4>Recibo de Resgate para <?php echo $objAmigo->nome ?></h4>
                    <br/>
                    <div class="pull-left">
                        <p>Resgate efetuado para <b><?php echo $objAmigo->nome ?></b>, no dia <b><?php echo $objResgate->data ?></b>.
                            <br/>
                            Prêmio Solicitado: <?php echo $objPremio->nome; ?> .
                            <br/>
                            Pontos Usados: <?php echo $objPremio->valor; ?> pontos .
                            <br/>
                            Pontuação Anterior: <?php echo $objPremio->valor + $objAmigo->pontuacao; ?> pontos .
                            <br/>
                            Pontuação Atual: <?php echo $objAmigo->pontuacao; ?> pontos .
                            <br/>
                            Resgate Efetuado por: <?php echo $objUsuario->nome; ?> .
                        </p>	
                    </div>
                    <div class="pull-right" style="width: 326px;">
                        <a class="btn btn-primary" type="button" target="_blank" href="../recibos/solicitarResgate.php?idResgate=<?php echo base64_encode($objResgate->idResgate) ?>"><div class="glyphicon glyphicon-download-alt"></div>&nbsp;&nbsp;Fazer Download do Recibo!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>