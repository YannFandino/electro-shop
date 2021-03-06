<?php
require_once 'classes\ConexionBD.php';
session_start();


    $conexion = new ConexionBD();
	$accion = $_GET["accion"];
	
	// Borrar el carrito de compra.
	if ($accion == 'cancel') {
		unset($_SESSION["carrito"]);
		header("Location: ver_productos.php");
	}
	
	// Cerrar sesión.
	if ($accion == 'logout') {
		unset($_SESSION["carrito"]);
		unset($_SESSION["cliente"]);
		$conexion->close_conn();
		header("Location: index.php");
	}
	
	// Actualizar cantidad de un producto del carro - Combinación con AJAX. 
	if ($accion == 'updateCart') {
		$id = $_GET["id"];
		$cant = $_GET["cant"];
		$_SESSION["carrito"][$id]->setCantidad($cant);
	}
	
	// Actualizar la información del usuario.
	if ($accion == 'insertDatos') {
		$nombre = $_GET["nombre"];
		$apellidos = $_GET["apellidos"];
		$dni = $_GET["dni"];
		$email = $_GET["email"];
		$tel = $_GET["tel"];
		$profesion = $_GET["profesion"];
		$conexion->modificarDatos($_SESSION["cliente"], $nombre,
				                  $apellidos, $dni, $email, $tel, $profesion);
	}
	
	// Añadir direcciones si no se tienen.
	if ($accion == "insertDir") {
		$direccion = $_GET["direccion"];
		$ciudad = $_GET["ciudad"];
		$cp = $_GET["cp"];
		$esDeEnvio = $_GET["esDeEnvio"];
		$conexion->insertarDireccion($_SESSION["cliente"], $direccion, $ciudad, $cp, $esDeEnvio);		
	}
	
	// Modificar direcciones.
	if ($accion == "updateDir") {
		$direccion = $_GET["direccion"];
		$ciudad = $_GET["ciudad"];
		$cp = $_GET["cp"];
		$id = $_GET["id"];
		$tipo = $_GET["tipo"];
		$conexion->modificarDir($id, $direccion, $ciudad, $cp, $tipo);
	}
	
	// Al tramitar la compra se vuelcan los productos del carrito al resumen de la compra.
	if ($accion == "tramitarCompra") {
		$datosCompletos = $conexion->verifyDataUser($_SESSION["cliente"]);
		$dirCorrecta = $conexion->verificarDir($_SESSION["cliente"]);
		
		if ($datosCompletos && $dirCorrecta && isset($_SESSION["carrito"])) {
			$idFactura = $conexion->generarCompra($_SESSION["cliente"]);
			if ($idFactura) {
				header("Location: resumen.php?id=$idFactura");
				unset($_SESSION["carrito"]);
			} else {
				echo "El producto seleccionado no está disponible";
			}
		} elseif (!$datosCompletos) {
			echo "Debe rellenar sus datos.";
		} elseif (!$dirCorrecta) {
			echo "Debe tener una dirección de envío y una dirección de facturación.";
		}
	}	
?>