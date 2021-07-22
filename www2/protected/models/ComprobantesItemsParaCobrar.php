<?php

/**
 * This is the model class for table "comprobantes_items_paraCobrar".
 *
 * The followings are the available columns in table 'comprobantes_items_paraCobrar':
 * @property integer $id
 * @property integer $idParaCobrar
 * @property double $importe
 * @property integer $idTipoPropiedad
 * @property integer $idTipoGasto
 * @property double $coeficiente
 */
class ComprobantesItemsParaCobrar extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ComprobantesItemsParaCobrar the static model class
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
		return 'comprobantes_items_paraCobrar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idParaCobrar, idComprobanteItem,idTipoPropiedad, idTipoGasto', 'numerical', 'integerOnly'=>true),
			array('importe, idComprobanteItem,coeficiente', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idComprobanteItem,idParaCobrar, importe, idTipoPropiedad, idTipoGasto, coeficiente', 'safe', 'on'=>'search'),
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
			'comprobanteItem' => array(self::BELONGS_TO, 'ComprobantesItems', 'idComprobanteItem'),
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
			'idParaCobrar' => 'Id Para Cobrar',
			'importe' => 'Importe',
			'idTipoPropiedad' => 'Id Tipo Propiedad',
			'idTipoGasto' => 'Id Tipo Gasto',
			'coeficiente' => 'Coeficiente',
		);
	}

	public function consultarFondoCobrado($idEdificio,$ano)
	{
		$criteria=new CDbCriteria;
		$criteria->join="left join paraCobrar on paraCobrar.id=t.idParaCobrar
		 left join propiedades on propiedades.id=paraCobrar.idPropiedad 
		 left join comprobantes_items on comprobantes_items.id=t.idComprobanteItem
		 left join comprobantes on comprobantes.id=comprobantes_items.idComprobante";
		$criteria->addCondition('YEAR(comprobantes.fecha)='.$ano);
		$criteria->addCondition('propiedades.idEdificio='.$idEdificio);
		$criteria->addCondition('paraCobrar.estado="CANCELADO"');
		$criteria->addCondition('idTipoGasto=3');
		$criteria->select='t.*';
		return self::model()->findAll($criteria);
	}
	public function consultarImporteFondoCobrado($idEdificio,$ano)
	{
		$sum=0;
		$res=$this->consultarFondoCobrado($idEdificio,$ano);
		foreach($res as $item)$sum+=$item->importe;
		return $sum;
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('idParaCobrar',$this->buscar,'OR');
		$criteria->compare('importe',$this->buscar,'OR');
		$criteria->compare('idTipoPropiedad',$this->buscar,'OR');
		$criteria->compare('idTipoGasto',$this->buscar,'OR');
		$criteria->compare('coeficiente',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}