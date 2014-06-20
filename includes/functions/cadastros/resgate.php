<?php
include ("../../seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
// Chama a função que protege a página
echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' />";
//Inclusao e inicio da conexao com o DB.
include ("../../conectar.php");

mysql_select_db($basedados, $conexao);
//Pegando dados básicos
$idUsuario = $_GET['idUsuario'];
$idAmigo = $_GET['idAmigo'];
$idPremio = $_GET['idPremio'];
$dataResgate = date("d/m/Y");
$status = 0;
//Idenficação de Dados
//Usuario
$queryUsuario = mysql_query("SELECT * FROM Usuario where idUsuario='$idUsuario'");
$objUsuario = mysql_fetch_object($queryUsuario);
//Premio
$queryPremio = mysql_query("SELECT * FROM Premio where idPremio='$idPremio'");
$objPremio = mysql_fetch_object($queryPremio);
//Amigo
$queryAmigo = mysql_query("SELECT * FROM Amigo where idAmigo='$idAmigo'");
$objAmigo = mysql_fetch_object($queryAmigo);
$NovosPontos = $objAmigo -> pontuacao - $objPremio -> valor;

//Inserir na tabela Resgate
mysql_query("INSERT INTO Resgate(idPremio, idAmigo, idUsuario, data, status)VALUES('$idPremio','$idAmigo','$idUsuario','$dataResgate','$status')");
mysql_query("UPDATE Amigo set pontuacao='$NovosPontos' WHERE idAmigo='$idAmigo';") or die(mysql_error());

$queryResgate = mysql_query("SELECT * FROM Resgate ORDER BY idResgate DESC LIMIT 1");
$objResgate = mysql_fetch_object($queryResgate);

$encode = base64_encode($objResgate -> idResgate);

if ($objUsuario -> tipo == 2) {
	header("Location: ../../../painel/gerente/reciboResgate.php?idResgate=$encode");
} else {
	header("Location: ../../../painel/vendedor/reciboResgate.php?idResgate=$encode");
}

mysql_close($conexao);
exit();
?>