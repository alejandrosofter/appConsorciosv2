<?php

/**
 * This is the model class for table "comprobantes_respuestaElectronica".
 *
 * The followings are the available columns in table 'comprobantes_respuestaElectronica':
 * @property integer $id
 * @property string $detalleRta
 * @property string $estado
 * @property string $fechaVence
 * @property string $cae
 * @property integer $idComprobante
 *
 * The followings are the available model relations:
 * @property Comprobantes $idComprobante0
 */
class ComprobantesRespuestaElectronica extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ComprobantesRespuestaElectronica the static model class
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
		return 'comprobantes_respuestaElectronica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idComprobante', 'numerical', 'integerOnly'=>true),
			array('estado, fechaVence, cae', 'length', 'max'=>255),
			array('detalleRta', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, detalleRta, estado, fechaVence, cae, idComprobante', 'safe', 'on'=>'search'),
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
			'detalleRta' => 'Detalle Rta',
			'estado' => 'Estado',
			'fechaVence' => 'Fecha Vence',
			'cae' => 'Cae',
			'idComprobante' => 'Id Comprobante',
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
		$criteria->compare('detalleRta',$this->buscar,true,'OR');
		$criteria->compare('estado',$this->buscar,true,'OR');
		$criteria->compare('fechaVence',$this->buscar,true,'OR');
		$criteria->compare('cae',$this->buscar,true,'OR');
		$criteria->compare('idComprobante',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}