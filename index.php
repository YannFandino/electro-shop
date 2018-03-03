<?php
	session_start();
	$title = 'Inicio - ElectroShop';
	require_once 'head.php';
?>

<body>
	<div class="login-cont">
		<img class="logo-img" alt="Logo" src="img/eslogo_w.png">
		<form class="login-form" action="ver_productos.php"  method="post">
			<input class="input" type="text" name="username" placeholder="Usuario"><br>
			<input class="input" type="password" name="password" placeholder="Contraseña"><br>
			<?php
			// Mostrar errores si falla el inicio de sesion
			if (isset($_SESSION["error_login"]) && $_SESSION["error_login"] == 'Error 1') {
				echo "<div>El usuario o contraseña no coincide</div>";
			} elseif (isset($_SESSION["error_login"]) && $_SESSION["error_login"] == 'Error 2') {
				echo "<div>No existe el nombre de usuario</div>";
			}
			$_SESSION["error_login"] = null;
			?>
			<button class="button">Entrar</button><br>
			<div style="text-align: right">¿No tienes una cuenta? <a href="registro.php">Regístrate</a></div>
		</form>
	</div>
</body>
</html>