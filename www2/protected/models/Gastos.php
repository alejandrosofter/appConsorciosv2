<?php

/**
 * This is the model class for table "gastos".
 *
 * The followings are the available columns in table 'gastos':
 * @property integer $id
 * @property integer $idEdificio
 * @property integer $idTipoGasto
 * @property string $estado
 * @property integer $idComprobante
 * @property integer $idGastoLigado
 *
 * The followings are the available model relations:
 * @property GastosTipos $idTipoGasto0
 * @property Edificios $idEdificio0
 * @property Comprobantes $idComprobante0
 * @property Gastos $idGastoLigado0
 * @property Gastos[] $gastoses
 * @property LiquidacionesGastos[] $liquidacionesGastoses
 */
class Gastos extends CActiveRecord
{
	const LIQUIDADO='LIQUIDADO';
	const PENDIENTE='PENDIENTE';
	const FONDORESERVA=3;
	public function getEstados()
	{
		return array(self::PENDIENTE=>'PENDIENTE',self::LIQUIDADO=>'LIQUIDADO');
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gastos the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getCoefDepto()
	{
		if($this->porcentajeDepto)return $this->porcentajeDepto->porcentaje;
		return 0;
	}
	public function getCoefCochera()
	{
		if($this->porcentajeCochera)return $this->porcentajeCochera->porcentaje;
		return 0;
	}
	public function getCoefLocal()
	{
		if($this->porcentajeLocal)return $this->porcentajeLocal->porcentaje;
		return 0;
	}
	public function getValores($porcentajes,$idGasto=null)
	{
		$arr=array();

		if($idGasto==null){
			$arr[]=100;
			for($i=1;$i<count($porcentajes);$i++)$arr[]=0;

		}
		else
		for($i=0;$i<count($porcentajes);$i++)$arr[]=GastosPorcentajes::model()->getValor($idGasto,$porcentajes[$i]->id);
		return $arr;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gastos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idEdificio, idTipoGasto, idComprobante, idGastoLigado', 'numerical', 'integerOnly'=>true),
			array('estado,importeFondoReserva', 'length', 'max'=>255),
			array('esFondoReserva, importeFondoReserva','safe'),
			array('estado,idEdificio,idTipoGasto', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idEdificio,importeFondoReserva, idTipoGasto, estado, idComprobante, idGastoLigado', 'safe', 'on'=>'search'),
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
			'tipo' => array(self::BELONGS_TO, 'GastosTipos', 'idTipoGasto'),
			'edificio' => array(self::BELONGS_TO, 'Edificios', 'idEdificio'),
			'comprobante' => array(self::BELONGS_TO, 'Comprobantes', 'idComprobante'),
			'gastos' => array(self::HAS_MANY, 'Gastos', 'idGastoLigado'),
			'propiedadesEspecifico' => array(self::HAS_MANY, 'GastosEspecificio', 'idGasto'),
			'porcentajes' => array(self::HAS_MANY, 'GastosPorcentajes', 'idGasto'),
			'porcentajeDepto' => array(self::HAS_ONE, 'GastosPorcentajes', 'idGasto','on'=>'idTipoPropiedad=1'),
			'porcentajeCochera' => array(self::HAS_ONE, 'GastosPorcentajes', 'idGasto','on'=>'idTipoPropiedad=2'),
			'porcentajeLocal' => array(self::HAS_ONE, 'GastosPorcentajes', 'idGasto','on'=>'idTipoPropiedad=3'),
			'liquidaciones' => array(self::HAS_MANY, 'LiquidacionesGastos', 'idGasto'),
		);
	}
	public function getPropiedadesGastoString()
	{
		$cad='[';
		foreach($this->propiedadesEspecifico as $prop)$cad.=$prop->idPropiedad.',';
		$cad.='0]';
		return $cad;
	}
	public function actionImporte2()
	{
		return $this->importe;
	}
	public function tieneLaPropiedad($idPropiedad)
	{
		foreach($this->propiedadesEspecifico as $item)
			if($item->idPropiedad==$idPropiedad)return true;
		return false;
	}
	public function porcentajePropiedadGasto()
	{
		return (100/count($this->propiedadesEspecifico))/100;
	}
	public function getPropiedadesGastoLabel()
	{
		$cad='';
		foreach($this->propiedadesEspecifico as $prop)$cad.=$prop->propiedad->nombrePropiedad.'|';
		
		return $cad;
	}
	public function getLabelPorcentajes()
	{
		$lab="";
		foreach($this->porcentajes as $porc){
			$lab.=''.$porc->tipoPropiedad->nombreTipoPropiedad.' <strong> '.$porc->porcentaje.' %</strong><br>';
		}
		return $lab;
	}
	public function getGastosFondosReserva($idEdificio,$ano=null)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('comprobante');
		if($ano!=null)$criteria->addCondition('YEAR(comprobante.fecha)='.$ano);
		$criteria->addCondition('t.importeFondoReserva<>0');
		$criteria->addCondition('t.idEdificio='.$idEdificio);

		return self::model()->findAll($criteria);
	}
	public function getImporteGastosFondoReserva($idEdificio,$ano=null)
	{
		$res=$this->getGastosFondosReserva($idEdificio,$ano);
		$sum=0;
		foreach($res as $gasto)$sum+=$gasto->importeFondoReserva;
		return $sum;
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idEdificio' => 'Edificio',
			'idTipoGasto' => 'Tipo',
			'esFondoReserva' => 'Es fondo Reserva?',
			'estado' => 'Estado Liquidación',
			'idComprobante' => 'Comprobante',
			'idGastoLigado' => 'Id Gasto Ligado',
		);
	}
	
	public function paraLiquidar($idEdificio,$estado)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idEdificio',$idEdificio,false);
		$criteria->compare('estado',$estado,false);

		return self::model()->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idEdificio',$this->idEdificio,false);
		$criteria->compare('estado',$this->estado);
		$criteria->order='t.id desc';
		$cantidadPorPagina=Settings::model()->getValorSistema('FORMATO_CANTPAGINA');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array(
        'pageSize'=>$cantidadPorPagina,
    ),
		));
	}
}