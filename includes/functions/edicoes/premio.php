<?php
include ("../../seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
// Chama a função que protege a página
echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' />";
//Inclusao e inicio da conexao com o DB.
include ("../../conectar.php");
mysql_select_db($basedados, $conexao);
$idPremio = $_GET['id'];
//Pegando dados básicos
$NomePremio = $_POST['nomePremio'];
$EstoquePremio = $_POST['estoquePremio'];
$ValorPremio = $_POST['valorPremio'];
$DescricaoPremio = $_POST['descricaoPremio'];
$trimimg = str_replace(" ", "", strtolower($_FILES["imagemPremio"]["name"]));

if ($trimimg == "") {
	mysql_query("UPDATE Premio set nome='$NomePremio', valor='$ValorPremio', estoque='$EstoquePremio', descricao='$DescricaoPremio' WHERE idPremio='$idPremio';") or die(mysql_error());
} else {
	mysql_query("UPDATE Premio set nome='$NomePremio', valor='$ValorPremio', estoque='$EstoquePremio', descricao='$DescricaoPremio', imagem='$trimimg' WHERE idPremio='$idPremio';") or die(mysql_error());
	move_uploaded_file($_FILES["imagemPremio"]["tmp_name"], "../../../imagens/miniaturas/" . $trimimg);
}

header("Location: ../../../painel/gerente/listarPremios.php?pagina=1");

mysql_close($conexao);
exit();
?>