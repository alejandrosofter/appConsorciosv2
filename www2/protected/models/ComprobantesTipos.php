<?php

/**
 * This is the model class for table "comprobantes_tipos".
 *
 * The followings are the available columns in table 'comprobantes_tipos':
 * @property integer $id
 * @property string $nombreTipoComprobante
 *
 * The followings are the available model relations:
 * @property Comprobantes[] $comprobantes
 */
class ComprobantesTipos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ComprobantesTipos the static model class
	 */
	 const ID_X=1;
	 const ID_NOTACREDITO=2;
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
		return 'comprobantes_tipos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombreTipoComprobante', 'length', 'max'=>255),
			array('idPlantilla','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, nombreTipoComprobante', 'safe', 'on'=>'search'),
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
			'comprobantes' => array(self::HAS_MANY, 'Comprobantes', 'idTipoComprobante'),
			'plantilla' => array(self::BELONGS_TO, 'Plantillas', 'idPlantilla'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idPlantilla'=>'Plantilla Asociada',
			'nombreTipoComprobante' => 'Nombre Tipo Comprobante',
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
		$criteria->compare('nombreTipoComprobante',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}