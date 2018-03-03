<?php
require_once 'classes\ConexionBD.php';
$title = 'ElectroShop - Tu tienda online';
require_once 'head.php';

$conexion = new ConexionBD();

// PROCESAR DATOS PARA EL INICIO DE SESION
if (isset($_POST["username"]) && isset($_POST["password"])) {
	$login = $conexion->loginUser($_POST["username"], $_POST["password"]);
} elseif (isset($_SESSION["cliente"])) {
	// SI YA SE HA INICIADO SESION
	$login = true;
} else {
	$login = false;
}

// VERIFICAR INICIO DE SESION
if (!$login) {
	echo "<div class='error'>Debe iniciar sesión para ver esta página</div>";
} else {
	$cliente = $_SESSION["cliente"];
?>

<body>
	<?php require_once 'menu.php' ?>
  	<div class="content">
  	<?php 
  	$conexion = new ConexionBD();
  	$listaProd = $conexion->listarProductos();
  	for ($i = 0; $i < count($listaProd); $i++) {
  		$producto = $listaProd[$i];
  	?>
  		<!-- CONTENEDOR DE CADA PRODUCTO -->
		<div class="cont-prod">
			<div class="img-prod">
				<img alt="Producto" src="img/<?php echo $producto->getImg()?>">
			</div>
			<div class="tit-prod"><strong><?php echo $producto->getNombre()?></strong></div>
			<div class="des-prod"><?php echo $producto->getDescripcion()?></div>
			<div class="price-buy">
				<span>Precio: <?php echo number_format((float)$producto->getPrecio(),2,',','.')."€" ?></span>
				<?php if ($producto->getStock() > 0 ) {?>
				<!-- VERIFICAR STOCK -->
				<form class="buy-form" action="cart.php">
					<input type="hidden" name="id_producto" value="<?php echo $producto->getId() ?>">
					<button class="button">Comprar</button>
				</form>
				<?php } else {echo "<span class='no-stock' >No disponible</span>";}?>
			</div>
		</div>
	<?php 
  	}
	?>
	</div>
</body>
</html>
<?php
}
?>