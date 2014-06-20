<?php

echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' />";
// Inclui o arquivo com o sistema de segurança
include ("conectar.php");
include ("seguranca.php");
mysql_select_db($basedados, $conexao);
// Chama a função que protege a página
protegePagina();
//Pegando os ids necessários para fazer a açao
$idVenda = $_GET['idVenda'];
$idAmigo = $_GET['idAmigo'];
//Querys de Select e criaçao de Objetos para o uso
$resultadoVenda = mysql_query("SELECT * FROM `Venda` where idVenda='$idVenda'");
$objVenda = mysql_fetch_object($resultadoVenda);
$resultadoAmigo = mysql_query("SELECT * FROM `Amigo` where idAmigo='$idAmigo'");
$objAmigo = mysql_fetch_object($resultadoAmigo);
//Subtraçao para os novos pontos do Amigo
$ValorPontos = $objVenda->valorPontos;
$NovosPontos = $objAmigo->pontuacao - $ValorPontos;
//Query de Atualizaçao dos novos pontos
mysql_query("UPDATE Amigo set pontuacao='$NovosPontos' WHERE idAmigo='$idAmigo';") or die(mysql_error());
//Query para deletar a Venda
mysql_query("DELETE from `Venda` where idVenda = '$idVenda'");
//Finalizaçao
echo "<script type='text/javascript'>javascript:history.go(-1)</script>";
mysql_close($conexao);
exit();
?>