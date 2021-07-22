<?php

/**
 * This is the model class for table "paraCobrar".
 *
 * The followings are the available columns in table 'paraCobrar':
 * @property integer $id
 * @property string $detalle
 * @property string $fecha
 * @property double $importe
 * @property integer $idPropiedad
 * @property integer $idEntidad
 * @property string $estado
 * @property integer $idTipoParaCobrar
 *
 * The followings are the available model relations:
 * @property LiquidacionesParaCobrar[] $liquidacionesParaCobrars
 * @property ParaCobrarTipos $idTipoParaCobrar0
 * @property Propiedades $idPropiedad0
 * @property Entidades $idEntidad0
 */
class ParaCobrar extends CActiveRecord
{
	const PENDIENTE='PENDIENTE';
	const CANCELADO='CANCELADO';


	 public $buscar;
	 public $cantidadMeses;
	public $importePago;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getEstados()
	{
		return array(self::PENDIENTE=>'PENDIENTE',self::CANCELADO=>'CANCELADO');
	}
	public function quitar()
	{
		$this->delete();
	}
	public function quitarComprobantes()
	{
		foreach($this->comprobantesItems as $item)$item->delete();
	}
	public function quitarLiquidaciones()
	{
		foreach($this->liquidacionesParaCobrars as $item)$item->delete();
	}
	public function saldado()
	{
		return $this->estado==self::CANCELADO;
	}
	public function vencido()
	{
		return $this->fechaVencimiento<Date('Y-m-d');
	}
	public function getDiasVence()
	{
		$vence = new DateTime($this->fechaVencimiento, new DateTimeZone("UTC"));
		$actual=new DateTime(Date("Y-m-d"), new DateTimeZone("UTC"));
		$interval = date_diff($actual, $vence);
		return ($interval->format('%R%a'));
	}
	public function getColor()
	{
		$diferencia=$this->getDiasVence();
		//var_dump($diferencia*1);exit;
		if($this->estado=="PENDIENTE"){
			if($diferencia<1)return "error";
			if($diferencia<30)return "warning";
		}
		return '';
	}
	public function buscarDeuda($busca,$tipo)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('entidad','propiedad');
		if($tipo=='Entidad')
			$criteria->compare('entidad.razonSocial',$busca,'OR');
		else $criteria->compare('propiedad.nombrePropiedad',$busca,'OR');
		$criteria->select='t.*,count(t.id) as buscar';
		//$criteria->order='entidad.razonSocial';
		$criteria->group=$tipo=='Entidad'?'idEntidad':'idPropiedad';
		$res= self::model()->findAll($criteria);
		$arr = array();
		foreach($res as $model) {
			$valor=$tipo=='Entidad'?$model->idEntidad:$model->idPropiedad;
	    	$arr[] = array(
	        'label'=>$model->entidad->razonSocial.' -  '.$model->propiedad->nombrePropiedad.' - ('.$model->buscar.' elementos) ',
	        'value'=>$valor, 
	        );      
		}
		return $arr;
	}
	private function cargarItems_($idLiquidacion,$propiedad,$idParaCobrar,$cargaCochera=false,$cargoEsp=false)
	{
		$importe=0;
		$coef=1;
		$coeficienteAplica=1;
		$cargoEspecifico=false;
		$porcentajeEdificio=$propiedad->getPorcentajeEdificio($cargaCochera?2:$propiedad->idTipoPropiedad);
		foreach(GastosTipos::model()->findAll() as $tipoGasto){
				if($tipoGasto->id==4 ){//ES ESPECIFICO
					$importe=LiquidacionesGastos::model()->importeGastosEspecificos($propiedad->id,$idLiquidacion);
					$coeficienteAplica=1;
					$coef=1;
					$cargoEspecifico=true;
				}else{
					$importe=Liquidaciones::model()->porTipos($this->propiedad->id,$tipoGasto->id,$idLiquidacion,$cargaCochera,false);
					//LE PONGO EL COEFICIENTE EN LA FUNCION PORTIPOS EN LIQUIDACIONES
					$coef=($cargaCochera?$propiedad->porcentajeCochera:$propiedad->porcentaje);
					
					$coeficienteAplica=($cargaCochera?$propiedad->porcentajeCochera:$propiedad->porcentaje);
					if(Settings::model()->getValorSistema('PORCENTAJE_PROPIEDAD_TIPO')=="1")
						$coef=($coef*100/$porcentajeEdificio) /100;
						
				}
				
				if($cargoEsp && $cargoEspecifico) continue;
					
				$model=new ParaCobrarItems;
				$model->importeSobre=$importe;
				$model->idParaCobrar=$idParaCobrar;
				$model->importe=round($importe*$coef,Settings::model()->getValorSistema('REDONDEO_IMPORTES')*1,PHP_ROUND_HALF_UP);
			
				$model->coeficiente=$coef;
				$model->idTipoGasto=$tipoGasto->id;
				$model->idTipoPropiedad=$cargaCochera?PropiedadesTipos::ID_COCHERA:$propiedad->idTipoPropiedad;
				$model->save();
		}
		return $cargoEspecifico;
	}
	public function ingresarItems($idLiquidacion,$importeFondoReserva)
	{
		$cargoEspecifico=$this->cargarItems_($idLiquidacion,$this->propiedad,$this->id,false,null);
		//$cargaEsp=$cargoEspecifico?false:true;
		if($this->propiedad->tieneCochera)$this->cargarItems_($idLiquidacion,$this->propiedad,$this->id,true,$cargoEspecifico);
		$this->cargarFondoReserva($idLiquidacion,$this->id,$importeFondoReserva);
		$this->recalcularImporte();
	}
	private function recalcularImporte()
	{
		$sum=0;
		foreach($this->items as $item)
			$sum+=$item->importe;
		$this->importe=$sum;
		$this->importeSaldo=$sum;
		$this->save();
		
	}
	private function cargarFondoReserva($idLiquidacion,$idParaCobrar,$importeFondoReserva)
	{
		$liq=Liquidaciones::model()->findByPk($idLiquidacion);
		$coef=100;
		
		$importe=$liq->importeFondoReserva*$coef;
		if($importeFondoReserva>0){
				$model=new ParaCobrarItems;
				$model->idParaCobrar=$idParaCobrar;
				$model->importe=round($importeFondoReserva,Settings::model()->getValorSistema('REDONDEO_IMPORTES')*1,PHP_ROUND_HALF_UP);
				$model->coeficiente=$coef;
				$model->idTipoGasto=3;
				$model->idTipoPropiedad=Propiedades::IDPROPIEDAD;
				$model->save();
		}
	}
	public function getDetalleDeuda()
	{
		$cad='';
		foreach($this->items as $item)$cad.=$item->tipoPropiedad->nombreTipoPropiedad.'-'.$item->importe.'| ';
		return $cad;
	}
	public function tableName()
	{
		return 'paraCobrar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPropiedad, idEntidad, idTipoParaCobrar', 'numerical', 'integerOnly'=>true),
			array('importe,importeSaldo', 'numerical'),
			array('importe,importeSaldo,fecha,idPropiedad,idEntidad', 'required'),
			array('detalle, estado', 'length', 'max'=>255),
			array('fecha,punitorio,fechaVencimiento', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,importeSaldo, detalle, fecha, importe, idPropiedad, idEntidad, estado, idTipoParaCobrar', 'safe', 'on'=>'search'),
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
			'liquidacionesParaCobrars' => array(self::HAS_MANY, 'LiquidacionesParaCobrar', 'idParaCobrar'),
			'items' => array(self::HAS_MANY, 'ParaCobrarItems', 'idParaCobrar'),
			'comprobantesItems' => array(self::HAS_MANY, 'ComprobantesItems', 'idParaCobrar','join'=>'inner join comprobantes on comprobantes.id=comprobantesItems.idComprobante'),
			'tipo' => array(self::BELONGS_TO, 'ParaCobrarTipos', 'idTipoParaCobrar'),

			'propiedad' => array(self::BELONGS_TO, 'Propiedades', 'idPropiedad'),
			'entidad' => array(self::BELONGS_TO, 'Entidades', 'idEntidad'),
			'deptoOrdinario'=>array(self::HAS_ONE, 'ParaCobrarItems', 'idParaCobrar',
                        'on'=>'idTipoGasto=1 and idTipoPropiedad=1'),
			'fondoReserva'=>array(self::HAS_ONE, 'ParaCobrarItems', 'idParaCobrar',
                        'on'=>'idTipoGasto=3'),
			'cocheraOrdinario'=>array(self::HAS_ONE, 'ParaCobrarItems', 'idParaCobrar',
                        'on'=>'idTipoGasto=1 and idTipoPropiedad=2'),
			'deptoExtraordinario'=>array(self::HAS_ONE, 'ParaCobrarItems', 'idParaCobrar',
                        'on'=>'idTipoGasto=2 and idTipoPropiedad=1'),
			'cocheraExtraordinario'=>array(self::HAS_ONE, 'ParaCobrarItems', 'idParaCobrar',
                        'on'=>'idTipoGasto=2 and idTipoPropiedad=2'),
		);
	}
	public function getPagos()
	{
		$res=$this->comprobantesItems;
		$sum=0;
		foreach($res as $item)$sum+=$item->importe;
		return $sum;
	}
	public function getValor($idTipoGasto,$idTipoPropiedad)
	{
		$sum=0;
		if($idTipoPropiedad==null){
			foreach($this->items as $item)
			if($item->idTipoGasto ==$idTipoGasto )$sum+= $item->importe;
		}else{
			foreach($this->items as $item)
			if($item->idTipoGasto ==$idTipoGasto && $item->idTipoPropiedad==$idTipoPropiedad)$sum+= $item->importe;
		}
		
		return $sum;
	}
	
	public function getImporteRecaudadoFondo($idEdificio,$ano)
	{
		$sum=0;
		$res=$this->consultarRecaudadoFondo($idEdificio,$ano);
		foreach($res as $item)$sum+=$item->importe;
		return $sum;
	}
	public function getFondoReserva()
	{
		$sum=0;
		if($this->importeSaldo>0)return 0;
		foreach($this->items as $item)
			if($item->idTipoGasto==3 && $item->idTipoPropiedad==1)$sum+= $item->importe;
		return $sum;
	}
	public function getInteres()
	{
		$dias=Settings::model()->getValorSistema('GENERALES_DIASNTERES')*1;
		$interes=Settings::model()->getValorSistema('GENERALES_INTERESDIARIO')*1;

		$arrFecha=explode('-',$this->fecha);
		$timestamp2 = mktime(0,0,0,$arrFecha[1],$arrFecha[2],$arrFecha[0]); 
		$timestamp1 = mktime(4,12,0,Date('m'),Date('d'),Date('Y'));
		$segundos_diferencia = $timestamp1 - $timestamp2; 
		$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

		if($dias_diferencia<=$dias)return 0;
		$diasDif=$dias_diferencia-$dias;
		return ($this->importe*($interes/100))*$diasDif ;
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'detalle' => 'Detalle',
			'fecha' => 'Fecha',
			'importe' => 'Importe',
			'idPropiedad' => 'Propiedad',
			'idEntidad' => 'Entidad',
			'estado' => 'Estado',
			'idTipoParaCobrar' => 'Tipo',
		);
	}
	public function modificarItems($items)
	{
		foreach($items as $item) $this->modificarItem($item);
	}
	private function modificarItem($item)
	{
		$model=ParaCobrar::model()->findByPk($item['id']);
		$model->importeSaldo-=$item['saldo'];
		$model->estado=$model->importeSaldo==0?ParaCobrar::CANCELADO:ParaCobrar::PENDIENTE;
		$model->save();
	}
	public function busqueda($idPropiedad)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('entidad','propiedad');
		$criteria->compare('propiedad.id',$idPropiedad,false);
		$criteria->compare('t.estado',ParaCobrar::PENDIENTE,false);
		$criteria->order='t.fechaVencimiento';
		return self::model()->findAll($criteria);
	}
	public function pendientes($idEntidad)
	{
		$criteria=new CDbCriteria;

		$criteria->with=array('entidad','propiedad');
		$criteria->addCondition('t.estado="PENDIENTE"');
		$criteria->addCondition('t.idEntidad='.$idEntidad);
		
		
		return self::model()->findAll($criteria);
	}
	public function morosos($idEdificio,$agrupa=true,$idPropiedad=null,$vencidos=false)
	{
		$criteria=new CDbCriteria;

		$criteria->with=array('entidad','propiedad');
		$criteria->addCondition('propiedad.idEdificio='.$idEdificio);
		$criteria->addCondition('t.estado="PENDIENTE"');
		$criteria->order='propiedad.nombrePropiedad';
		if($vencidos)$criteria->addCondition('"'.Date("Y-m-d").'" > t.fechaVencimiento');
		if($agrupa){
			$criteria->group='t.idPropiedad';
			$criteria->select="t.*,SUM(t.importeSaldo) as importe, GROUP_CONCAT( t.fechaVencimiento   SEPARATOR ' | ') as fechaVencimiento,count(t.id) as cantidadMeses";
		}
		if($idPropiedad!=null)$criteria->addCondition('t.idPropiedad='.$idPropiedad);
		
		
		return self::model()->findAll($criteria);
	}
	public function moraEntidad($idEntidad,$agrupa=null)
	{
		$criteria=new CDbCriteria;

		$criteria->with=array('entidad','propiedad');
		$criteria->addCondition('entidad.id='.$idEntidad);
		$criteria->addCondition('t.estado="PENDIENTE"');
		$criteria->order='propiedad.nombrePropiedad';
		// if($vencidos)$criteria->addCondition('"'.Date("Y-m-d").'" > t.fechaVencimiento');
		
		// if($idPropiedad!=null)$criteria->addCondition('t.idPropiedad='.$idPropiedad);
		
		
		$data= self::model()->findAll($criteria);
		if($agrupa){
			$result = array();
			foreach ($data as $element) {
			    $result[$element['idPropiedad']][] = $element;
			}
			return $result;
		}
		return $data;
	}
	private function deudaPropiedad($idProp,$mes,$ano,$agrupa)
	{
		
		$criteria=new CDbCriteria;

		$criteria->addCondition('idPropiedad='.$idProp);
		$criteria->addCondition('YEAR(t.fecha)='.$ano.' AND MONTH(t.fecha)='.$mes);
		if($agrupa){
			$criteria->group='t.idPropiedad';
			$criteria->select="t.*,SUM(t.importeSaldo) as importeSaldo,SUM(t.importe) as importeDeuda, GROUP_CONCAT( t.fechaVencimiento   SEPARATOR ' | ') as fechaVencimiento,count(t.id) as cantidadMeses";
		}
		return self::model()->findAll($criteria);
	}
	public function anual($idEdificio,$ano)
	{
		$salida=[];
		$propiedades=Propiedades::model()->buscarPropiedades("",$idEdificio);
		
		foreach($propiedades as $prop)
		{
			$aux["propiedad"]=$prop;
			$auxDeuda=[];
			for($i=1;$i<=12;$i++){
			$aux_["mes"]=$i;
			$aux_["balance"]=$prop->getDeuda($i,$ano);
			$auxDeuda[]=$aux_;
		}
			$aux["deuda"]=$auxDeuda;
			$salida[]=$aux;
		}
		return $salida;
	}
	
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with=array('entidad');
		$criteria->compare('entidad.razonSocial',$this->buscar,'OR');
		$criteria->order='t.id desc';
		$cantidadPorPagina=Settings::model()->getValorSistema('FORMATO_CANTPAGINA');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array(
        'pageSize'=>$cantidadPorPagina,
    ),
		));
	}
}