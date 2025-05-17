<?php
include_once("modelo\Usuario.php");
include_once("modelo\Contactos.php");
session_start();
$sErr = "";
$sNom = "";
$arrCont = null;
$oCont = new Contacto();
if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
	$oUsu = $_SESSION["usuario"];
	$oNom = $oUsu->getName();
	try {
		$arrCont = $oCont->buscarTodos();
	} catch (Exception $e) {
		error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
		$sErr = "Error en base de datos, comunicarse con el administrador";
	}
} else
	$sErr = "Falta establecer el login";
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
	<main style="flex: 3;">
		<section>
			<h3>Contactos</h3>
			<form name="formTabla" method="post" action="abcCont.php">
				<input type="hidden" name="txtClave">
				<input type="hidden" name="txtOpe">
				<table border="1">
					<tr>
						<td>Nombre</td>
						<td>Telefono</td>
						<td>Direcci&oacute;n</td>
						<td>Email</td>
						<td>Operaci&oacute;n</td>
					</tr>
					<?php
					if ($arrCont != null) {
						foreach ($arrCont as $oCont) {
							?>
							<tr>
								<td class="llave"><?php echo $oCont->getName(); ?></td>
								<td><?php echo $oCont->getPhone(); ?></td>
								<td><?php echo $oCont->getAddress(); ?></td>
								<td><?php echo $oCont->getEmail(); ?></td>
								<td>
									<input type="submit" name="Submit" value="Modificar"
										onClick="txtClave.value=<?php echo $oCont->getId(); ?>; txtOpe.value='m'">
									<input type="submit" name="Submit" value="Borrar"
										onClick="txtClave.value=<?php echo $oCont->getId(); ?>; txtOpe.value='b'">
								</td>
							</tr>
							<?php
						}//foreach
					} else {
						?>
						<tr>
							<td colspan="2">No hay datos</td>
						</tr>
						<?php
					}
					?>
				</table>
				<input type="submit" name="Submit" value="Crear Nuevo" onClick="txtClave.value='-1';txtOpe.value='a'">
			</form>
		</section>
	</main>
</div>
<?php
include_once("pie.html");
?>