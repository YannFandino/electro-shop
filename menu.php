<header>
<nav class="menu-bar">
<img class="logo-menu" alt="Logo" src="img/eslogo_w.png">
<div class="items-menu">
<div class="menu-item">Bienvenido, <b><?php echo $cliente->getUsername();?></b></div>
			<div class="menu-item">
				<a href="cart.php"><span class="fa-stack fa-lg">
			    	<i class="fa fa-square fa-stack-2x"></i>
					<i class="fa fa-shopping-cart fa-stack-1x"></i>
				</span></a>
			</div>
			<div class="menu-item button logout"><a href="controlador.php?accion=logout">Cerrar sesión</a></div>
		</div>
	</nav>
</header>
<script>
	// SIMULAR HOVER EN ICONO FONT AWESOME
	$(".fa-shopping-cart").mouseover(function() {
		$(".fa-square").css({
				            "color":"#F10020",
				            "box-shadow": "0px 1px 1px 0px white"});
	});
	$(".fa-shopping-cart").mouseout(function() {
		$(".fa-square").css({
				            "color":"#F20052",
				            "box-shadow": "none"});
	});
</script>