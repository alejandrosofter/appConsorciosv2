<?php

/**
 * This is the model class for table "liquidaciones_gastos".
 *
 * The followings are the available columns in table 'liquidaciones_gastos':
 * @property integer $id
 * @property integer $idLiquidacion
 * @property integer $idGasto
 * @property double $importe
 *
 * The followings are the available model relations:
 * @property Liquidaciones $idLiquidacion0
 * @property Gastos $idGasto0
 */
class LiquidacionesGastos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LiquidacionesGastos the static model class
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
		return 'liquidaciones_gastos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, idLiquidacion, idGasto', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idLiquidacion, idGasto, importe', 'safe', 'on'=>'search'),
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
			'idLiquidacion0' => array(self::BELONGS_TO, 'Liquidaciones', 'idLiquidacion'),
			'gasto' => array(self::BELONGS_TO, 'Gastos', 'idGasto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idLiquidacion' => 'Id Liquidacion',
			'idGasto' => 'Id Gasto',
			'importe' => 'Importe',
		);
	}

	public function cargarGastos($id,$gastos)
	{
		foreach($gastos as $gasto)$this->cargarGasto($gasto["idGasto"],$id);
	}
	public function porLiquidacionLiquidar($idLiquidacion,$idTipoGasto=null)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('gasto');
		$criteria->compare('idLiquidacion',$idLiquidacion,false);
		if($idTipoGasto!=null)$criteria->compare('gasto.idTipoGasto',$idTipoGasto,false);
		return self::model()->findAll($criteria);
	}

	public function importeGastosEspecificos($idPropiedad,$idLiquidacion)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('gasto');
		$criteria->compare('idLiquidacion',$idLiquidacion,false);
		$criteria->compare('gasto.idTipoGasto',4,false); // ES GASTO ESPECIFICO
		$res= self::model()->findAll($criteria);
		$sum=0;
		foreach($res as $item)
			if($item->gasto->tieneLaPropiedad($idPropiedad)) {
				$coef=$item->gasto->porcentajePropiedadGasto();
				$aux=$item->gasto->comprobante->importe*$coef;
				$sum+=$aux;
		}
		return $sum;
	}
	public function cambiarEstado($id,$estado)
	{
		$items=$this->porLiquidacion($id);
		foreach($items as $item){
			$item->gasto->estado=$estado;
			$item->gasto->save();
		}
	}
	private function cargarGasto($gasto,$id)
	{
		$modelGasto=Gastos::model()->findByPk($gasto);
		$model=new LiquidacionesGastos;
		$model->idLiquidacion=$id;
		$model->idGasto=$gasto;
		$model->importe=$modelGasto->comprobante->importe-($modelGasto->importeFondoReserva*1);

		if($model->save()){
			$modelGasto->estado=Gastos::LIQUIDADO;
			$modelGasto->save();
		}else{
			print_r($model->errors);
		}
	}
	public function porLiquidacion($idLiquidacion)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idLiquidacion',$idLiquidacion,false);

		return self::model()->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('idLiquidacion',$this->buscar,'OR');
		$criteria->compare('idGasto',$this->buscar,'OR');
		$criteria->compare('importe',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}