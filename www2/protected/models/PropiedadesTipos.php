<?php

/**
 * This is the model class for table "propiedades_tipos".
 *
 * The followings are the available columns in table 'propiedades_tipos':
 * @property integer $id
 * @property string $nombreTipoPropiedad
 *
 * The followings are the available model relations:
 * @property Propiedades[] $propiedades
 */
class PropiedadesTipos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PropiedadesTipos the static model class
	 */
	 public $buscar;
	 const ID_DEPTO=1;
	 const ID_COCHERA=2;
	 const ID_LOCAL=3;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'propiedades_tipos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombreTipoPropiedad,nombreTipoCorto', 'length', 'max'=>255),
			array('esDeEdificio,paraImpresion,nombreTipoCorto','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,paraImpresion,esDeEdificio, nombreTipoPropiedad', 'safe', 'on'=>'search'),
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
			'propiedades' => array(self::HAS_MANY, 'Propiedades', 'idTipoPropiedad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreTipoPropiedad' => 'Nombre Tipo Propiedad',
		);
	}
	public function paraImpresion()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('paraImpresion',1);
		return self::model()->findAll($criteria);
	}
	public function paraEdificios()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('esDeEdificio',1);
		return self::model()->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('nombreTipoPropiedad',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}