<?php
include ("../../includes/seguranca.php");
include ("../../includes/conectar.php");
mysql_select_db($basedados, $conexao);
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Painel Vendedor";
$Sub = 2;
require_once '../../includes/requires/header.php';

//Querys Gerais
$QueryTotalVendas = mysql_query("SELECT * FROM Venda");
$QueryTotalAmigos = mysql_query("SELECT * FROM Amigo");
$QueryTotalPremios = mysql_query("SELECT * FROM Premio");
$QueryTotalResgates = mysql_query("SELECT * FROM Resgate");
$QueryTotalVendedor = mysql_query("SELECT * FROM Usuario where tipo='3'");

//Querys de Resgates
$QueryResgatesPendentes = mysql_query("SELECT * FROM Resgate where status='0'");
$QueryResgatesConcluidos = mysql_query("SELECT * FROM Resgate where status='1'");
$QueryResgatesBloqueados = mysql_query("SELECT * FROM Resgate where status='3'");

//Contadores de Resgates
$ContResgatesPendentes = mysql_num_rows($QueryResgatesPendentes);
$ContResgatesConcluidos = mysql_num_rows($QueryResgatesConcluidos);
$ContResgatesBloqueados = mysql_num_rows($QueryResgatesBloqueados);

//Contadores Gerais
$ContVendasTotal = mysql_num_rows($QueryTotalVendas);
$ContAmigosTotal = mysql_num_rows($QueryTotalAmigos);
$ContPremiosTotal = mysql_num_rows($QueryTotalPremios);
$ContResgatesTotal = mysql_num_rows($QueryTotalResgates);
$ContVendedoresTotal = mysql_num_rows($QueryTotalVendedor);

//Ultimos Objetos no banco
$ObjLastAmigo = mysql_fetch_object(mysql_query("SELECT * FROM Amigo ORDER BY idAmigo DESC LIMIT 1"));
$ObjLastResgate = mysql_fetch_object(mysql_query("SELECT * FROM Resgate ORDER BY idResgate DESC LIMIT 1"));
$ObjLastAmigoResgate = mysql_fetch_object(mysql_query("SELECT * FROM Amigo where idAmigo='$ObjLastResgate->idAmigo'"));
$ObjLastPremioResgate = mysql_fetch_object(mysql_query("SELECT * FROM Premio where idPremio='$ObjLastResgate->idPremio'"));

//Top Listagem
$ObjMaxAmigoPontuacao = mysql_fetch_object(mysql_query("SELECT * FROM Amigo ORDER BY pontuacao DESC LIMIT 1"));
?>
<script>
    $(document).ready(function() {
        $("#btn_home-Gerente").addClass("active");
    });
</script>
<style>
    .ContentPainel {
        margin-left: 10px !important;
    }
</style>
<body>
    <div class="wrap">
        <div class="PagePainel">
            <?php
            require_once 'requires/topoPainel_vendedor.php';
            ?>
            <div class="ContentPainel">
                <h3>Dashboard</h3>
                <br />
                <div class="well dashPainel">
                    <h4>Contagem de dados</h4>
                    <ul>
                        <li>Total de Vendas Cadastradas: <span><?php echo $ContVendasTotal ?></span></li>
                        <li>Total de Amigos Cadastrados: <span><?php echo $ContAmigosTotal ?></span></li>
                        <li>Total de Prêmios Cadastrados: <span><?php echo $ContPremiosTotal ?></span></li>
                        <li>Total de Resgates Cadastrados: <span><?php echo $ContResgatesTotal ?></span></li>
                        <li>Total de Vendedores: <span><?php echo $ContVendedoresTotal ?></span></li>
                        <br/>
                        <li>Total de Resgates Pendentes: <span><?php echo $ContResgatesPendentes ?></span></li>
                        <li>Total de Resgates Bloqueados: <span><?php echo $ContResgatesBloqueados ?></span></li>
                        <li>Total de Resgates Concluídos: <span><?php echo $ContResgatesConcluidos ?></span></li>
                    </ul>
                </div>
                <div class="well dashPainel lastCadastros">
                    <h4>Últimos Cadastros</h4>
                    <ul>
                        <li>Último Amigo Cadastrado: <span><i><?php echo $ObjLastAmigo->nome ?></i></span></li>
                        <li>Último Resgate feito para: <span><i><?php echo $ObjLastAmigoResgate->nome ?></i></span></li>
                        <li>Ultima Solicitação de Resgate: <span><i><?php echo $ObjLastPremioResgate->nome ?></i></span></li>
                    </ul>
                    <br/>
                    <h4>Top Pontuação: <i><?php echo "$ObjMaxAmigoPontuacao->nome - $ObjMaxAmigoPontuacao->pontuacao pontos. " ?></i></h4>
                </div>
            </div>
        </div>
    </div>
</body>
</html>