<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;
	private $_esWeb=false;
	public $usuario;
	public function authenticate()
	{
		//VALIDO EL USUARIO ADMIN
		$datosUsuario = Usuarios::model()->validarUsuario($this->username, $this->password);
		$usuarioValido = (count($datosUsuario) == 1)?  true : false;

		$datosEntidad = Entidades::model()->validarUsuario($this->username, $this->password);
   		$entidadValido = (count($datosEntidad) == 1)?  true : false;

		if (!$usuarioValido)  $this->errorCode= self::ERROR_PASSWORD_INVALID;
			else { $this->errorCode=self::ERROR_NONE; 
			$this->setState('usuario', $datosUsuario[0]->nombreUsuario);
			$this->_id= $datosUsuario[0]->id;
			$this->setState('nombre', $datosUsuario[0]->nombreUsuario);
			$this->setState('idUsuario', $datosUsuario[0]->id);   //guarda el id usuario
			$this->setState('esWeb', false);

			return;
			      }
		//VALIDO SI ES CUENTA WEB ENTIDAD
   		
   		if (!$entidadValido) $this->errorCode=  self::ERROR_PASSWORD_INVALID;
			else {
				echo "datoso: ".count($datosEntidad);
			$this->errorCode=self::ERROR_NONE; 
			$this->setState('usuario', $datosEntidad[0]->razonSocial);
			$this->_id= $datosEntidad[0]->id;
			$this->_esWeb= true;
			$this->setState('nombre', $datosEntidad[0]->razonSocial);
			$this->setState('idUsuario', $datosEntidad[0]->id);   //guarda el id usuario
			$this->setState('esWeb', true);
			return -1;
			      }
			return !$this->errorCode; 
	}
	public function getId()
        {
                return $this->_id;
        }
        public function getEsWeb()
        {
        	return $this->_esWeb;
        }
        public function getUsuario()
        {
                return $this->usuario;
        }
}