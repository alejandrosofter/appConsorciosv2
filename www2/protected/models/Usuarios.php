<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property integer $id
 * @property string $nombreUsuario
 * @property string $clave
 * @property string $fechaAlta
 * @property string $email
 * @property string $imagen
 * @property integer $esAdministrativo
 * @property integer $idEstado
 *
 * The followings are the available model relations:
 * @property AsociadosUsuario[] $asociadosUsuarios
 * @property Mensajes[] $mensajes
 * @property Estados $idEstado0
 */
class Usuarios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function consultarServer($func)
	{
		$estado=Settings::model()->getValorSistema('SOAP_ESTADO_CUENTA')*1;
		if($estado!=0){
			$data=trim(file_get_contents('estado'));
			$arrData=explode(';',$data);
			$idVenta=(int)trim($arrData[0]);
			ini_set ( 'soap.wsdl_cache_enable' , 0 ); ini_set ( 'soap.wsdl_cache_ttl' , 0 );
			$ip=gethostbyname(Settings::model()->getValorSistema('HOST_WEB_SOAP'));
			$client=new SoapClient('http://'.$ip.'/index.php?r=Clientes/servicios3');
			return $client->$func($idVenta);
		}return 0;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios';
	}

	public function asignarPrivilegios($esAdmin,$id)
	{
		$connection=Yii::app()->getDb();
		if($esAdmin)
        $command=$connection->createCommand(
			"INSERT INTO  `AuthAssignment` (
			`itemname` ,
			`userid` ,
			`bizrule` ,
			`data`
			)
			VALUES (
			'Admin',  '".$id."', NULL ,'N;'
			);");
        else 
        $command=$connection->createCommand(
			"INSERT INTO  `AuthAssignment` (
			`itemname` ,
			`userid` ,
			`bizrule` ,
			`data`
			)
			VALUES (
			'asociados',  '".$id."', NULL , NULL
			);");
            
            return $command->query();
	}
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('esAdministrativo, idEstado', 'numerical', 'integerOnly'=>true),
			array('nombreUsuario, clave, email,fechaAlta', 'length', 'max'=>255),
			array('nombreUsuario, clave', 'required'),
			array('nombreUsuario', 'unique'),
			array('email', 'email'),
			array('imagen', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombreUsuario, clave, fechaAlta, email, imagen, esAdministrativo, idEstado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'asociadosUsuarios' => array(self::HAS_MANY, 'AsociadosUsuario', 'idUsuario'),
			'mensajes' => array(self::HAS_MANY, 'Mensajes', 'idUsuarioEmisor'),
			'idEstado0' => array(self::BELONGS_TO, 'Estados', 'idEstado'),
			'asociado' => array(self::HAS_ONE, 'AsociadosUsuario', 'idUsuario'),
		);
	}
	public function getNombreUsuarioAsociado()
	{
		if(isset($this->asociado))
			return $this->asociado->asociado->apellido.' '.$this->asociado->asociado->nombre;
		return $this->nombreUsuario;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreUsuario' => 'Nombre Usuario',
			'clave' => 'Clave',
			'fechaAlta' => 'Fecha Alta',
			'email' => 'Email',
			'imagen' => 'Imagen',
			'esAdministrativo' => 'Es Administrativo?',
			'idEstado' => 'Estado',
		);
	}

	public function validarUsuario ($usuario,$clave)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('t.nombreUsuario', $usuario, false);
		$criteria->compare('t.clave', $clave, false);
		
		return self::model()->findAll($criteria);
	}
	public function administrativos()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('esAdministrativo',1,false);
		return self::model()->findAll($criteria);

	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nombreUsuario',$this->nombreUsuario,true);
		$criteria->compare('clave',$this->clave,true);
		$criteria->compare('fechaAlta',$this->fechaAlta,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('imagen',$this->imagen,true);
		$criteria->compare('esAdministrativo',$this->esAdministrativo);
		$criteria->compare('idEstado',$this->idEstado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}