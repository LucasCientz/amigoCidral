<?php
include ("../../seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
// Chama a função que protege a página
echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' />";
//Inclusao e inicio da conexao com o DB.
include ("../../conectar.php");
mysql_select_db($basedados, $conexao);
$idResgate = $_GET['idResgate'];
$AlterFrom = $_GET['alterar'];

if($AlterFrom == "pendente"){
	$status = 0;
}elseif($AlterFrom == "concluido"){
	$status = 1;
}elseif($AlterFrom == "bloqueado"){
	$status = 3;
}else{
	echo "Erro, volte a página.";
}

mysql_query("UPDATE Resgate set status='$status' WHERE idResgate='$idResgate'") or die(mysql_error());

echo "<script type='text/javascript'>javascript:history.go(-1)</script>";
mysql_close($conexao);
exit();
?>