<?php

/**
 * This is the model class for table "comprobantes_items".
 *
 * The followings are the available columns in table 'comprobantes_items':
 * @property integer $id
 * @property integer $idComprobante
 * @property string $detalle
 * @property integer $cantidad
 * @property double $importe
 * @property double $decuentoInteres
 *
 * The followings are the available model relations:
 * @property Comprobantes $idComprobante0
 */
class ComprobantesItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ComprobantesItems the static model class
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
		return 'comprobantes_items';
	}
	public function ingresarParaCobrar()
	{
		foreach($this->paraCobrar->items as $item){
			$mod=new ComprobantesItemsParaCobrar();
			$mod->idParaCobrar=$item->idParaCobrar;
			$mod->coeficiente=$item->coeficiente;
			$mod->importe=$item->importe;
			$mod->idTipoGasto=$item->idTipoGasto;
			$mod->idTipoPropiedad=$item->idTipoPropiedad;
			$mod->idComprobanteItem=$this->id;
			$mod->save();
		}
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idComprobante,  cantidad', 'numerical', 'integerOnly'=>true),
			array('importe, decuentoInteres', 'numerical'),
			array('detalle,idParaCobrar', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idComprobante, detalle, cantidad, importe, decuentoInteres', 'safe', 'on'=>'search'),
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
			'comprobante' => array(self::BELONGS_TO, 'Comprobantes', 'idComprobante'),
			'paraCobrar' => array(self::BELONGS_TO, 'ParaCobrar', 'idParaCobrar'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idComprobante' => 'Id Comprobante',
			'detalle' => 'Detalle',
			'cantidad' => 'Cantidad',
			'importe' => 'Importe',
			'decuentoInteres' => 'Decuento Interes',
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
		$criteria->compare('idComprobante',$this->buscar,'OR');
		$criteria->compare('detalle',$this->buscar,true,'OR');
		$criteria->compare('cantidad',$this->buscar,'OR');
		$criteria->compare('importe',$this->buscar,'OR');
		$criteria->compare('decuentoInteres',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}