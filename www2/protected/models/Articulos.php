<?php

/**
 * This is the model class for table "articulos".
 *
 * The followings are the available columns in table 'articulos':
 * @property integer $id
 * @property string $nombreArticulo
 * @property string $posicion
 * @property string $texto
 * @property string $fechaModificacion
 */
class Articulos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Articulos the static model class
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
		return 'articulos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombreArticulo,nroPosicion, posicion', 'length', 'max'=>255),
			array('texto, nombreArticulo,nroPosicion,texto', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,nroPosicion, nombreArticulo, posicion, texto, fechaModificacion', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreArticulo' => 'Nombre Articulo',
			'posicion' => 'Posicion',
			'texto' => 'Texto',
			'fechaModificacion' => 'Fecha Modificacion',
		);
	}

	public function getContenido($nombre)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('posicion="'.$nombre.'"');
		$res=self::model()->findAll($criteria);
		if(count($res)>0)return $res[0]->texto;
		return "";
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('nombreArticulo',$this->buscar,true,'OR');
		$criteria->compare('posicion',$this->buscar,true,'OR');
		$criteria->compare('texto',$this->buscar,true,'OR');
		$criteria->compare('fechaModificacion',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}