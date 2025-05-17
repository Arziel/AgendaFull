<?php
include_once("modelo\Contactos.php");
include_once("modelo\Usuario.php");
session_start();
$sErr = "";
$sOpe = "";
$sCve = "";
$oCont = new Contacto();

if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
	if (
		isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
		isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])
	) {
		$sOpe = $_POST["txtOpe"];
		$sCve = $_POST["txtClave"];
		$oCont->setId($sCve);

		if ($sOpe != 'b') {
			$oCont->setName($_POST["txtName"]);
			$oCont->setPhone($_POST["txtPhone"]);
			$oCont->setAddress($_POST["txtAdd"]);
			$oCont->setEmail($_POST["txtEmail"]);
			$oCont->setFId($_SESSION["usuario"]->getClave());
		}
		try {
			if ($sOpe == 'a')
				$nResultado = $oCont->insertar();
			else if ($sOpe == 'b')
				$nResultado = $oCont->borrar();
			else
				$nResultado = $oCont->modificar();
			if ($nResultado != 1) {
				$sError = "Error en bd";
			}
		} catch (Exception $e) {
			error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
			$sErr = "Error: " . $e->getMessage();
		}
	} else {
		$sErr = "Error: " . $e->getMessage();
	}
} else
	$sErr = "Falta establecer el login";

if ($sErr == "") {
	echo "<script>
    const x = 1;
</script>";
	echo "<script src='./js/popup.js'></script>";
	include_once("cabecera.html");
} else {
	header("Location: error.php?sError=" . $sErr);
	exit();
}
?>