<?php
include_once("AccesoDatos.php");

class Contacto
{
	private $sType = "";
	private $nId = 0;
	private $sName = "";
	private $sPhone = "";
	private $sAddress = "";
	private $sEmail = "";
	private $nFId = 0;

	public function getId()
	{
		return $this->nId;
	}
	public function setId($valor)
	{
		$this->nId = $valor;
	}
	public function getName()
	{
		return $this->sName;
	}
	public function setName($sName)
	{
		$this->sName = $sName;
	}
	public function getPhone()
	{
		return $this->sPhone;
	}
	public function setPhone($sPhone)
	{
		$this->sPhone = $sPhone;
	}
	public function getAddress()
	{
		return $this->sAddress;
	}
	public function setAddress($sAddress)
	{
		$this->sAddress = $sAddress;
	}
	public function getEmail()
	{
		return $this->sEmail;
	}
	public function setEmail($sEmail)
	{
		$this->sEmail = $sEmail;
	}
	public function getFId()
	{
		return $this->nFId;
	}
	public function setFId($nFId)
	{
		$this->nFId = $nFId;
	}

	/*Busca por clave, regresa verdadero si lo encontró*/
	function buscar()
	{
		$oAccesoDatos = new AccesoDatos();
		$sQuery = "";
		$arrRS = null;
		$bRet = false;
		if ($this->nId == 0)
			throw new Exception("Contactos->buscar(): faltan datos");
		else {
			if ($oAccesoDatos->conectar()) {
				$sQuery = " SELECT key_cont, name_cont, phone_cont, address_cont, email_cont, key_usr
							FROM contacto
							WHERE key_cont = " . $this->nId;
				$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
				$oAccesoDatos->desconectar();
				if ($arrRS) {
					$this->nId = $arrRS[0][0];
					$this->sName = $arrRS[0][1];
					$this->sPhone = $arrRS[0][2];
					$this->sAddress = $arrRS[0][3];
					$this->sEmail = $arrRS[0][4];
					$this->nFId = $arrRS[0][5];
					$bRet = true;
				}
			}
		}
		return $bRet;
	}

	/*Insertar, regresa el número de registros agregados*/
	function insertar()
	{
		$oAccesoDatos = new AccesoDatos();
		$sQuery = "";
		$nAfectados = -1;
		$this->nFId = $_SESSION['key_usr'] ?? 0;
		if (
			$this->sName == "" or $this->sPhone == "" or $this->sAddress == "" or
			$this->sEmail == "" or $this->nFId == 0
		)
			throw new Exception("Contacto->insertar(): faltan datos");
		else {
			if ($oAccesoDatos->conectar()) {
				$sQuery = "INSERT INTO contacto (name_cont, phone_cont, address_cont, email_cont, key_usr)
		           VALUES ('" . $this->sName . "', '" . $this->sPhone . "', '" . $this->sAddress . "', '" . $this->sEmail . "', '" . $this->nFId . "');";
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			}
		}
		return $nAfectados;
	}

	/*Modificar, regresa el número de registros modificados*/
	function modificar()
	{
		$oAccesoDatos = new AccesoDatos();
		$sQuery = "";
		$nAfectados = -1;
		if (
			$this->nId == 0 or $this->sName == "" or $this->sPhone == "" or
			$this->sAddress == "" or $this->sEmail == "" or $this->nFId == 0
		)
			throw new Exception("Contacto->modificar(): faltan datos");
		else {
			if ($oAccesoDatos->conectar()) {
				$sQuery = "UPDATE contacto
					SET name_cont = '" . $this->sName . "', 
					phone_cont = '" . $this->sPhone . "', 
					address_cont = '" . $this->sAddress . "', 
					email_cont = '" . $this->sEmail . "', 
					key_usr = '" . $this->nFId . "'
					WHERE key_cont = " . $this->nId;

				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			}
		}
		return $nAfectados;
	}

	/*Borrar, regresa el número de registros eliminados*/
	function borrar()
	{
		$oAccesoDatos = new AccesoDatos();
		if ($this->nId == 0)
			throw new Exception("Contacto->borrar(): faltan datos");
		else {
			if ($oAccesoDatos->conectar()) {
				$sQuery = "DELETE FROM contacto WHERE key_cont = " . $this->nId;
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			}
		}
		return $nAfectados;
	}

	/*Busca todos los registros del personal hospitalario, regresa falso si no hay información o un arreglo de PersonalHospitalario*/
	function buscarTodos()
	{
		$oAccesoDatos = new AccesoDatos();
		$sQuery = "";
		$arrRS = null;
		$aLinea = null;
		$oCont = null;
		$j = 0;
		$arrResultado = [];
		$nUsrActual = $_SESSION['key_usr'] ?? 0;
		$sTipoUsr = $_SESSION['type_usr'] ?? '';

		if ($oAccesoDatos->conectar()) {
			if ($sTipoUsr === 'admin') {
				$sQuery = "SELECT key_cont, name_cont, phone_cont, address_cont, email_cont, key_usr
					FROM contacto
					ORDER BY key_cont";
			} else {
				$sQuery = "SELECT key_cont, name_cont, phone_cont, address_cont, email_cont, key_usr
					FROM contacto
					WHERE key_usr = " . intval($nUsrActual) . "
					ORDER BY key_cont";
			}

			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();

			if ($arrRS) {
				foreach ($arrRS as $aLinea) {
					$oCont = new Contacto();
					$oCont->setId($aLinea[0]);
					$oCont->setName($aLinea[1]);
					$oCont->setPhone($aLinea[2]);
					$oCont->setAddress($aLinea[3]);
					$oCont->setEmail($aLinea[4]);
					$oCont->setFId($aLinea[5]);
					$arrResultado[$j] = $oCont;
					$j++;
				}
			}
		}
		return $arrResultado;
	}
}
?>