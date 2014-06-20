<?php
include ("../../seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
// Chama a função que protege a página
echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' />";
//Inclusao e inicio da conexao com o DB.
include ("../../conectar.php");
mysql_select_db($basedados, $conexao);
$idAmigo = $_GET['id'];
//Pegando dados básicos
$NomeAmigo = $_POST['nomeAmigo'];
$ContatoAmigo = $_POST['contatoAmigo'];
$EnderecoAmigo = $_POST['enderecoAmigo'];
$profissaoAmigo = $_POST['profissaoAmigo'];
$CPFAmigo = $_POST['cpfAmigo'];

mysql_query("UPDATE Amigo set nome='$NomeAmigo', contato='$ContatoAmigo', endereco='$EnderecoAmigo', cpf='$CPFAmigo', profissao='$profissaoAmigo' WHERE idAmigo='$idAmigo';") or die(mysql_error());

header("Location: ../../../painel/gerente/listarAmigos.php?pagina=1");
mysql_close($conexao);
exit();
?>