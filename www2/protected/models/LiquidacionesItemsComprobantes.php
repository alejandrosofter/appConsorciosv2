<?php

/**
 * This is the model class for table "liquidaciones_items_comprobantes".
 *
 * The followings are the available columns in table 'liquidaciones_items_comprobantes':
 * @property integer $id
 * @property integer $idLiquidacionItem
 * @property integer $idComprobante
 * @property double $importePago
 *
 * The followings are the available model relations:
 * @property LiquidacionesItems $idLiquidacionItem0
 * @property Comprobantes $idComprobante0
 */
class LiquidacionesItemsComprobantes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LiquidacionesItemsComprobantes the static model class
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
		return 'liquidaciones_items_comprobantes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idLiquidacionItem, idComprobante', 'numerical', 'integerOnly'=>true),
			array('importePago', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idLiquidacionItem, idComprobante, importePago', 'safe', 'on'=>'search'),
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
			'idLiquidacionItem0' => array(self::BELONGS_TO, 'LiquidacionesItems', 'idLiquidacionItem'),
			'idComprobante0' => array(self::BELONGS_TO, 'Comprobantes', 'idComprobante'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idLiquidacionItem' => 'Id Liquidacion Item',
			'idComprobante' => 'Id Comprobante',
			'importePago' => 'Importe Pago',
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
		$criteria->compare('idLiquidacionItem',$this->buscar,'OR');
		$criteria->compare('idComprobante',$this->buscar,'OR');
		$criteria->compare('importePago',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}