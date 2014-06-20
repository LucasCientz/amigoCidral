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
$NomeAmigo = $_POST['nomeAmigo'];
$ContatoAmigo = $_POST['contatoAmigo'];
$EnderecoAmigo = $_POST['enderecoAmigo'];
$CPFAmigo = $_POST['cpfAmigo'];
$profissaoAmigo = $_POST['profissaoAmigo'];
$IdUsuario = $_POST['idUsuario'];

mysql_query("INSERT INTO Amigo(idUsuario, nome, contato, endereco, cpf, profissao)VALUES('$IdUsuario','$NomeAmigo','$ContatoAmigo','$EnderecoAmigo','$CPFAmigo','$profissaoAmigo')");

header("Location: ../../../painel/vendedor/listarAmigos.php?pagina=1");
mysql_close($conexao);
exit();
?>