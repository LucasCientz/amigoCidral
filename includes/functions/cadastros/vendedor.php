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
$UsuarioVendedor = $_POST['usuarioVendedor'];
$SenhaVendedor = $_POST['senhaVendedor'];
$NomeVendedor = $_POST['nomeVendedor'];

mysql_query("INSERT INTO Usuario(usuario, senha, nome, tipo)VALUES('$UsuarioVendedor','$SenhaVendedor','$NomeVendedor','3')");

header("Location: ../../../painel/gerente/listarVendedores.php?pagina=1");
mysql_close($conexao);
exit();
?>