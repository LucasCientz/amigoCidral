<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Editar Amigo";
$Sub = 2;
require_once '../../includes/requires/header.php';
//Pega dados para ediçao
$idAmigo = $_GET['id'];
$resultado = mysql_query("SELECT * FROM `Amigo` where idAmigo='$idAmigo'");
$obj = mysql_fetch_object($resultado);
?>
<script>
    $(document).ready(function() {
        $("#btn_listar-Gerente").addClass("active");
        $("#listarAmigo").addClass("active");
    });
</script>
<body>
    <div class="wrap">
        <div class="PagePainel">
            <?php
            require_once 'requires/topoPainel_gerente.php';
            ?>
            <div class="ContentPainel">
                <div class="content-inner">
                    <h4>Editar Amigo</h4>
                    <div class="pull-left">
                        <form class="form-horizontal" role="form" method="post" action="../../includes/functions/edicoes/amigo.php?id=<?php echo $idAmigo ?>">

                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nomeAmigo" value="<?php echo $obj->nome ?>" style="width: 500px" required="true">
                            </div>
                            <div class="form-group">
                                <label>Endereço</label>
                                <input type="text" class="form-control" name="enderecoAmigo" value="<?php echo $obj->endereco ?>"  style="width: 500px">
                            </div>
                            <div class="form-group">
                                <label>Contato</label>
                                <input type="text" class="form-control" name="contatoAmigo" value="<?php echo $obj->contato ?>" style="width: 250px">
                            </div>
                    </div>
                    <div class="pull-right">
                        <div class="form-group">
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" class="form-control" name="cpfAmigo" value="<?php echo $obj->cpf ?>" style="width: 250px" required="true">
                            </div>
                            <div class="form-group">
                                <label>Profissão</label>
                                <input type="text" class="form-control" name="profissaoAmigo" value="<?php echo $obj->profissao ?>"  style="width: 250px" required="true">
                            </div>
                            <br/><br/>
                            <div class="form-group">
                                <a class="btn btn-default" onclick="return confirmar();" href="listarAmigos.php?pagina=1"> Cancelar e Voltar </a>
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;Salvar
                                </button>
                            </div>
                            <label>Pontos: 
                                <?php
                                if ($obj->pontuacao == 0) {
                                    echo "0";
                                } else {
                                    echo $obj->pontuacao;
                                }
                                ?>
                            </label>
                        </div>
                        <div class="form-group">
                            <?php
                            //Verificar quem foi o Usuário que criou o Amigo.
                            $idUsuario = $obj->idUsuario;
                            $resultadoUsuario = mysql_query("SELECT * FROM `Usuario` where idUsuario='$idUsuario'");
                            $objUsuario = mysql_fetch_object($resultadoUsuario);
                            echo "<label>Amigo criado por : <i>$objUsuario->nome</i></label>";
                            ?>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>