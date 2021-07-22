<?php

/**
 * This is the model class for table "propiedades_consultas".
 *
 * The followings are the available columns in table 'propiedades_consultas':
 * @property integer $id
 * @property string $fecha
 * @property string $solicitante
 * @property string $telefonos
 * @property string $email
 * @property string $observaciones
 * @property string $estado
 * @property string $tipoConsulta
 * @property double $importeDesde
 * @property double $importeHasta
 * @property integer $idTipoPropiedad
 * @property integer $idUbicacion
 * @property integer $cantidadHabitaciones
 * @property integer $cantidadBanos
 * @property integer $tienePatio
 * @property integer $tieneQuincho
 * @property integer $publicaWeb
 *
 * The followings are the available model relations:
 * @property Ubicaciones $idUbicacion0
 * @property PropiedadesTipos $idTipoPropiedad0
 */
class PropiedadesConsultas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PropiedadesConsultas the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getEstados()
	{
		return array('PENDIENTE'=>'PENDIENTE','CERRADO'=>'CERRADO');
	}
	public function getTipoConsultas()
	{
		return array('BUSCA'=>'BUSCA','OFRECE'=>'OFRECE');
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'propiedades_consultas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTipoPropiedad, idUbicacion, cantidadHabitaciones, cantidadBanos, tienePatio, tieneQuincho, publicaWeb', 'numerical', 'integerOnly'=>true),
			array('importeDesde, importeHasta', 'numerical'),
			array('solicitante, telefonos, email, estado, tipoConsulta', 'length', 'max'=>255),
			array('fecha, observaciones', 'safe'),
			array('fecha, solicitante,telefonos,tipoConsulta', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, fecha, solicitante, telefonos, email, observaciones, estado, tipoConsulta, importeDesde, importeHasta, idTipoPropiedad, idUbicacion, cantidadHabitaciones, cantidadBanos, tienePatio, tieneQuincho, publicaWeb', 'safe', 'on'=>'search'),
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
			'idUbicacion0' => array(self::BELONGS_TO, 'Ubicaciones', 'idUbicacion'),
			'idTipoPropiedad0' => array(self::BELONGS_TO, 'PropiedadesTipos', 'idTipoPropiedad'),
		);
	}
	public function getColor()
	{
		if($this->estado=="CERRADO")return "muted";
		return '';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha',
			'solicitante' => 'Solicitante',
			'telefonos' => 'Telefonos',
			'email' => 'Email',
			'observaciones' => 'Observaciones',
			'estado' => 'Estado',
			'tipoConsulta' => 'Tipo Consulta',
			'importeDesde' => 'Importe Desde',
			'importeHasta' => 'Importe Hasta',
			'idTipoPropiedad' => 'Tipo Propiedad',
			'idUbicacion' => 'Ubicacion',
			'cantidadHabitaciones' => 'Cantidad Habitaciones',
			'cantidadBanos' => 'Cantidad Banos',
			'tienePatio' => 'Tiene Patio',
			'tieneQuincho' => 'Tiene Quincho',
			'publicaWeb' => 'Publica Web',
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

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('fecha',$this->buscar,true,'OR');
		$criteria->compare('solicitante',$this->buscar,true,'OR');
		$criteria->compare('telefonos',$this->buscar,true,'OR');
		$criteria->compare('email',$this->buscar,true,'OR');
		$criteria->compare('observaciones',$this->buscar,true,'OR');
		$criteria->compare('estado',$this->buscar,true,'OR');
		$criteria->compare('tipoConsulta',$this->buscar,true,'OR');
		$criteria->compare('importeDesde',$this->buscar,'OR');
		$criteria->compare('importeHasta',$this->buscar,'OR');
		$criteria->compare('idTipoPropiedad',$this->buscar,'OR');
		$criteria->compare('idUbicacion',$this->buscar,'OR');
		$criteria->compare('cantidadHabitaciones',$this->buscar,'OR');
		$criteria->compare('cantidadBanos',$this->buscar,'OR');
		$criteria->compare('tienePatio',$this->buscar,'OR');
		$criteria->compare('tieneQuincho',$this->buscar,'OR');
		$criteria->compare('publicaWeb',$this->buscar,'OR');
		$criteria->order="t.fecha desc";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}