<?php

/**
 * This is the model class for table "entidades_tipos".
 *
 * The followings are the available columns in table 'entidades_tipos':
 * @property integer $id
 * @property string $nombreTipoEntidad
 * @property integer $idTipoOperacion
 *
 * The followings are the available model relations:
 * @property Entidades[] $entidades
 * @property TipoOperaciones $idTipoOperacion0
 */
class EntidadesTipos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EntidadesTipos the static model class
	 */
	 public $buscar;
	 const ID_PROPIETARIO=2;
	 const ID_INQUILINO=1;
	 const ID_LOCADOR=6;
	 const ID_LOCATARIO=7;
	 const ID_GARANTE=8;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entidades_tipos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTipoOperacion', 'numerical', 'integerOnly'=>true),
			array('nombreTipoEntidad', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, nombreTipoEntidad, idTipoOperacion', 'safe', 'on'=>'search'),
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
			'entidades' => array(self::HAS_MANY, 'Entidades', 'idTipoEntidad'),
			'idTipoOperacion0' => array(self::BELONGS_TO, 'TipoOperaciones', 'idTipoOperacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreTipoEntidad' => 'Nombre Tipo Entidad',
			'idTipoOperacion' => 'Id Tipo Operacion',
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
		$criteria->compare('nombreTipoEntidad',$this->buscar,true,'OR');
		$criteria->compare('idTipoOperacion',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}