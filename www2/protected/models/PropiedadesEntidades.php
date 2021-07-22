<?php

/**
 * This is the model class for table "propiedades_entidades".
 *
 * The followings are the available columns in table 'propiedades_entidades':
 * @property integer $id
 * @property integer $idPropiedad
 * @property integer $idEntidad
 * @property integer $idTipoEntidadPropiedad
 * @property string $fecha
 * @property integer $paga
 *
 * The followings are the available model relations:
 * @property Propiedades $idPropiedad0
 * @property Entidades $idEntidad0
 * @property PropiedadesEntidadesTipos $idTipoEntidadPropiedad0
 */
class PropiedadesEntidades extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PropiedadesEntidades the static model class
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
		return 'propiedades_entidades';
	}
	public function getEntidad($idPropiedad,$idTipo,$posicion=0)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('idPropiedad='.$idPropiedad.' AND idTipoEntidadPropiedad='.$idTipo);
		$res= self::model()->findAll($criteria);
		if(count($res)>0)return $res[0]->idEntidad;
		return 0;
	}
	public function quitarAnteriores($idPropiedades)
	{
		$res=$this->buscar($idPropiedades);
		foreach($res as $item) $item->delete();
	}
	public function buscar($idPropiedades)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('idPropiedad='.$idPropiedades);
		return self::model()->findAll($criteria);
	}
	public function getPropiedades($idEntidad)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('propiedad','entidad');
		$criteria->compare('idEntidad',$idEntidad,false);
		$res= self::model()->findAll($criteria);
		return $res;
	}
	public function getPropietarios($idEdificio)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('propiedad','entidad');
		if($idEdificio=="")return Entidades::model()->findAll();
		$criteria->addCondition("propiedad.idEdificio=".$idEdificio);
		$criteria->group='idEntidad';

		$res= self::model()->findAll($criteria);
		$arr = array();
		foreach($res as $model) {
	    	$arr[] = array(
	        'razonSocial'=>$model->entidad->razonSocial,
	        'id'=>$model->idEntidad, 
	        );      
		}
		return $arr;
	}
	public function buscarPropiedades($busca)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('entidad');
		$criteria->compare('entidad.razonSocial',$busca,'OR');
		$criteria->compare('propiedad.nombrePropiedad',$busca,'OR');
		$criteria->select='t.*,count(idPropiedad) as buscar';
		$criteria->order='entidad.razonSocial';
		$criteria->group='idEntidad';
		$res= self::model()->findAll($criteria);
		$arr = array();
		foreach($res as $model) {
	    	$arr[] = array(
	        'label'=>$model->entidad->razonSocial.' ('.$model->buscar.' propiedades) ',
	        'value'=>$model->idEntidad, 
	        );      
		}
		return $arr;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPropiedad, idEntidad, idTipoEntidadPropiedad, paga', 'numerical', 'integerOnly'=>true),
			array('fecha', 'safe'),
			array('fecha,idEntidad,idTipoEntidadPropiedad', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idPropiedad, idEntidad, idTipoEntidadPropiedad, fecha, paga', 'safe', 'on'=>'search'),
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
			'propiedad' => array(self::BELONGS_TO, 'Propiedades', 'idPropiedad'),
			'entidad' => array(self::BELONGS_TO, 'Entidades', 'idEntidad'),
			'tipo' => array(self::BELONGS_TO, 'PropiedadesEntidadesTipos', 'idTipoEntidadPropiedad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idPropiedad' => 'Propiedad',
			'idEntidad' => 'Entidad',
			'idTipoEntidadPropiedad' => 'Tipo',
			'fecha' => 'Fecha',
			'paga' => 'Paga',
		);
	}

	
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idPropiedad',$this->idPropiedad,false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}