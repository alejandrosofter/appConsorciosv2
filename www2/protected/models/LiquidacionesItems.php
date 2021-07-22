<?php

/**
 * This is the model class for table "liquidaciones_items".
 *
 * The followings are the available columns in table 'liquidaciones_items':
 * @property integer $id
 * @property integer $idLiquidacion
 * @property integer $idEntidad
 * @property double $importe
 * @property integer $idPropiedad
 * @property string $detalle
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property Liquidaciones $idLiquidacion0
 * @property Entidades $idEntidad0
 * @property Propiedades $idPropiedad0
 * @property LiquidacionesItemsComprobantes[] $liquidacionesItemsComprobantes
 */
class LiquidacionesItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LiquidacionesItems the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'liquidaciones_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idLiquidacion, idEntidad, idPropiedad', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			array('estado', 'length', 'max'=>255),
			array('detalle', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idLiquidacion, idEntidad, importe, idPropiedad, detalle, estado', 'safe', 'on'=>'search'),
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
			'idLiquidacion0' => array(self::BELONGS_TO, 'Liquidaciones', 'idLiquidacion'),
			'idEntidad0' => array(self::BELONGS_TO, 'Entidades', 'idEntidad'),
			'idPropiedad0' => array(self::BELONGS_TO, 'Propiedades', 'idPropiedad'),
			'liquidacionesItemsComprobantes' => array(self::HAS_MANY, 'LiquidacionesItemsComprobantes', 'idLiquidacionItem'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idLiquidacion' => 'Id Liquidacion',
			'idEntidad' => 'Id Entidad',
			'importe' => 'Importe',
			'idPropiedad' => 'Id Propiedad',
			'detalle' => 'Detalle',
			'estado' => 'Estado',
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
		$criteria->compare('idLiquidacion',$this->buscar,'OR');
		$criteria->compare('idEntidad',$this->buscar,'OR');
		$criteria->compare('importe',$this->buscar,'OR');
		$criteria->compare('idPropiedad',$this->buscar,'OR');
		$criteria->compare('detalle',$this->buscar,true,'OR');
		$criteria->compare('estado',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}