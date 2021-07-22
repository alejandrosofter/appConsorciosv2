<?php

/**
 * This is the model class for table "contratos".
 *
 * The followings are the available columns in table 'contratos':
 * @property integer $id
 * @property integer $idDominio
 * @property integer $idEntidadLocador
 * @property integer $idEntidadLocatario
 * @property string $fechaInicio
 * @property string $fechaVencimiento
 * @property integer $idPlantilla
 * @property string $fechaRecesion
 * @property double $depositoGarantia
 * @property double $comisionAdministracion
 * @property double $punitoriosDia
 *
 * The followings are the available model relations:
 * @property Plantillas $idPlantilla0
 * @property Dominios $idDominio0
 * @property Entidades $idEntidadLocador0
 * @property Entidades $idEntidadLocatario0
 */
class Contratos extends CActiveRecord
{
	const ACTIVO="ACTIVO";
	const RESCINDIDO="RESCINDIDO";
	const RENOVADO="RENOVADO";
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contratos the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contratos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idDominio, idEntidadLocador, idEntidadLocatario, idPlantilla', 'numerical', 'integerOnly'=>true),
			array('depositoGarantia,idGarante1,idGarante2', 'numerical'),
			//array('idDominio', 'ext.ValidadorContrato', 'message'=>'Este Inmueble esta siendo usado por otro contrato!' ),
			array('fechaInicio,importes, fechaVencimiento,punitoriosDia, fechaRecesion,textoContrato,periodicidad,comisionAdministracion', 'safe'),
			array('cantidadImportes','numerical',
    'integerOnly'=>true,
    'min'=>1,
    'tooSmall'=>'Tiene que ingresar por lo menos 1 importe!'),
			array('idDominio,estado, idEntidadLocador, idEntidadLocatario,fechaInicio, fechaVencimiento,cuota', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idDominio, idEntidadLocador, idEntidadLocatario,cuota, fechaInicio, fechaVencimiento, idPlantilla, fechaRecesion, depositoGarantia, comisionAdministracion, punitoriosDia', 'safe', 'on'=>'search'),
		);
	}
	public function getColor()
	{
		if($this->estado=="RESCINDIDO")return "muted";
		if($this->estado=="RENOVADO")return "muted";
		$vence = new DateTime($this->fechaVencimiento, new DateTimeZone("UTC"));
		$actual=new DateTime(Date("Y-m-d"), new DateTimeZone("UTC"));
		$interval = date_diff($actual, $vence);
		$diferencia=($interval->format('%R%a'));
		//var_dump($diferencia*1);exit;
		if($diferencia<1)return "error";
		if($diferencia<30)return "warning";
		return '';
	}
	public function cambiarEstado($estado)
	{
		$this->estado=$estado;
		$this->save();
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'plantilla' => array(self::BELONGS_TO, 'Plantillas', 'idPlantilla'),
			'inmueble' => array(self::BELONGS_TO, 'Propiedades', 'idDominio'),
			'locador' => array(self::BELONGS_TO, 'Entidades', 'idEntidadLocador'),
			'locatario' => array(self::BELONGS_TO, 'Entidades', 'idEntidadLocatario'),
			'garante1' => array(self::BELONGS_TO, 'Entidades', 'idGarante1'),
			'importes' => array(self::HAS_MANY, 'ContratosImportes', 'idContrato'),
			'paraCobrar' => array(self::HAS_MANY, 'ContratosParaCobrar', 'idContrato'),
			'importe' => array(self::HAS_ONE, 'ContratosImportes', 'idContrato'),
			'garante2' => array(self::BELONGS_TO, 'Entidades', 'idGarante2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idDominio' => 'Inmueble',
			'idEntidadLocador' => 'Locador',
			'idEntidadLocatario' => 'Locatario',
			'fechaInicio' => 'Fecha Inicio',
			'fechaVencimiento' => 'Fecha Vencimiento',
			'idPlantilla' => 'Plantilla',
			'fechaRecesion' => 'Fecha Recesion',
			'depositoGarantia' => 'Deposito Garantia',
			'comisionAdministracion' => 'Comision Administracion',
			'punitoriosDia' => 'Punitorios Dia',
			'periodicidad' => 'Periodicidad',
			'cuota' => 'Cantidad de Cuotas',
			'idGarante1' => 'Garante Principal',
			'idGarante2' => 'Garante Sec.',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('locatario','locador');
		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('locatario.razonSocial',$this->buscar,'OR');
		$criteria->compare('locador.razonSocial',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}