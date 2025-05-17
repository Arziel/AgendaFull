<?php
include_once("modelo\Usuario.php");
session_start();
$sErr = "";
$sCve = "";
$sNom = "";
$sPwd = "";
$oUsu = new Usuario();
if (
	isset($_POST["key"]) && !empty($_POST["key"]) &&
	isset($_POST["password"]) && !empty($_POST["password"])
) {
	$sCve = $_POST["key"];
	$sPwd = $_POST["password"];
	$oUsu->setClave($sCve);
	$oUsu->setPwd($sPwd);
	try {
		if ($oUsu->buscarCvePwd()) {
			$_SESSION["usuario"] = $oUsu;
			$_SESSION["key_usr"] = $oUsu->getClave();
			$_SESSION["type_usr"] = $oUsu->getType();
		} else {
			$sErr = "Usuario desconocido";
		}
	} catch (Exception $e) {
		error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
		$sErr = "Error al acceder a la base de datos";
	}
} else
	$sErr = "Faltan datos";
if ($sErr == "")
	header("Location: inicio.php");
else
	header("Location: error.php?sError=" . $sErr);
?>