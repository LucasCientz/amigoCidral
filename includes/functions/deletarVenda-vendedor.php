<?php
echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' />";
include ("../conectar.php");
include ("../seguranca.php");
require_once ('../email/class.phpmailer.php');
// Inclui o arquivo com o sistema de segurança
protegePagina();
// Chama a função que protege a página

mysql_select_db($basedados, $conexao);
$idAmigo = $_GET['idAmigo'];
$idUsuario = $_GET['idUsuario'];
$idVenda = $_GET['idVenda'];


$objAmigo = mysql_fetch_object(mysql_query("SELECT * FROM Amigo where idAmigo='$idAmigo'"));
$objUsuario = mysql_fetch_object(mysql_query("SELECT * FROM Usuario where idUsuario='$idUsuario'"));
$objVenda = mysql_fetch_object(mysql_query("SELECT * FROM Venda where idVenda='$idVenda'"));
$objUsuVenda = mysql_fetch_object(mysql_query("SELECT * FROM Usuario where idUsuario='$objVenda->idUsuario'"));

$mailer = new PHPMailer();
$mailer -> IsSMTP();
$mailer -> SMTPDebug = 1;
$mailer -> Port = 465;
$mailer -> Host = 'ssl://smtp.gmail.com';
$mailer -> SMTPAuth = true;
$mailer -> Username = 'web@cientz.com.br';
$mailer -> Password = 'cientz_wd345*';
$mailer -> FromName = 'Contato';
$mailer -> From = 'web@cientz.com.br';
$mailer -> AddCustomHeader("Content-type: text/html; charset=utf-8\r\n");
$mailer -> AddAddress('web@cientz.com.br', 'Pedido de Remoção de Venda - Amigo Cidral'); //Destinatario.
$mailer -> Subject = 'Pedido para remover uma venda - Amigo Cidral';
$mailer -> Body = "
<h2>Pedido de Remoção de Venda - Amigo Cidral</h2>
<br/>
<b>$objUsuario->nome</b> fez o pedido para remover o registro da venda correspondente ao Id: $objVenda->idVenda, ligada
ao amigo(a) <b>$objAmigo->nome</b> do programa Amigo Cidral.
<br/><br/>
<h2>
Detalhes da Venda:
<br/><br/>
Nota Fiscal: $objVenda->notaFiscal
<br/>
Valor: $objVenda->valor
<br/>
Valor em pontos:  $objVenda->valorPontos
<br/>
Efetuada por: $objUsuVenda->nome
<br/>
Data: $objVenda->data
</h2>
<br/><br/>
<a href='#' target='_blank'>Clique aqui para ir para o painel</a>
";

if (!$mailer -> Send()) {
	echo "<script type='text/javascript'>javascript:history.go(-1)</script>";
} else {
	echo "<script type='text/javascript'>javascript:history.go(-1)</script>";
}

mysql_close($conexao);
exit();
?>