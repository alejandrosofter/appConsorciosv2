<?php

/**
 * This is the model class for table "gastos_tipos".
 *
 * The followings are the available columns in table 'gastos_tipos':
 * @property integer $id
 * @property string $nombreTipoGasto
 *
 * The followings are the available model relations:
 * @property Gastos[] $gastoses
 * @property PropiedadesPorcentajes[] $propiedadesPorcentajes
 */
class GastosTipos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GastosTipos the static model class
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
		return 'gastos_tipos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombreTipoGasto,nombreTipoCorto', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,paraImpresion,nombreTipoCorto, nombreTipoGasto', 'safe', 'on'=>'search'),
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
			'gastoses' => array(self::HAS_MANY, 'Gastos', 'idTipoGasto'),
			'propiedadesPorcentajes' => array(self::HAS_MANY, 'PropiedadesPorcentajes', 'idTipoGasto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreTipoGasto' => 'Nombre Tipo Gasto',
		);
	}

	public function paraImpresion()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('paraImpresion',1,false);

		return self::model()->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('nombreTipoGasto',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}