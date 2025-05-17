<?php
include_once("AccesoDatos.php");
class Usuario
{ // clase base  "padre"
	private $nClave = 0;
	private $sPwd = "";
	private $sType = "";
	private $Name = "";
	private $oAD = null;

	public function getClave()
	{
		return $this->nClave;
	}
	public function setClave($valor)
	{
		$this->nClave = $valor;
	}

	public function getPwd()
	{
		return $this->sPwd;
	}
	public function setPwd($valor)
	{
		$this->sPwd = $valor;
	}

	public function getType()
	{
		return $this->sType;
	}

	public function setType($sType)
	{
		$this->sType = $sType;
	}

	public function getName()
	{
		return $this->Name;
	}

	public function setName($Name)
	{
		$this->Name = $Name;
	}

	public function buscarCvePwd()
	{
		$bRet = false;
		$sQuery = "";
		$arrRS = null;
		if (($this->nClave == 0 || $this->sPwd == ""))
			throw new Exception("Usuario->buscar: faltan datos");
		else {
			$sQuery = "SELECT key_usr, pw_usr, type_usr, name_usr
					   FROM usuario
					   WHERE key_usr = " . $this->nClave . "
					   AND pw_usr = '" . $this->sPwd . "'";
			//Crear, conectar, ejecutar, desconectar
			$oAD = new AccesoDatos();
			if ($oAD->conectar()) {
				$arrRS = $oAD->ejecutarConsulta($sQuery);
				$oAD->desconectar();
				if ($arrRS != null) {
					$this->setClave($arrRS[0][0]);
					$this->setPwd($arrRS[0][1]);
					$this->setType($arrRS[0][2]);
					$this->setName($arrRS[0][3]);
					$bRet = true;
				}
			}
		}
		return $bRet;
	}
}
?>