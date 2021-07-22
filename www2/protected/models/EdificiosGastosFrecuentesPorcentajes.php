<?php

/**
 * This is the model class for table "edificios_gastosFrecuentes_porcentajes".
 *
 * The followings are the available columns in table 'edificios_gastosFrecuentes_porcentajes':
 * @property integer $id
 * @property integer $idGastoFrecuente
 * @property double $porcentaje
 * @property integer $idTipoPropiedad
 *
 * The followings are the available model relations:
 * @property EdificiosGastosFrecuentes $idGastoFrecuente0
 * @property PropiedadesTipos $idTipoPropiedad0
 */
class EdificiosGastosFrecuentesPorcentajes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EdificiosGastosFrecuentesPorcentajes the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function cargar($idGasto,$porcentajes)
	{
		$this->quitarTodos($idGasto);
		for($i=0;$i<count($porcentajes);$i++)
			$this->cargarGasto($idGasto,$porcentajes[$i]['valor'],$porcentajes[$i]['idTipo']);
	}
	private function cargarGasto($idGasto,$valor,$idTipo)
	{
			$model=new EdificiosGastosFrecuentesPorcentajes;
			$model->idGastoFrecuente=$idGasto;
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
		$criteria->compare('idGastoFrecuente',$idGasto,false);
		$res= self::model()->findAll($criteria);
		if(count($res)>0)return $res[0]->porcentaje;
		return 0;
	}
	private function consultar($id)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idGastoFrecuente',$id,false);
		return self::model()->findAll($criteria);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'edificios_gastosFrecuentes_porcentajes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idGastoFrecuente, idTipoPropiedad', 'numerical', 'integerOnly'=>true),
			array('porcentaje', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idGastoFrecuente, porcentaje, idTipoPropiedad', 'safe', 'on'=>'search'),
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
			'idGastoFrecuente0' => array(self::BELONGS_TO, 'EdificiosGastosFrecuentes', 'idGastoFrecuente'),
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
			'idGastoFrecuente' => 'Id Gasto Frecuente',
			'porcentaje' => 'Porcentaje',
			'idTipoPropiedad' => 'Id Tipo Propiedad',
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
		$criteria->compare('idGastoFrecuente',$this->buscar,'OR');
		$criteria->compare('porcentaje',$this->buscar,'OR');
		$criteria->compare('idTipoPropiedad',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}