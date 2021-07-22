<?php

/**
 * This is the model class for table "articulos".
 *
 * The followings are the available columns in table 'articulos':
 * @property integer $id
 * @property string $importe
 */
class AvisoPagos extends CActiveRecord
{
	public $image;
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
		return 'avisoPagos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('importe,idEntidad,fechaAviso,nombreArchivo', 'length', 'max'=>255),
			array('importe,idEntidad,fechaAviso,estado', 'required'),
			array('image', 'file', 'types'=>'jpg, gif, png,jpeg,pdf', 'allowEmpty' => true),
			
			array('nombreArchivo,nombreArchivo', 'safe', 'on'=>'search'),
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
	public function getEntidad()
	{
		$model=Entidades::model()->findByPk($this->idEntidad);
		return $model->razonSocial;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'importe' => 'Importe',
		);
	}


	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('importe',$this->buscar,true,'OR');
		$criteria->order="id desc";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}