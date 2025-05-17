<?php
include_once("modelo\Contactos.php");
session_start();
$sErr = "";
$sOpe = "";
$sCve = "";
$sNomBoton = "Borrar";
$oCont = new Contacto();
$bCampoEditable = false;
$bLlaveEditable = false;

/*Verificar que haya sesión*/
if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
	/*Verificar datos de captura*/
	if (
		isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
		isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])
	) {
		$sOpe = $_POST["txtOpe"];
		$sCve = $_POST["txtClave"];
		if ($sOpe != 'a') {
			$oCont->setId($sCve);
			try {
				if (!$oCont->buscar()) {
					$sError = "Contacto no existe";
				}
			} catch (Exception $e) {
				error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
				$sErr = "Error: " . $e->getMessage();
			}
		}
		if ($sOpe == 'a') {
			$bCampoEditable = true;
			$bLlaveEditable = true;
			$sNomBoton = "Agregar";
		} else if ($sOpe == 'm') {
			$bCampoEditable = true;
			$sNomBoton = "Modificar";
		}
	} else {
		$sErr = "Faltan datos";
	}
} else
	$sErr = "Falta establecer el login";

if ($sErr == "") {
	include_once("cabecera.html");
} else {
	header("Location: error.php?sError=" . $sErr);
	exit();
}
?>
<div style="display: flex;">
	<?php include_once("aside.html"); ?>
	<main style="flex: 3;">
		<section>
			<form name="abcPH" action="resABC.php" method="post">
				<input type="hidden" name="txtOpe" value="<?php echo $sOpe; ?>">
				<input type="hidden" name="txtClave" value="<?php echo $sCve; ?>" />
				Nombre
				<input type="text" name="txtName" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
					value="<?php echo $oCont->getName(); ?>" />
				<br />
				Telefono
				<input type="text" name="txtPhone" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
					value="<?php echo $oCont->getPhone(); ?>" />
				<br />
				Direccion
				<input type="text" name="txtAdd" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
					value="<?php echo $oCont->getAddress(); ?>" />
				<br />
				Email
				<input type="text" name="txtEmail" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
					value="<?php echo $oCont->getEmail(); ?>" />
				<br />
				<?php if ($sNomBoton === 'Borrar'): ?>
					<button type="button" onclick="confirmarBorrado()">Borrar</button>
				<?php else: ?>
					<input type="submit" value="<?php echo $sNomBoton; ?>"onClick="return evalua(txtName, txtPhone, txtAdd, txtEmail);" />
				<?php endif; ?>
				<input type="submit" name="Submit" value="Cancelar" onClick="abcPH.action='tabcontac.php';">
			</form>
		</section>
	</main>
</div>
<?php
include_once("pie.html");
?>