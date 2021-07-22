<?php

/**
 * This is the model class for table "contratos_importes".
 *
 * The followings are the available columns in table 'contratos_importes':
 * @property integer $id
 * @property integer $idContrato
 * @property integer $desdeCuota
 * @property integer $hastaCuota
 * @property double $importe
 *
 * The followings are the available model relations:
 * @property Contratos $idContrato0
 */
class ContratosImportes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContratosImportes the static model class
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
		return 'contratos_importes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idContrato, desdeCuota, hastaCuota', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idContrato, desdeCuota, hastaCuota, importe', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idContrato' => 'Id Contrato',
			'desdeCuota' => 'Desde Cuota',
			'hastaCuota' => 'Hasta Cuota',
			'importe' => 'Importe',
		);
	}

	public function getPorContrato($id)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('t.idContrato='.$id);
		return $this->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('idContrato',$this->buscar,'OR');
		$criteria->compare('desdeCuota',$this->buscar,'OR');
		$criteria->compare('hastaCuota',$this->buscar,'OR');
		$criteria->compare('importe',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}