<?php

/**
 * This is the model class for table "media".
 *
 * The followings are the available columns in table 'media':
 * @property integer $id
 * @property string $nombreMedia
 * @property string $type
 * @property string $fechaUpdate
 * @property string $descripcion
 * @property string $extension
 *
 * The followings are the available model relations:
 * @property PropiedadesMedia[] $propiedadesMedias
 */
 include_once(dirname(__FILE__).'/../extensions/SimpleImage.php');
class Media extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Media the static model class
	 */
	 const PATH="/../../images/propiedades/";
	const W_DESTACADO=750;
	const PREFIJO_DESTACADO="dest_";
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'media';
	}
	public function generaImagen($id,$w)
	{

		$media=self::model()->findByPk($id);
		$targetFile=dirname(__FILE__).self::PATH.$media->nombreMedia;
		$nombreSalida=dirname(__FILE__).self::PATH.$w.'_'.$media->nombreMedia;
		if(!file_exists($nombreSalida)){
			$image = new SimpleImage();
			$image->load($targetFile);
			$image->resizeToWidth($w);
			$image->save($nombreSalida);
		}
		return $w.'_'.$media->nombreMedia;
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type', 'length', 'max'=>100),
			array('extension', 'length', 'max'=>50),
			array('nombreMedia, fechaUpdate, descripcion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombreMedia, type, fechaUpdate, descripcion, extension', 'safe', 'on'=>'search'),
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
			'propiedadesMedias' => array(self::HAS_MANY, 'PropiedadesMedia', 'idMedia'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreMedia' => 'Nombre Media',
			'type' => 'Type',
			'fechaUpdate' => 'Fecha Update',
			'descripcion' => 'Descripcion',
			'extension' => 'Extension',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('nombreMedia',$this->nombreMedia,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('fechaUpdate',$this->fechaUpdate,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('extension',$this->extension,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}