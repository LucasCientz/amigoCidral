<?php
// Inclui o arquivo com o sistema de segurança
include ("seguranca.php");
include ("contectar.php");
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Salva duas variáveis com o que foi digitado no formulário
    // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
    $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
    // Utiliza uma função criada no seguranca.php pra validar os dados digitados
    if (validaUsuario($usuario, $senha) == true) {
        // O usuário e a senha digitados foram validados, manda pra página interna
        mysql_select_db($basedados, $conexao);
        $resultado = mysql_query("SELECT * FROM `Usuario` where usuario='$usuario'");
        $obj = mysql_fetch_object($resultado);
        //Faz consulta ao banco de dados no usuário recem cadastrado e armazena os dados em Objeto.
        if ($obj->tipo == 1) {
            header("Location: ../painel/admin/");
        } elseif ($obj->tipo == 2) {
            header("Location: ../painel/gerente/");
        } elseif ($obj->tipo == 3) {
            header("Location: ../painel/vendedor/");
        } else {
            echo $MsgErroTipo;
        }
        //Verifica o Status do Usuário.
    } else {
        $MostrarMsg = true;
        // O usuário e/ou a senha são inválidos, manda de volta pro form de login
        // Para alterar o endereço da página de login, verifique o arquivo seguranca.php
        expulsaVisitante();
    }
}
?>