<?php

/**
 * This is the model class for table "liquidaciones".
 *
 * The followings are the available columns in table 'liquidaciones':
 * @property integer $id
 * @property string $fecha
 * @property string $detalle
 * @property integer $idEdificio
 * @property double $importe
 *
 * The followings are the available model relations:
 * @property Edificios $idEdificio0
 * @property LiquidacionesGastos[] $liquidacionesGastoses
 * @property LiquidacionesItems[] $liquidacionesItems
 */
class Liquidaciones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Liquidaciones the static model class
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
		return 'liquidaciones';
	}
	public function beforeDelete()
	{
		LiquidacionesParaCobrar::model()->quitar($this->id);
		return parent::beforeDelete();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idEdificio', 'numerical', 'integerOnly'=>true),
			array('importe', 'numerical'),
			array('importe,idEdificio,fecha', 'required'),
			array('fecha, fechaVto, detalle,importeFondoReserva', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,fechaVto, fecha, detalle, idEdificio, importe', 'safe', 'on'=>'search'),
		);
	}
	public function detallePorGasto($propiedad)
	{
		$tot="";
		foreach($propiedad->porcentajes as $porcentaje){
			$importe=$this->porTipoPropiedad($porcentaje->idTipoPropiedad,$propiedad,$porcentaje->porcentaje);
			$tot.=$porcentaje->tipo->nombreTipoPropiedad.': $'.$importe.' | ';
		}
		return $tot;
	}
	
	public function saldoFondoReserva($idEdificio)
	{
		$connection=Yii::app()->getDb();
		$sql="(select fecha,concat('ACREDITACION POR LIQUIDACION') as detalle,importeFondoReserva as importe from liquidaciones where importeFondoReserva<>0 and liquidaciones.idEdificio=".$idEdificio.") union 
(select liquidaciones.fecha,comprobantes.detalle as detalle,-gastos.importeFondoReserva as importe from liquidaciones_gastos inner join gastos on gastos.id= liquidaciones_gastos.idGasto inner join comprobantes on comprobantes.id=gastos.idComprobante inner join liquidaciones on liquidaciones.id=liquidaciones_gastos.idLiquidacion where gastos.importeFondoReserva>0 and liquidaciones.idEdificio=".$idEdificio.")";
        $command=$connection->createCommand($sql);
         
         return $command->query();
	}
	public function porTipos($idPropiedad,$idTipoGasto,$idLiquidacion,$esCochera=false,$redondea=true)
	{
		$prop=Propiedades::model()->findByPk($idPropiedad);
		$items=LiquidacionesGastos::model()->porLiquidacionLiquidar($idLiquidacion,$idTipoGasto);
		$importe=0;
		foreach($items as $item){
			//$coef=($esCochera?$prop->porcentajeCochera:$prop->porcentaje)/100;
			$coefGasto=$this->getCoeficienteGasto($idPropiedad,$item,$esCochera);
			$importe+=($item->importe*$coefGasto);
		}
		if($redondea) return round($importe,Settings::model()->getValorSistema('REDONDEO_IMPORTES')*1,PHP_ROUND_HALF_UP);
		return $importe;
	}
	//ACA LE PONGO EL COEFICIENTE DEPENDIENDO DEL GASTO QUE Y PROPUEDAD QUE SEA
	private function getCoeficienteGasto($idPropiedad,$itemLiquidacionGasto,$esCochera)
	{
		$res=1;
		$prop=Propiedades::model()->findByPk($idPropiedad);

		if($prop->idTipoPropiedad==1)$res= isset($itemLiquidacionGasto->gasto->porcentajeDepto)?$itemLiquidacionGasto->gasto->porcentajeDepto->porcentaje:0;
		
		if($prop->idTipoPropiedad==3)$res= isset($itemLiquidacionGasto->gasto->porcentajeLocal)? $itemLiquidacionGasto->gasto->porcentajeLocal->porcentaje:0;
		if($prop->idTipoPropiedad==2)$res= isset($itemLiquidacionGasto->gasto->porcentajeCochera)?$itemLiquidacionGasto->gasto->porcentajeCochera->porcentaje:0;
if($esCochera)$res= isset($itemLiquidacionGasto->gasto->porcentajeCochera)?$itemLiquidacionGasto->gasto->porcentajeCochera->porcentaje:0; // ACA ESTABA EL PUTO BUG!!! liquidaba con importe de Unidad Funcional
		return $res/100;
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'edificio' => array(self::BELONGS_TO, 'Edificios', 'idEdificio'),
			'gastos' => array(self::HAS_MANY, 'LiquidacionesGastos', 'idLiquidacion'),
			'liquidacionesItems' => array(self::HAS_MANY, 'LiquidacionesItems', 'idLiquidacion'),
			'liquidacionesParaCobrar' => array(self::HAS_MANY, 'LiquidacionesParaCobrar', 'idLiquidacion', 'order'=>'propiedades.ordenamiento','on'=>'isNull(propiedades.idPropiedadPadre)','join'=>'inner join paraCobrar on paraCobrar.id=liquidacionesParaCobrar.idParaCobrar left join propiedades on propiedades.id=paraCobrar.idPropiedad'),
		);
	}
	public function porPropiedad($idEdificio,$cantidad)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('t.idEdificio='.$idEdificio);
		$criteria->limit=$cantidad;
		return self::model()->findAll($criteria);
	}
	public function getFondosReserva($idEdificio,$ano=null)
	{
		$criteria=new CDbCriteria;
		if($ano!=null)$criteria->addCondition('YEAR(t.fecha)='.$ano);
		$criteria->addCondition('t.idEdificio='.$idEdificio);

		return self::model()->findAll($criteria);
	}
	
	
	public function importeReserva($idEdificio,$ano=null)
	{
		$res=$this->getFondosReserva($idEdificio,$ano);
		$sum=0;
		foreach($res as $liq)$sum+=$liq->importeFondoReserva;
		return $sum;
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha',
			'importeFondoReserva' => 'Importe de reserva',
			'detalle' => 'Detalle',
			'idEdificio' => 'Edificio',
			'importe' => 'Importe',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idEdificio',$this->idEdificio);
		$criteria->order='t.id desc';
	$cantidadPorPagina=Settings::model()->getValorSistema('FORMATO_CANTPAGINA');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array(
        'pageSize'=>$cantidadPorPagina,
    ),
		));
	}
}