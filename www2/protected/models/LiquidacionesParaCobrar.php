<?php

/**
 * This is the model class for table "liquidaciones_paraCobrar".
 *
 * The followings are the available columns in table 'liquidaciones_paraCobrar':
 * @property integer $id
 * @property integer $idLiquidacion
 * @property integer $idParaCobrar
 *
 * The followings are the available model relations:
 * @property ParaCobrar $idParaCobrar0
 * @property Liquidaciones $idLiquidacion0
 */
class LiquidacionesParaCobrar extends CActiveRecord
{
	public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function quitar($idLiquidacion)
	{
		$res=$this->porLiquidacion($idLiquidacion);
		foreach($res as $item){
			//$id=$item->idParaCobrar;
			//$item->delete();
			//$pc=ParaCobrar::model()->findByPk($id);
			//$pc->delete();
		}
	}
	public function quitarParaCobrar($id)
	{
		try{
			$items=$this->porLiquidacion($id);
			foreach($items as $item){
			$pc=$item->paraCobrar;
			
			$item->delete();
			if(isset($pc->id))$pc->delete();
		}
		}catch (Exeption $e){
					throw new CHttpException(02,'No puede eliminar la liquidación ya que pueden existir comprobantes realizados bajo esta liquidación!');
				}
		
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'liquidaciones_paraCobrar';
	}
	public function ingresarParaCobrar($idLiquidacion,$fondoReserva)
	{
		$modelLiquidacion=Liquidaciones::model()->findByPk($idLiquidacion);
	
		$propiedades=$modelLiquidacion->edificio->propiedades;
		foreach($propiedades as $propiedad)
			if($propiedad->estado==Propiedades::ACTIVA)$this->ingresarDeuda($propiedad,$modelLiquidacion,$this->getImporteFondoReserva($propiedad->id,$fondoReserva));
	}
	private function getImporteFondoReserva($idPropiedad,$importes)
	{
		
		foreach($importes as $item){
			//echo "idprop:".$item["idPropiedad"]. "VS ".$idPropiedad." impo:".$item["importe"];
			if($item["idPropiedad"]==$idPropiedad)return $item["importe"];
		}
		return null;
	}
	private function getMesLetras($mes)
	{
		$arr=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		return $arr[($mes)];
	}
	public function getMes($fecha)
	{
		$arr=explode('-',$fecha);
		$restaMes=Settings::model()->getValorSistema('RESTA_MES_EXPENSAS')+0;
		$ind=$arr[1]-$restaMes-1;
		if($ind<0)$ind=12+$ind;
		return $this->getMesLetras($ind);
	}
	private function getAno($fecha)
	{
		$arr=explode('-',$fecha);
		$ano=$arr[0];
		$restaMes=Settings::model()->getValorSistema('RESTA_MES_EXPENSAS')+0;
		$ind=$arr[1]-$restaMes-1;
		if($ind<0)$ano--;
		return $ano;
	}
	private function ingresarDeuda($propiedad,$liquidacion,$importeFondoReserva)
	{
		$model=new ParaCobrar;
		$model->fecha=$liquidacion->fecha;
		// LOS IMPORTES SE RECALCULAN UNA VEZ INGRESADOS LOS ITEMS
		$model->importe=0;
		$model->importeSaldo=0;
		$idEntidad=isset($propiedad->idEntidadPaga)?$propiedad->idEntidadPaga:$propiedad->inquilino->id;
		$model->detalle="Expensas ".$this->getMes($model->fecha).' de '.$this->getAno($model->fecha);
		$model->idPropiedad=$propiedad->id;
		$model->idEntidad=$idEntidad;
		$model->punitorio=Settings::model()->getValorSistema('GENERALES_INTERESDIARIO').'%';
		$model->estado=ParaCobrar::PENDIENTE;
		$model->idTipoParaCobrar=ParaCobrarTipos::ID_EXPENSA;
		$model->fechaVencimiento=$liquidacion->fechaVto;
		try{
			$model->save();
		}catch(Exception $e){
			return false;
		}
		if($model->save()){
			//ACA SE CARGAN LOS ITEMS QUE LUEGO SE RECALCULA PARA DAR CON EL TOTAL
		$model->ingresarItems($liquidacion->id,$importeFondoReserva);
		if($propiedad->importeFavor<0){
			$idEntidad=$propiedad->inquilino?$propiedad->inquilino->id:$propiedad->propietario->id;
			$importe=$model->importe;
			$fecha=Date("Y-d-m");
			$interesDescuento=0;
			$estado="PENDIENTE";
			$talonario=Talonarios::model()->getPredeterminado();
			$importeFavor=$propiedad->importeFavor;
			$items=$this->getItemsImporteFavor($model);
			$pago=-$propiedad->importeFavor; //IMPORTE FAVOR VIENE EN NEGATIVO
			$saldoFavor=$model->importe-$propiedad->importeFavor;
			if($saldoFavor<0)$pago=$model->importe;
			Comprobantes::model()->ingresarManual($items,$idEntidad,$importe,$fecha,"PAGO DE EXPENSAS IMPORTE A FAVOR",$interesDescuento,$interesDescuento,$estado,$talonario->id,null,$talonario->proximo+1,$importeFavor,$pago);
			$propiedad->importeFavor=$saldoFavor<0?($saldoFavor):0;
			$propiedad->save();
		}
		$modelCobrar=new LiquidacionesParaCobrar;
		$modelCobrar->idLiquidacion=$liquidacion->id;
		$modelCobrar->idParaCobrar=$model->id;
		$modelCobrar->save();

		}else{
			return false;
		}
		
		return true;
	}

	private function getItemsImporteFavor($paraCobrar)
	{
		$arr=[];
		$aux['detalle']=$paraCobrar->detalle;
		$aux['cantidad']=1;
		$aux['importe']=$paraCobrar->importeSaldo;
		$aux['descuento']=0;
		$aux['id']=$paraCobrar->id;
		
		$arr[]=$aux;
		return $arr;
		
		
	}
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idLiquidacion, idParaCobrar', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idLiquidacion, idParaCobrar', 'safe', 'on'=>'search'),
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
			'paraCobrar' => array(self::BELONGS_TO, 'ParaCobrar', 'idParaCobrar'),
			'liquidacion' => array(self::BELONGS_TO, 'Liquidaciones', 'idLiquidacion'),
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
			'idParaCobrar' => 'Id Para Cobrar',
		);
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
		$criteria->compare('idLiquidacion',$this->idLiquidacion,false);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}