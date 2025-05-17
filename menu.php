<nav>
	<?php
	if (isset($_SESSION["type_usr"])) {
		if ($_SESSION["type_usr"]) {
		}
		?>
		<ul>
			<li><a href="inicio.php" class="menu">Inicio</a></li>
			<li><a href="tabcontac.php" class="menu">Contactos</a></li>
			<li><a href="logout.php" class="menu">Salir</a></li>
		</ul>

		<?php
	}
	?>
</nav>