<?php
include_once("cabecera.html");
include_once("menu.php");

session_start()
	?>
<div  style="display: flex;">
	<?php include_once("aside.html"); ?>
	<section style="flex: 3;">
		<h1>Error</h1>
		<h4><?php echo ((isset($_REQUEST["sError"])) ? $_REQUEST["sError"] : "Otro error"); ?></h4>
		<?php
		if (isset($_SESSION["usuario"])) {
			?>
			<a href="inicio.php">Regresar al inicio</a>
			<?php
		} else {
			?>
			<a href="index.php">Regresar al inicio</a>
			<?php
		}
		?>
	</section>
</div>
<?php
include_once("pie.html");
?>