<?php

/**
 * This is the model class for table "paraCobrar_items".
 *
 * The followings are the available columns in table 'paraCobrar_items':
 * @property integer $id
 * @property integer $idParaCobrar
 * @property double $importe
 * @property integer $idTipoPropiedad
 * @property integer $idTipoGasto
 * @property double $coeficiente
 *
 * The followings are the available model relations:
 * @property GastosTipos $idTipoGasto0
 * @property ParaCobrar $idParaCobrar0
 * @property PropiedadesTipos $idTipoPropiedad0
 */
class ParaCobrarItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ParaCobrarItems the static model class
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
		return 'paraCobrar_items';
	}
	public function consultarRecaudadoFondo($idEdificio,$ano)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('YEAR(paraCobrar.fecha)='.$ano);
		$criteria->addCondition('idTipoGasto=3');
		$criteria->compare('propiedades.idEdificio',$idEdificio,false);
		$criteria->join='inner join paraCobrar on paraCobrar.id=t.idParaCobrar 
		LEFT OUTER JOIN  propiedades on propiedades.id=paraCobrar.idPropiedad';
		$criteria->select='t.*,propiedades.*,paraCobrar.*';
		return self::model()->findAll($criteria);
	}
	public function getImporteRecaudadoFondo($idEdificio,$ano)
	{
		$sum=0;
		$res=$this->consultarRecaudadoFondo($idEdificio,$ano);
		foreach($res as $item)$sum+=$item->importe;
		return $sum;
	
	}
	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idParaCobrar, idTipoPropiedad, idTipoGasto', 'numerical', 'integerOnly'=>true),
			array('importe,importeSobre, coeficiente', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idParaCobrar, importe, idTipoPropiedad, idTipoGasto, coeficiente', 'safe', 'on'=>'search'),
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
			'tipoGasto' => array(self::BELONGS_TO, 'GastosTipos', 'idTipoGasto'),
			'paraCobrar' => array(self::BELONGS_TO, 'ParaCobrar', 'idParaCobrar'),
			'tipoPropiedad' => array(self::BELONGS_TO, 'PropiedadesTipos', 'idTipoPropiedad'),
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

	public function items($idParaCobrar)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idParaCobrar',$idParaCobrar,false);

		return self::model()->findAll($criteria);
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