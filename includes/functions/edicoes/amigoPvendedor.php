<?php
include ("../../seguranca.php");
include ("../../conectar.php");
require_once ('../../email/class.phpmailer.php');
// Inclui o arquivo com o sistema de segurança
protegePagina();
// Chama a função que protege a página
echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' />";
//Inclusao e inicio da conexao com o DB.

mysql_select_db($basedados, $conexao);
$idAmigo = $_GET['idAmigo'];
$idUsuario = $_GET['idUsuario'];
//Pegando dados básicos
$NomeAmigo = $_POST['nomeAmigo'];
$ContatoAmigo = $_POST['contatoAmigo'];
$EnderecoAmigo = $_POST['enderecoAmigo'];
$profissaoAmigo = $_POST['profissaoAmigo'];
$CPFAmigo = $_POST['cpfAmigo'];

$objAmigo = mysql_fetch_object(mysql_query("SELECT * FROM Amigo where idAmigo='$idAmigo'"));
$objUsuario = mysql_fetch_object(mysql_query("SELECT * FROM Usuario where idUsuario='$idUsuario'"));

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
$mailer -> AddAddress('web@cientz.com.br', 'Pedido de Remoção de Cliente - Amigo Cidral');
//Destinatario.
$mailer -> Subject = 'Pedido para editar cliente - Amigo Cidral';
$mailer -> Body = "
<h2>Pedido de Remoção de Cliente - Amigo Cidral</h2>
<br/>
<b>$objUsuario->nome</b> fez o pedido para editor o registro do cliente <b>$objAmigo->nome</b> do programa Amigo Cidral.
<br/><br/>
Segue os novos dados para atualização:
<br/><br/>
<h2>
Nome: $NomeAmigo
<br/>
Contato: $ContatoAmigo
<br/>
Endereço: $EnderecoAmigo
<br/>
Profissão: $profissaoAmigo
<br/>
CPF: $CPFAmigo
</h2>
<br/><br/>
<a href='#' target='_blank'>Clique aqui para ir para o painel</a>
";
if (!$mailer -> Send()) {
	echo "<script type='text/javascript'>alert ('Erro no envio!')</script>";
	header("Location: ../../../painel/vendedor/listarAmigos.php?pagina=1");
} else {
	echo "<script type='text/javascript'>alert ('Email enviado ao gerente com sucesso! Aguarde contato.')</script>";
	header("Location: ../../../painel/vendedor/listarAmigos.php?pagina=1");
}
mysql_close($conexao);
exit();
?>