<?php
include_once("modelo\Usuario.php");
session_start();
$sErr = "";
$sNom = "";
$sTipo = "";
$oUsu = new Usuario();

if (isset($_SESSION["usuario"])) {
	$oUsu = $_SESSION["usuario"];
	$sNom = $oUsu->getName();
	$sTipo = $_SESSION["type_usr"];
} else
	$sErr = "Debe estar firmado";

if ($sErr == "") {
	include_once("cabecera.html");
	include_once("menu.php");
} else {
	header("Location: error.php?sErr=" . $sErr);
	exit();
}
?>
<div style="display: flex;">
	<?php include_once("aside.html"); ?>
	<main id="inicio">
		<section>
			<h1>Bienvenido <?php echo $sNom; ?></h1>
			<h3>Eres tipo <?php echo $sTipo; ?></h3>
			<?php
			if ($sTipo == "admin") {
				echo '<img src="./media/admin.jpg" alt="Administrador" style="width: 40em; height: 20em;">';
			} elseif ($sTipo == "viewer") {
				echo '<img src="./media/viewer.jpg" alt="Viewer" style="width: 40em; height: 20em;">';
			}
			?>
		</section>
	</main>
</div>
<?php
include_once("pie.html");
?>