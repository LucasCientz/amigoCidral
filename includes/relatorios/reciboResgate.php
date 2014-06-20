<?php
include ("../seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
// Chama a função que protege a página
echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' />";
//Inclusao e inicio da conexao com o DB.
require_once ("../dompdf/dompdf_config.inc.php");
include ("../conectar.php");
date_default_timezone_set('America/Sao_Paulo');
mysql_select_db($basedados, $conexao);

$idResgate = $_GET['idResgate'];
$queryResgate = mysql_query("SELECT * FROM `Resgate` where idResgate='$idResgate'");
$objResgate = mysql_fetch_object($queryResgate);

$objAmigo = mysql_fetch_object(mysql_query("SELECT * FROM Amigo where idAmigo='$objResgate->idAmigo'"));
$objUsuario = mysql_fetch_object(mysql_query("SELECT * FROM Usuario where idUsuario='$objResgate->idUsuario'"));
$objPremio = mysql_fetch_object(mysql_query("SELECT * FROM Premio where idPremio='$objResgate->idPremio'"));

$html = "<html><head><meta http-equiv='content-type' content='text/html;charset=utf-8' /></head><body>";

$html .= "
 <img width='150' src='../../imagens/logoCidral.png'/>
 <h4>Eu, $objUsuario->nome declaro que efetuei o resgate do prêmio $objPremio->nome para
 $objAmigo->nome, cliente cadastrado no sistema Amigo Cidral, no dia  $objResgate->data.</h4>
 ";

$html .= "</body></html>";

$dompdf = new DOMPDF();
$dompdf -> load_html($html);
$dompdf -> render();
$dompdf -> stream("$objAmigo->nome.pdf");
?>