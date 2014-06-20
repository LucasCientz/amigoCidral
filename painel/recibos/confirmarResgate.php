<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Confirmar Resgare";
$Sub = "Recibo";
require_once '../../includes/requires/header.php';
//Pega dados para ediçao
$idResgate = $_GET['idResgate'];
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
<style>
	.body {
		background-color: #fff !important;
	}
	.wrap {
		width: 960px !important;
		margin: 0 auto !important;
	}
	.wrap img {
		position: relative;
		left: 35%;
	}
</style>
<body>
	<?php
	$PontuacaoAnterior = $objPremio -> valor + $objAmigo -> pontuacao;
	?>
	<div class="wrap">
		<br/>
		<img src="logoCidral.png" />
		<br/>
		<br/>
		<br/>
		<br/>
		<h3 style="text-align:center;">Recibo de Confirmação de Resgate</h3>
		<p style="font-size: 20px;">Amigo Cidral: <b><?php echo $objAmigo->nome ?></b>.
		<br/>
		Prêmio Solicitado: <b><?php echo $objPremio -> nome; ?> </b>.
		<br/>
		Resgate Efetuado por: <b><?php echo $objUsuario -> nome; ?> </b>.
		<br/>
		Data: <b><?php echo $objResgate -> data; ?> </b>.
		<br/><br/><br/>
		Pontos Usados: <b><?php echo $objPremio -> valor; ?> pontos </b>.
		<br/>
		Pontuação Anterior: <b><?php echo $objPremio -> valor + $objAmigo -> pontuacao; ?> pontos </b>.
		<br/>
		</p>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<div id="assinatura">
			<div style="float:left;" id="boxleft">
				______________________________________
				<br/>
				<span>Assinatura do Gerente</span>
			</div>
			<div style="clear:both"></div>
			<div style="float:right; position: relative; bottom: 38px;" id="boxright">
				______________________________________
				<br/>
				<span>Assinatura do Cliente</span>
			</div>
		</div>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<span style="width:100px;margin:0 auto;">Desenvolvido por Cientz Comunicação</span>
		<br/><br/>
		<div style="width: 326px;">
			<a class="btn btn-primary" type="button" onclick="self:print()">Imprimir!</a>
		</div>
		<br/>
	</div>
</body>
</html>