<?php

/**
 * This is the model class for table "propiedades_media".
 *
 * The followings are the available columns in table 'propiedades_media':
 * @property integer $id
 * @property integer $idMedia
 * @property integer $idPropiedad
 * @property integer $defecto
 *
 * The followings are the available model relations:
 * @property Media $idMedia0
 * @property Propiedades $idPropiedad0
 */
class PropiedadesMedia extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PropiedadesMedia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'propiedades_media';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idMedia, idPropiedad, defecto', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idMedia, idPropiedad, defecto', 'safe', 'on'=>'search'),
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
			'media' => array(self::BELONGS_TO, 'Media', 'idMedia'),
			'propiedad' => array(self::BELONGS_TO, 'Propiedades', 'idPropiedad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idMedia' => 'Id Media',
			'idPropiedad' => 'Id Propiedad',
			'defecto' => 'Defecto',
		);
	}
	public function getDefecto($idPropiedad)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('media');
		$criteria->compare('idPropiedad',$idPropiedad);
		$criteria->compare('defecto',1);
		$res=self::model()->findAll($criteria);
		if(count($res)>0)return $res[0]->media->nombreMedia;
		return null;
	}
	public function consultarImagenes($idPropiedad)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('media');
		$criteria->compare('idPropiedad',$idPropiedad);
		$res=self::model()->findAll($criteria);
		$arr=array();
		foreach($res as $i)$arr[]=$i->media->nombreMedia;
		return $arr;
	}
	public function cargarImagenes($imagenes,$idPropiedad,$defecto)
	{
		$this->quitarTodas($idPropiedad);
		if(isset($imagenes))
			if(count($imagenes)>0)
		foreach($imagenes as $imagen)
			$this->cargarImagen($imagen,$idPropiedad,$defecto);
	}
	private function quitarTodas($idPropiedad)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('media');
		$criteria->compare('idPropiedad',$idPropiedad);
		$res=self::model()->findAll($criteria);
		foreach($res as $i)$arr[]=$i->delete();
	}
	private function cargarImagen($imagen,$idPropiedad,$defecto)
	{
		$img=explode('.',$imagen);
		if(count($img)>=1){
			$img[1]= strtolower($img[1]);
			$fileTypes = array('jpg','jpeg','gif','png'); 
			if(in_array($img[1],$fileTypes))
				$model->type='imagen';
			$model=new Media;
			$model->nombreMedia=$imagen;
			$model->fechaUpdate=Date('Y-m-d H:i:s');
			
			$model->extension=$img[1];
			$model->save();

			$modelLiga=new PropiedadesMedia;
			$modelLiga->idPropiedad=$idPropiedad;
			$modelLiga->defecto=0;
			if($defecto==$img[0])$modelLiga->defecto=1;
			$modelLiga->idMedia=$model->id;
			$modelLiga->save();
		}
		
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('idMedia',$this->idMedia);
		$criteria->compare('idPropiedad',$this->idPropiedad);
		$criteria->compare('defecto',$this->defecto);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}