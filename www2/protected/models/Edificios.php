<?php

/**
 * This is the model class for table "edificios".
 *
 * The followings are the available columns in table 'edificios':
 * @property integer $id
 * @property string $nombreEdificio
 * @property string $domicilio
 * @property string $telefono
 * @property string $nombrePortero
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Gastos[] $gastoses
 * @property Liquidaciones[] $liquidaciones
 * @property Propiedades[] $propiedades
 */
class Edificios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Edificios the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function getPorcentaje($idEdificio,$idTipoPropiedad)
	{
		$edif=Edificios::model()->findByPk($idEdificio);
		$sum=0;
		if(!$edif)return 1;
		foreach($edif->propiedades as $prop){
			$sum+=$prop->idTipoPropiedad==$idTipoPropiedad?$prop->porcentaje:0;
			if($idTipoPropiedad==2)$sum+=$prop->porcentajeCochera;
			
		}
		return $sum;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'edificios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombreEdificio,cuit,razonSocialConsorcio, domicilio, telefono, nombrePortero, email', 'length', 'max'=>255),
			array('nombreEdificio,idTalonario,importeFondoReserva,fechaInicio,idCondicionIva','required'),
			array('lugarPago,idCondicionIva,proximoRecibo,localidad,provincia,cp,interes,interesDiaDesde,fechaInicio','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,cuit,lugarPago, nombreEdificio,fechaInicio, domicilio, telefono, nombrePortero, email', 'safe', 'on'=>'search'),
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
			'gastoses' => array(self::HAS_MANY, 'Gastos', 'idEdificio'),
			'liquidaciones' => array(self::HAS_MANY, 'Liquidaciones', 'idEdificio'),
			'propiedades' => array(self::HAS_MANY, 'Propiedades', 'idEdificio'),
			'propiedadesActivas' => array(self::HAS_MANY, 'Propiedades', 'idEdificio','condition'=>'propiedadesActivas.estado="ACTIVA"'),
			'talonario' => array(self::HAS_MANY, 'Talonarios', 'id'),
			'condicionIva' => array(self::BELONGS_TO, 'CondicionesIva', 'idCondicionIva'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreEdificio' => 'Nombre Edificio',
			'domicilio' => 'Domicilio',
			'idCondicionIva' => 'Condición Iva',
			'telefono' => 'Telefono',
			'nombrePortero' => 'Nombre Portero',
			'email' => 'Email',
			'idTalonario' => 'Talonario',
			'fechaInicio' => 'Inicio del Consorcio',
			'razonSocialConsorcio' => 'Razon Social del Consorcio',
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
		$criteria->compare('nombreEdificio',$this->buscar,true,'OR');
		$criteria->compare('domicilio',$this->buscar,true,'OR');
		$criteria->compare('telefono',$this->buscar,true,'OR');
		$criteria->compare('nombrePortero',$this->buscar,true,'OR');
		$criteria->compare('email',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
