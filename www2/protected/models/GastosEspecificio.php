<?php

/**
 * This is the model class for table "gastos_especificio".
 *
 * The followings are the available columns in table 'gastos_especificio':
 * @property integer $id
 * @property integer $idGasto
 * @property integer $idPropiedad
 */
class GastosEspecificio extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GastosEspecificio the static model class
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
		return 'gastos_especificio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idGasto, idPropiedad', 'required'),
			array('idGasto, idPropiedad', 'numerical', 'integerOnly'=>true),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idGasto, idPropiedad', 'safe', 'on'=>'search'),
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
			'gasto' => array(self::BELONGS_TO, 'Gastos', 'idGasto'),
			'propiedad' => array(self::BELONGS_TO, 'Propiedades', 'idPropiedad'),
		);
	}
	public function ingresarItems($idGasto,$propiedades)
	{
		$this->quitarTodos($idGasto);
		foreach($propiedades as  $prop){
			$model=new GastosEspecificio();
			$model->idGasto=$idGasto;
			$model->idPropiedad=$prop;
			$model->save();
		}
	}
	private function quitarTodos($idGasto)
	{
		$model=Gastos::model()->findByPk($idGasto);
		foreach($model->propiedadesEspecifico as $item)$item->delete();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idGasto' => 'Id Gasto',
			'idPropiedad' => 'Id Propiedad',
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
		$criteria->compare('idGasto',$this->buscar,'OR');
		$criteria->compare('idPropiedad',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}