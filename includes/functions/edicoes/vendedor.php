<?php
include ("../../seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
// Chama a função que protege a página
echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' />";
//Inclusao e inicio da conexao com o DB.
include ("../../conectar.php");
mysql_select_db($basedados, $conexao);

$idUsuario = $_GET['id'];
$UsuarioVendedor = $_POST['usuarioVendedor'];
$SenhaVendedor = $_POST['senhaVendedor'];
$NomeVendedor = $_POST['nomeVendedor'];

mysql_query("UPDATE Usuario set usuario='$UsuarioVendedor', senha='$SenhaVendedor', nome='$NomeVendedor' WHERE idUsuario='$idUsuario';") or die(mysql_error());

header("Location: ../../../painel/gerente/listarVendedores.php?pagina=1");
mysql_close($conexao);
exit();
?>