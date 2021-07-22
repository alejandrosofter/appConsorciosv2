<?php

/**
 * This is the model class for table "gastos_porcentajes".
 *
 * The followings are the available columns in table 'gastos_porcentajes':
 * @property integer $id
 * @property integer $idGasto
 * @property double $porcentaje
 * @property integer $idTipoPropiedad
 *
 * The followings are the available model relations:
 * @property Gastos $idGasto0
 * @property PropiedadesTipos $idTipoPropiedad0
 */
class GastosPorcentajes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GastosPorcentajes the static model class
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
		return 'gastos_porcentajes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idGasto, idTipoPropiedad', 'numerical', 'integerOnly'=>true),
			array('porcentaje', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idGasto, porcentaje, idTipoPropiedad', 'safe', 'on'=>'search'),
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
			'idGasto0' => array(self::BELONGS_TO, 'Gastos', 'idGasto'),
			'tipoPropiedad' => array(self::BELONGS_TO, 'PropiedadesTipos', 'idTipoPropiedad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idGasto' => 'Id Gasto',
			'porcentaje' => 'Porcentaje',
			'idTipoPropiedad' => 'Id Tipo Propiedad',
		);
	}
	public function cargarManual($idGasto,$porcentajes,$porcentajeDepto=null,$porcentajeCochera=null,$porcentajeLocal=null)
	{
		for($i=0;$i<count($porcentajes);$i++)
			$this->cargarGasto($idGasto,$porcentajes[$i]->porcentaje,$porcentajes[$i]->idTipoPropiedad);
		if($porcentajeDepto)$this->cargarGasto($idGasto,$porcentajeDepto,1);
		if($porcentajeCochera)$this->cargarGasto($idGasto,$porcentajeCochera,2);
		if($porcentajeLocal)$this->cargarGasto($idGasto,$porcentajeLocal,3);
	}
	public function cargar($idGasto,$porcentajes)
	{
		$this->quitarTodos($idGasto);
		for($i=0;$i<count($porcentajes);$i++)
			$this->cargarGasto($idGasto,$porcentajes[$i]['valor'],$porcentajes[$i]['idTipo']);
	}
	private function cargarGasto($idGasto,$valor,$idTipo)
	{
			$model=new GastosPorcentajes;
			$model->idGasto=$idGasto;
			$model->idTipoPropiedad=$idTipo;
			$model->porcentaje=$valor;
			$model->save();
	}
	private function quitarTodos($idGasto)
	{
		$res=$this->consultar($idGasto);
		foreach($res as $item)$item->delete();
	}
	public function getValor($idGasto,$id)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idTipoPropiedad',$id,false);
		$criteria->compare('idGasto',$idGasto,false);
		$res= self::model()->findAll($criteria);
		if(count($res)>0)return $res[0]->porcentaje;
		return 0;
	}
	private function consultar($id)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idGasto',$id,false);
		return self::model()->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('idGasto',$this->buscar,'OR');
		$criteria->compare('porcentaje',$this->buscar,'OR');
		$criteria->compare('idTipoPropiedad',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}