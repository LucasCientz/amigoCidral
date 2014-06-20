<?php
echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' />";
include ("conectar.php");
include ("seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
// Chama a função que protege a página

$idUsuario = $_GET['idUsuario'];
$idPremio = $_GET['idPremio'];
$idAmigo = $_GET['idAmigo'];
$resultadoPremio = mysql_query("SELECT * FROM `Premio` where idPremio='$idPremio'");
$obj = mysql_fetch_object($resultadoPremio);
mysql_select_db($basedados, $conexao);

mysql_query("DELETE from `Usuario` where idUsuario = '$idUsuario'");
mysql_query("DELETE from `Premio` where idPremio = '$idPremio'");
mysql_query("DELETE from `Amigo` where idAmigo = '$idAmigo'");

unlink("../imagens/miniaturas/$obj->imagem");
echo "<script type='text/javascript'>javascript:history.go(-1)</script>";
mysql_close($conexao);
exit();
?>