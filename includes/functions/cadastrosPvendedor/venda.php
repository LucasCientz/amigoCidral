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
$idAmigo = $_POST['idAmigo'];
$resultado = mysql_query("SELECT * FROM `Amigo` where idAmigo='$idAmigo'");
$obj = mysql_fetch_object($resultado);

$NotaFiscal = $_POST['notaFiscal'];
$idUsuario = $_POST['idUsuario'];
$DataVenda = $_POST['dataVenda'];
$ValorNotaFiscal = $_POST['valorNotaFiscal'];
$ValorPontos = $_POST['valorNotaFiscal'] / 100;
$NovosPontos = $obj -> pontuacao + $ValorPontos;

$queryFiscal = mysql_query("SELECT * FROM `Venda` where notaFiscal='$NotaFiscal'");
$contDados = mysql_num_rows($queryFiscal);

if ($contDados > 0) {
	echo "<script type='text/javascript'>alert ('Nota Fiscal já cadastrada, tente novamente!')</script>";
	echo "<script type='text/javascript'>javascript:history.go(-1)</script>";
} else {
	//Atribuindo nova pontuacao
	mysql_query("INSERT INTO Venda(idAmigo, idUsuario, notaFiscal, valor, data, valorPontos)VALUES('$idAmigo','$idUsuario','$NotaFiscal','$ValorNotaFiscal','$DataVenda','$ValorPontos')");
	//Criando nova Venda
	mysql_query("UPDATE Amigo set pontuacao='$NovosPontos' WHERE idAmigo='$idAmigo';") or die(mysql_error());
	echo "<script type='text/javascript'>alert ('Venda Atribuida com Sucesso!')</script>";
	header("Location: ../../../painel/vendedor/listarVendas.php?pagina=1");
}
mysql_close($conexao);
exit();
?>