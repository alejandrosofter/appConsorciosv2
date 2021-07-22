<?php

/**
 * This is the model class for table "contratos_paraCobrar".
 *
 * The followings are the available columns in table 'contratos_paraCobrar':
 * @property integer $id
 * @property integer $idParaCobrar
 * @property integer $idContrato
 *
 * The followings are the available model relations:
 * @property Contratos $idContrato0
 * @property ParaCobrar $idParaCobrar0
 */
class ContratosParaCobrar extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContratosParaCobrar the static model class
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
		return 'contratos_paraCobrar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idParaCobrar, idContrato', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idParaCobrar, idContrato', 'safe', 'on'=>'search'),
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
			'contrato' => array(self::BELONGS_TO, 'Contratos', 'idContrato'),
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
			'idContrato' => 'Id Contrato',
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
		$criteria->compare('idParaCobrar',$this->buscar,'OR');
		$criteria->compare('idContrato',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}