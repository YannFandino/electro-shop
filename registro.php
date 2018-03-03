<?php
use classes\Cliente;
require_once 'classes\ConexionBD.php';
$title = 'Registro de usuarios';
require_once 'head.php';
if (!isset($_POST['username'])) {
	// Mostrar formulario
?>

<body>
	<div class="login-cont">
		<img class="logo-img" alt="Logo" src="img/eslogo_w.png">
		<form class="login-form" action="registro.php" method="post">
			<input class="input" type="text" name="username" placeholder="Usuario"><br>
			<input class="input" type="password" name="password" placeholder="Contraseña"><br>
			<input class="input" type="password" name="confirmpass" placeholder="Confirmar contraseña"><br>
			<?php 
			// Mostrar error en caso de fallar la coincidencia de la contraseña
			if (isset($_SESSION["password_error"]) && $_SESSION["password_error"] == true) {
				echo "<div style='text-align: right'> La contraseña no coincide</div>";
			}
			?>
			<button class="button" type="submit">Registrar</button>
			<a style="text-decoration: none" class="button" href="index.php">Cancelar</a><br>
		</form>
	</div>
<?php 
} else {
	// Procesar datos del formulario
	$_SESSION["password_error"] = false;
	$conexion = new ConexionBD();
	$cliente = new Cliente($_POST["username"]);
	// Verificar que las contraseñas sean iguales
	if ($_POST["password"] == $_POST["confirmpass"]) {
		
		$cliente->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
		$registrado = $conexion->registerUser($cliente);
		// Verificar que se ha registrado el usuario correctamente
		if ($registrado) {
			$_SESSION["password_error"] = false;
			header('Location: index.php');
		} else {
			echo "<a style='margin-left:10%' href='registro.php'>Volver</a>";
		}
	} else {
		$_SESSION["password_error"] = true;
		header("Refresh:0");
	}
	$conexion->close_conn();
}
?>
</body>
</html>