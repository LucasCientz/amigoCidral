<?php
$TituloSub = "Amigo Cidral";
$Sub = 1;
require_once '../includes/requires/header.php';
?>
<body>
	<div class="wrap">
		<div class="ContentLogin">
			<div class="pull-left">
				<div id="formAuth">
					<br/>
					<form class="form-horizontal" name="FormFarmacia" role="form" method="post" action="../includes/valida.php">
						<div class="form-group">
							<label>Login</label>
							<input type="text" class="form-control" name="usuario" placeholder="Isira seu Login" style="width: 350px">
						</div>
						<div class="form-group">
							<label>Senha</label>
							<input type="password" class="form-control" name="senha" placeholder="Senha" style="width: 350px">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-default">
								Entrar
							</button>
						</div>
					</form>
				</div>
			</div>
			<div class="pull-right logo">
				<a href="../"><img src="../imagens/LogoCidral.png"/></a>
			</div>
		</div>
		<?php if($_GET['auth'] == 'erro') :
		?>
		<br/>
		<div style="width: 269px; position: relative; margin:0 auto; bottom: 175px;" class="alert alert alert-danger fade in">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
				×
			</button>
			<b>Opa!</b> Login ou senha incorretos.
		</div>
		<br/>
		<?php endif; ?>
	</div>
</body>
</html>