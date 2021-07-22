<?php

class LiquidacionesController extends Controller
{
		/**
		* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
		* using two-column layout. See 'protected/views/layouts/column2.php'.
		*/
		public $layout='//layouts/column1';

		/**
		* @return array action filters
		*/
		public function filters()
		{
			return array(
			'accessControl', // perform access control for CRUD operations
			);
		}

		/**
		* Specifies the access control rules.
		* This method is used by the 'accessControl' filter.
		* @return array access control rules
		*/
		public function accessRules()
		{
			return array(
			);
		}
	public static $expensas=null;
	public static $gastos=null;
		public function actionMails()
	{
		$this->layout='//layout/layoutSolo';
		$propietarios=LiquidacionesParaCobrar::model()->porLiquidacion($_GET['id']);
		//$propietarios=array($propietarios[0]);
		
					$conExpensas= $this->actionImprimir($_GET['id'],true,false);
					$expensas=Mail::model()->crearPdf($conExpensas,"expensas_"); // VA A CARPETA FILES

					$conGastos= $this->actionImprimirGastos($_GET['id'],true,false);
					$gastos=Mail::model()->crearPdf($conGastos,"gastos_");// VA A CARPETA FILES
		
		$this->render('mails',array('propietarios'=>$propietarios,'gastos'=>$gastos,'expensas'=>$expensas));
	}
		public function actionEnviaMail($idParaCobrar,$idLiquidacion,$gastos,$expensas,$mensaje)
		{
			
	        	$paraCobrar=ParaCobrar::model()->findByPk($idParaCobrar);
	        	$liquidacion=Liquidaciones::model()->findByPk($idLiquidacion);
	        	$salida=$this->_enviaEmailLiquidacion($idLiquidacion,$paraCobrar->entidad->email,$gastos,$expensas,$idParaCobrar,$mensaje);
	        	echo CJSON::encode($salida);
		}
		
		public function _enviaEmailLiquidacion($idLiquidacion,$destino,$gastos,$expensas,$idParaCobrar,$mensaje)
		{
			$paraCobrar=ParaCobrar::model()->findByPk($idParaCobrar);
			$texto= Mail::model()->getTextoMail($paraCobrar->idEntidad,$mensaje);
					$attach=array($gastos,$expensas);
					 // $attach=[];
					$params['fecha']=Date('d-m-Y');
					$params['titulo']='LIQUIDACIÓN DE EXPENSAS';
					$params['nombreEmpresa']=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION');
					$params['direccion']=Settings::model()->getValorSistema('DATOS_EMPRESA_FANTASIA');
					$params['telefono']=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
					$params['emailAdmin']=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
					$params['horarios']=Settings::model()->getValorSistema('DATOS_EMPRESA_HORARIOS');
					$params['lugarPago']=Settings::model()->getValorSistema('DATOS_EMPRESA_RESENAEMPRESA');
					
					$params['cuerpo']=$texto;
					

					$url="http://".Settings::model()->getValorSistema("DATOS_EMPRESA_URL")."/images/".Settings::model()->getValorSistema("LOGOEMPRESA");
				$logo="<img src='".$url."'></img>";
				$params['logo']=$logo;
					

// 					$fileExp=file_get_contents($expensas);
// 					$fileGastos=file_get_contents($gastos);
					
					$mensaje=Settings::model()->getValorSistema('PLANTILLA_BASE',$params);
					$destinos=explode(';',$destino);
					foreach($destinos as $destino){
						$destino=trim($destino);
						//$destino="alejandro@softer.com.ar";
						$salida['enviado']=Mail::model()->enviarMail($destino,$mensaje,'NUEVA LIQUIDACION EXPENSAS',Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN'),$attach);
			        	$salida['id']=0;
					}
							
			        return $salida;
		}	

		public function actionImprimirGastos($id,$retorna=false,$conImpresion=false)
		{
			//Yii::app()->user->setFlash('info','Presionar la tecla ENTER para realizar la impresion (en caso de no funcionar realizar click sobre la pantalla antes de presionar ENTER)');
			$this->layout="//layouts/layoutSolo";
			$liq=Liquidaciones::model()->findByPk($id);
			$arrFecha=explode('-',$liq->fecha);
			$param['edificio']=$liq->edificio->nombreEdificio;
			
			$param['direccionEdificio']=$liq->edificio->domicilio;
			$param['telefonoEdificio']=$liq->edificio->telefono;
			$param['emailEdificio']=$liq->edificio->email;
			$param['provinciaEdificio']=$liq->edificio->provincia;
			$param['cuitEdificio']=$liq->edificio->cuit;
			$param['localidadEdificio']=$liq->edificio->localidad;
			
			$param['mes']=$this->getMes($arrFecha[1]);
			$param['ano']=$this->getAno($liq->fecha);
			
			$logo=Settings::model()->getValorSistema("LOGOEMPRESA")==""?null:Settings::model()->getValorSistema("LOGOEMPRESA");
			
			
			$param['direccion']=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION');
			$param['razonSocial']= Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL');
			$param['cuit']= Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');
			$param['telefonos']=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
			$param['localidad']=Settings::model()->getValorSistema('DATOS_EMPRESA_LOCALIDAD');
			$param['provincia']=Settings::model()->getValorSistema('DATOS_EMPRESA_PROVINCIA');
			$param['horarios']=Settings::model()->getValorSistema('DATOS_EMPRESA_HORARIOS');
			$param['email']=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');

			$param['lugarPago']=$liq->edificio->lugarPago;
			$param['logo']= $logo!=null? "<img src='images/".$logo."' />":null;
			$param['mes']=$this->getMes($arrFecha[1]);
			$param['gastosOrdinarios']=$this->getGrillaGastos($liq,1);
			$param['gastosEspecificos']=$this->getGrillaGastos($liq,4);
			$param['fondoReserva']=$this->getGrillaFondoReserva($liq->idEdificio);
			$param['gastosExtraordinarios']=$this->getGrillaGastos($liq,2);
			$data=Plantillas::model()->getPlantilla ('GASTOS_EXP', $param);
			$model=Comprobantes::model()->findByPk($id);

			$vista=$this->renderPartial('impresionGastos',array('model'=>$model,'data'=>$data,'conImpresion'=>$conImpresion),true);
			$file=Mail::model()->crearPdf(($vista));
			if($retorna)return $vista;
			header("Location: ".($file));
			//echo $vista;
		}
		private function getGrillaFondoReserva($idEdificio)
		{
			$debito=0;
			$credito=0;
			$saldo=0;
			$edificio=Edificios::model()->findByPk($idEdificio);
			$data=Liquidaciones::model()-> saldoFondoReserva($idEdificio);
		//	if(count($data)==0)return "<h5>No hay registros de fondo de reserva</h5>";
			$cad='<table class="tablaDatos">';
			$cad.='<tr><th style="width:280px">Fecha</th><th>Concepto</th><th style="text-align:right;width:80px">Débito</th><th style="text-align:right;width:80px">Crédito</th><th style="text-align:right;width:80px">Saldo</th></tr>';
			if($edificio->importeFondoReserva>0){
				$importe=$edificio->importeFondoReserva;
				$fechaInicio=Yii::app()->dateFormatter->format("dd/MM/yy",$edificio->fechaInicio);
				$saldo+=$importe;
				$cad.='<tr><th style="width:280px">'.$fechaInicio.'</th><th style="text-align:left;">Inicial del Edificio</th><th style="text-align:right;width:80px">0</th><th style="text-align:right;width:80px">'.number_format($importe,2).'</th><th style="text-align:right;width:80px">'.number_format($saldo,2).'</th></tr>';
			}
			foreach($data as $item){
				$debito+=$item['importe']<0?$item['importe']:0;
				$credito+=$item['importe']>0?$item['importe']:0;

				$aux_debito=$item['importe']<0?$item['importe']:0;
				$aux_credito=$item['importe']>0?$item['importe']:0;
				$saldo+=$item['importe'];
						$cad.='<tr>';
							$cad.='<td>'.Yii::app()->dateFormatter->format("dd/MM/yy",$item["fecha"]).'</td>';
							//$cad.='<td>'.$item->gasto->comprobante->nroComprobante.'</td>';
							$cad.='<td>'.$item["detalle"].'</td>';
							$cad.='<td>'.number_format($aux_debito,2).'</td>';
							$cad.='<td>'.number_format($aux_credito,2).'</td>';
							$cad.='<td style="text-align:right">$ '.number_format($saldo,2).'</td>';
							
						$cad.='</tr>';
			}
			
			$cad.='<tr>';
							$cad.='<td></td>';
							$cad.='<td></td>';
							$cad.='<td><b>$ '.number_format($debito,2).'</b></td>';
							$cad.='<td><b>$ '.number_format($credito,2).'</b></td>';
							$cad.='<td style="text-align:right"><b><big>$ '.number_format($saldo,2).'</big></b></td>';
							
				$cad.='</tr>';
			$cad.='</table>';
			return $cad;
		}
		private function getGrillaGastos($liq,$idTipoGasto)
		{
			$sum=0;
			$totLocal=0;
			$totCoch=0;
			$totDepto=0;
			$cad='<table class="tablaDatos">';
			$cad.='<tr><th style="width:280px">Proveedor</th><th >Concepto</th><th style="width:70px">$ Loc.</th><th style="width:70px">$ Dpto.</th><th style="width:70px">$ Coch.</th><th style="text-align:right;width:80px">Importe</th></tr>';
			foreach($liq->gastos as $item)
				if($item->gasto->idTipoGasto==$idTipoGasto){
					$diferencia=number_format($item->gasto->comprobante->importe-$item->importe,2);// ESTA ES LO QUE RESTA PAGAR QUE NO SE DEBITO DESDE EL FONDO DE RESERVA
					$acotaFondoReserva=$item->gasto->importeFondoReserva!=0?(" | Debito del FONDO RESERVA $".$diferencia):"";
					
					$detalle=$item->gasto->comprobante->detalle.$acotaFondoReserva;
					$impLocal=$item->gasto->porcentajeLocal==null?0:($item->gasto->porcentajeLocal->porcentaje/100)*$item->importe;
					$impDepto=$item->gasto->porcentajeDepto==null?0:($item->gasto->porcentajeDepto->porcentaje/100)*$item->importe;
					$impCochera=$item->gasto->porcentajeCochera==null?0:($item->gasto->porcentajeCochera->porcentaje/100)*$item->importe;
						$sum+=$item->importe;
						$totLocal+=$impLocal;
						$totCoch+=$impCochera;
						$totDepto+=$impDepto;
					$proveedor=$item->gasto->comprobante->entidad->razonSocial;
					if($idTipoGasto==4)$proveedor.="(".$item->gasto->getPropiedadesGastoLabel().")";
						$cad.='<tr>';
							$cad.='<td>'.$proveedor.'</td>';
							//$cad.='<td>'.$item->gasto->comprobante->nroComprobante.'</td>';
							$cad.='<td>'.$detalle.'</td>';
							$cad.='<td>'.number_format($impLocal,2).'</td>';
							$cad.='<td>'.number_format($impDepto,2).'</td>';
							$cad.='<td>'.number_format($impCochera,2).'</td>';
							
							$cad.='<td style="text-align:right">$ '.number_format($item->importe,2).'</td>';
							
						$cad.='</tr>';
			}
			if($liq->importeFondoReserva>0&&$idTipoGasto==2){
				$sum+=$liq->importeFondoReserva;
				$cad.='<tr>';
							$cad.='<td>Otros</td>';
							
							$cad.='<td>A fondo de reserva</td>';
							$cad.='<td></td>';
							$cad.='<td></td>';
							$cad.='<td></td>';
							$cad.='<td style="text-align:right">$ '.number_format($liq->importeFondoReserva,2).'</td>';
							
				$cad.='</tr>';
			}
			$cad.='<tr>';
							$cad.='<td></td>';
							$cad.='<td><b><big>TOTAL</big></b></td>';
							$cad.='<td><b>$ '.number_format($totLocal,2).'</b></td>';
							$cad.='<td><b>$ '.number_format($totDepto,2).'</b></td>';
							$cad.='<td><b>$ '.number_format($totCoch,2).'</b></td>';
							$cad.='<td style="text-align:right"><b><big>$ '.number_format($sum,2).'</big></b></td>';
							
				$cad.='</tr>';
			$cad.='</table>';
			return $cad;
		}
		private function getMes($mes)
	{
		$arr=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$restaMes=Settings::model()->getValorSistema('RESTA_MES_EXPENSAS')+0;
		$ind=$mes-$restaMes-1;
		if($ind<0)$ind=12+$ind;

		return $arr[($ind)];
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
	public function actionImprimir($id,$retorna=false,$conImpresion=false)
	{
		$this->layout="//layouts/layoutVacio";
		$liq=Liquidaciones::model()->findByPk($id);
		$arrFecha=explode('-',$liq->fecha);

		$param['edificio']=$liq->edificio->nombreEdificio;
		$param['direccionEdificio']=$liq->edificio->domicilio;
		$param['telefonoEdificio']=$liq->edificio->telefono;
		$param['emailEdificio']=$liq->edificio->email;
		$param['provinciaEdificio']=$liq->edificio->provincia;
		$param['cuitEdificio']=$liq->edificio->cuit;
		$param['localidadEdificio']=$liq->edificio->localidad;
		$param['direccion']=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION');
		$param['razonSocial']= Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL');
		$param['cuit']= Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');
		$param['telefonos']=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
		$param['localidad']=Settings::model()->getValorSistema('DATOS_EMPRESA_LOCALIDAD');
		$param['provincia']=Settings::model()->getValorSistema('DATOS_EMPRESA_PROVINCIA');
		$param['horarios']=Settings::model()->getValorSistema('DATOS_EMPRESA_HORARIOS');
		$param['email']=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');

		$param['mes']=$this->getMes($arrFecha[1]);
		$param['ano']=$this->getAno($liq->fecha);
		$logo=Settings::model()->getValorSistema("LOGOEMPRESA")==""?null:Settings::model()->getValorSistema("LOGOEMPRESA");
		$param['logo']= $logo!=null? "<img src='images/".$logo."' />":null;
		$param['pago']=$liq->edificio->lugarPago;
		
		$grilla="";
		if(Settings::model()->getValorSistema('FORMATO_EXPENSAS')==1) $grilla=$this->getGrillaExpensas($liq); //EXTENDIDA
		if(Settings::model()->getValorSistema('FORMATO_EXPENSAS')==2) $grilla=$this->getGrillaExpensasResumida($liq); //RESUMIDA
		$param['expensas']=$grilla;
		$param['morosos']=$this->getMorosos($liq);
		$data=Plantillas::model()->getPlantilla ('EXPENSAS', $param);
		
		
		$model=Comprobantes::model()->findByPk($id);
		//Yii::app()->user->setFlash('info','Presionar la tecla ENTER para realizar la impresion (en caso de no funcionar realizar click sobre la pantalla antes de presionar ENTER)');
		$vista=$this->renderPartial('impresion',array('model'=>$model,'data'=>$data,'conImpresion'=>$conImpresion),true);
		$file=Mail::model()->crearPdf( ($vista));
		if($retorna)return $vista;
		//echo $vista;
		header("Location: ".($file));
		//$this->renderPartial('impresion',array('model'=>$model,'data'=>$data,'conImpresion'=>$conImpresion),$retorna);
	}
	private function getMorosos($liquidacion)
	{
		$cad='<div id="tablaMorosos"><h2>MOROSOS</h2>';
		$cad.='<table  class="tablaDatos">';
		$cad.='<tr><th>Un.Func</th><th style="width:250px">Inquilino</th><th>Meses</th><th style="width:95px">Importe</th></tr>';
		$res=ParaCobrar::model()->morosos($liquidacion->idEdificio,true,null,true);
		foreach($res as $item){
				$cad.='<td>'.$item->propiedad->nombrePropiedad.'</td>';
				$cad.='<td>'.$item->entidad->razonSocial.'</td>';
				$cad.='<td>'.$item->cantidadMeses.'</td>';
				$cad.='<th>$ '.number_format($item->importe,2).'</th>';
			$cad.='</tr>';
		}
			
		$cad.='</table></div>';
		return $cad;
	}
	private function getGrillaExpensas($liquidacion)
	{
		$cad='<table class="tablaDatos">';
		$cad.='<tr><th>Un.Func</th><th>Inquilino</th><th>% U.F.</th><th>% Coch.</th><th>Ord.Depto</th><th class="extDepto">Ext.Depto</th><th class="ordCochera">Ord.Coch</th><th class="extCochera">Ext.Coch</th><th class="local">Ord.Local</th><th class="extLocal">Ext.Local</th><th class="especifico">Esp.</th>';
		//$cad.=$this->imprimeColumnasItems($liquidacion);
		if($liquidacion->importeFondoReserva>0)$cad.='<th>$ fondo.r</th>';
		$cad.='<th>Total</th></tr>';
		$acuOrdDepto=0;
		$acuExtDepto=0;
		$acuOrdCochera=0;
		$acuExtCochera=0;
		$acuLocal=0;
		$acuEsp=0;
		$acuExtLocal=0;
		foreach($liquidacion->liquidacionesParaCobrar as $item){
			$auxOrdDepto=($item->paraCobrar->getValor(1,1));
			$auxExtDepto=($item->paraCobrar->getValor(2,1));
			$auxOrdCochera=($item->paraCobrar->getValor(1,2));
			$auxExtCochera=($item->paraCobrar->getValor(2,2));
			$auxLocal=($item->paraCobrar->getValor(1,3));
			$auxExtLocal=($item->paraCobrar->getValor(2,3));
			$auxEsp=($item->paraCobrar->getValor(4,1)+$item->paraCobrar->getValor(4,2)+$item->paraCobrar->getValor(4,3));

			$acuOrdDepto+=$auxOrdDepto;
			$acuExtDepto+=$auxExtDepto;
			$acuOrdCochera+=$auxOrdCochera;
			$acuExtCochera+=$auxExtCochera;
			$acuLocal+=$auxLocal;
			$acuEsp+=$auxEsp;
			$acuExtLocal+=$auxExtLocal;
				
			$auxOrdDepto=number_format($auxOrdDepto,2);
			$auxExtDepto=number_format($auxExtDepto,2);
			$auxOrdCochera=number_format($auxOrdCochera,2);
			$auxExtCochera=number_format($auxExtCochera,2);
			$auxLocal=number_format($auxLocal,2);
			$auxEsp=number_format($auxEsp,2);
			$auxExtLocal=number_format($auxExtLocal,2);
			
			$cad.='<tr>';
				$cad.='<td>'.$item->paraCobrar->propiedad->nombrePropiedad.'</td>';
				$cad.='<td>'.$item->paraCobrar->entidad->razonSocial.'</td>';
				$cad.='<td>'.$item->paraCobrar->propiedad->porcentaje.'</td>';
				$cad.='<td>'.(($item->paraCobrar->propiedad->tieneCochera)?($item->paraCobrar->propiedad->porcentajeCochera):"-").'</td>';


				//$cad.=$this->imprimeItems($item->paraCobrar,$liquidacion);
				$cad.="<td>".$auxOrdDepto."</td>"; // (tipoGasto, tipoPropiedad)
				$cad.="<td class='extDepto'>".$auxExtDepto."</td>";
				
				$cad.="<td class='ordCochera'>".$auxOrdCochera."</td>";
				$cad.="<td class='extCochera'>".$auxExtCochera."</td>";
				$cad.="<td class='local'>".$auxLocal."</td>";
				$cad.="<td class='extLocal'>".$auxExtLocal."</td>";
				$cad.="<td class='especifico'>".$auxEsp."</td>";
				if($liquidacion->importeFondoReserva>0)$cad.="<td>$ ".number_format($item->paraCobrar->getValor(3,null),2)."</td>";
				$cad.='<th>'.number_format($item->paraCobrar->importe,2).'</th>';
			$cad.='</tr>';
		}
		if(Settings::model()->getValorSistema('IMPRIME_SUMA_EXPENSAS')=="1")	$cad.='<tr><th></th><th></th><th></th><th></th><th>'.number_format($acuOrdDepto,2).'</th><th class="extDepto">'.number_format($acuExtDepto,2).'</th><th class="ordCochera">'.number_format($acuOrdCochera,2).'</th><th class="extCochera">'.number_format($acuExtCochera,2).'</th><th class="local">'.number_format($acuLocal,2).'</th><th class="especifico">'.number_format($acuEsp,2).'</th>';
		
		if(Settings::model()->getValorSistema('IMPRIME_SUMA_EXPENSAS')=="1")if($liquidacion->importeFondoReserva>0)$cad.='<th>$ fondo.r</th>';
		if(Settings::model()->getValorSistema('IMPRIME_SUMA_EXPENSAS')=="1")$totalTotal=$acuOrdDepto+$acuOrdCochera;
		if(Settings::model()->getValorSistema('IMPRIME_SUMA_EXPENSAS')=="1")$cad.='<th>'.number_format($totalTotal,2).'</th></tr>';
		$cad.='</table>';
		if($acuExtDepto==0)$cad.="<script>$('.extDepto').hide();</script>";
		if($acuOrdCochera==0)$cad.="<script>$('.ordCochera').hide();</script>";
		if($acuExtCochera==0)$cad.="<script>$('.extCochera').hide();</script>";
		if($acuLocal==0)$cad.="<script>$('.local').hide();</script>";
		if($auxExtLocal==0)$cad.="<script>$('.extLocal').hide();</script>";
		if($acuEsp==0)$cad.="<script>$('.especifico').hide();</script>";

		return $cad;
	}
	private function getGrillaExpensasResumida($liquidacion)
	{
		$cad='<table class="tablaDatos">';
		$cad.='<tr><th>Un.Func</th><th>Responsable de Pago</th><th>% U.F.</th><th>% Coch.</th><th>$ Depto</th><th class="colCochera">$ Cochera</th><th class="colLocal">$ Local</th>';
		//$cad.=$this->imprimeColumnasItems($liquidacion);
// 		if($liquidacion->importeFondoReserva>0)$cad.='<th>$ fondo.r</th>';
		$cad.='<th>Total</th></tr>';
		
		$acuLocal=0;
		$acuCochera=0;
		$acuDepto=0;
		foreach($liquidacion->liquidacionesParaCobrar as $item){
			$auxOrdDepto=($item->paraCobrar->getValor(1,1));
			$auxExtDepto=($item->paraCobrar->getValor(2,1));
			$auxOrdCochera=($item->paraCobrar->getValor(1,2));
			$auxExtCochera=($item->paraCobrar->getValor(2,2));
			$auxLocal=($item->paraCobrar->getValor(1,3));
			$auxExtLocal=($item->paraCobrar->getValor(2,3));
			$auxEsp=($item->paraCobrar->getValor(4,1)+$item->paraCobrar->getValor(4,2)+$item->paraCobrar->getValor(4,3));


			$_auxDepto=$auxOrdDepto+$auxExtDepto+$auxEsp;
			$_auxCochera=$auxOrdCochera+$auxExtCochera;
			$_auxLocal=$acuLocal+$auxExtLocal;
			
			$acuLocal+=$_auxLocal;
			$acuDepto+=$_auxDepto;
			$acuCochera+=$_auxCochera;
			
			$cad.='<tr>';
				$cad.='<td>'.$item->paraCobrar->propiedad->nombrePropiedad.'</td>';
				$cad.='<td>'.$item->paraCobrar->entidad->razonSocial.'</td>';
				$cad.='<td>'.$item->paraCobrar->propiedad->porcentaje.'</td>';
				$cad.='<td>'.(($item->paraCobrar->propiedad->tieneCochera)?($item->paraCobrar->propiedad->porcentajeCochera):"-").'</td>';


				//$cad.=$this->imprimeItems($item->paraCobrar,$liquidacion);
				$cad.="<td class='colDepto'>".number_format($_auxDepto,2)."</td>";
				
				$cad.="<td class='colCochera'>".number_format($_auxCochera,2)."</td>";
				$cad.="<td class='colLocal'>".number_format($_auxLocal,2)."</td>";
			
				$cad.='<th>'.number_format($item->paraCobrar->importe,2).'</th>';
			$cad.='</tr>';
		}
	if(Settings::model()->getValorSistema('IMPRIME_SUMA_EXPENSAS')=="1")	$cad.='<tr><th></th><th></th><th></th><th></th>';
		if(Settings::model()->getValorSistema('IMPRIME_SUMA_EXPENSAS')=="1")$cad.='<th class="colDepto">'.number_format($acuDepto,2).'</th>';
		if(Settings::model()->getValorSistema('IMPRIME_SUMA_EXPENSAS')=="1")$cad.='<th class="colCochera">'.number_format($acuCochera,2).'</th>';
		if(Settings::model()->getValorSistema('IMPRIME_SUMA_EXPENSAS')=="1")$cad.='<th class="colLocal">'.number_format($acuLocal,2).'</th>';
		if(Settings::model()->getValorSistema('IMPRIME_SUMA_EXPENSAS')=="1")$cad.='<th>'.number_format($acuDepto+$acuCochera+$acuLocal,2).'</th>';
		if(Settings::model()->getValorSistema('IMPRIME_SUMA_EXPENSAS')=="1")$cad.='</tr>';
		$cad.='</table>';
		if($acuDepto==0)$cad.="<script>$('.colDepto').hide();</script>";
		if($acuCochera==0)$cad.="<script>$('.colCochera').hide();</script>";
		if($acuLocal==0)$cad.="<script>$('.colLocal').hide();</script>";

		return $cad;
	}
	private function imprimeColumnasItems($liquidacion)
	{
		//<th>% Depto.</th><th>Ordinarias Dpto.</th><th>% Cochera</th><th>Ordinarias Cochera</th><th>Extr. Depto.</th><th>Extr. Cochera</th>
		$cad='';
		foreach(PropiedadesTipos::model()->paraImpresion() as $tipo)
			$cad.="<td>% ".$tipo->nombreTipoCorto."</td>";

		foreach(PropiedadesTipos::model()->paraImpresion() as $tipo)
			foreach(GastosTipos::model()->paraImpresion() as $itemGasto)
				$cad.="<td>".$itemGasto->nombreTipoCorto.' '.$tipo->nombreTipoCorto."</td>";
		
		
		return $cad;
	}
	private function imprimeItems($paraCobrar,$liquidacion)
	{
		$cad='';
		
		foreach(PropiedadesTipos::model()->paraImpresion() as $tipo)
			foreach(GastosTipos::model()->paraImpresion() as $itemGasto)
				$cad.="<td>$ ".number_format($paraCobrar->getValor($itemGasto->id,$tipo->id),2)."</td>";
		return $cad;
	}
	private function getRow($item,$campo,$num=null)
	{
		if($item==null)return '-';
		if($num) return '$ '.number_format($item->$campo,2);
		return $item->coeficiente;
	}

		public function actionView($id)
		{
			$this->render('view',array(
			'model'=>$this->loadModel($id),
			));
		}
		public function actionCargar()
		{
			$model=new Liquidaciones;
			$model->importeFondoReserva=$_GET['importeFondoReserva'];
			$model->idEdificio=$_GET['idEdificio'];
			$model->fecha=$_GET['fecha'];
			$model->importe=$_GET['importe'];
			$model->fechaVto=$_GET['fechaVto'];
			$arr["error"]=true;
			if($model->save()){
				LiquidacionesGastos::model()->cargarGastos($model->id,$_GET['gastos']);
				
				$err=LiquidacionesParaCobrar::model()->ingresarParaCobrar($model->id,$_GET['fondoReserva']);
				$arr["error"]=$err;
			}
			$arr["codError"]=$model->errors;
			echo CJSON::encode($arr);
			/*Yii::app()->session['idEdificio'] = $model->idEdificio;
					LiquidacionesGastos::model()->cargarGastos($model->id,$_POST['gastos']);
					LiquidacionesParaCobrar::model()->ingresarParaCobrar($model->id);
					Yii::app()->user->setFlash('success', "<b>Exito</b> Se ha creado la Liquidacion satisfactoriamente!");
					$this->redirect(array('index','id'=>$model->id));
					return;*/
		}
		public function actionCreate()
		{
			$model=new Liquidaciones;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			
			$model->importeFondoReserva=0;
			$model->idEdificio=Yii::app()->session['idEdificio'];
			$model->fecha=Date('Y-m-d');
			$model->fechaVto=Date('Y-m-d');
			$this->render('create',array(
				'model'=>$model,
			));
		}
		private function getImportePendiente($items)
		{
			$sum=0;
			foreach($items as $item)
				if($item["tipo"]=="comp")$sum+=$item['saldo']+$item['interes'];
			return $sum;
		}
		public function actionIngresar()// INGRESA EL COMPROBANTE DE INGRESAR PARA COBRAR
		{
			$arrFecha=explode('-',$_GET['fecha']);
			$fecha=$arrFecha[2].'-'.$arrFecha[1].'-'.$arrFecha[0];
			$estado="";
			$arr["id"]="no";
			$importe=$_GET['importe']-$this->getImportePendiente($_GET['items']);
			$importePaga=$_GET['importePaga']-$this->getImportePendiente($_GET['items']);
   
			if($this->tieneItemsComprobante($_GET['items']))
				$arr["idsComp"]=ComprobantesPagosPendientes::model()->ingresar(isset($_GET['items'])?$_GET['items']:array());
				
			
			if($this->tieneItemsParaCobrar($_GET['items']))
      $arr=Comprobantes::model()->ingresarComprobante($_GET['idEntidad'],$importe,$fecha,$_GET['items'],$_GET['interes'],$_GET['bonificacion'],$_GET['estado'],$_GET['idTalonario'],$_GET['idTipoComprobante'],$_GET['nroComprobante'],0,$importePaga,$_GET['idPropiedad'],$_GET['diferencia']);
      $propiedad=Propiedades::model()->findByPk($_GET['idPropiedad']);
      $propiedad->ingresarSaldo($_GET['diferencia']); //en caso de que tenga
			
			echo CJSON::encode($arr);
		}
		
		private function tieneItemsComprobante($items)
		{
			foreach($items as $item)
				if($item["tipo"]=="comp")return true;
			return false;
		}
		private function tieneItemsParaCobrar($items)
		{
			foreach($items as $item)
				if($item["tipo"]=="paraCobrar")return true;
			return false;
		}
		private function enviarMail($id)
		{

		}
		private function ingresarCredito($idEntidad,$importe,$items)
		{
			$resto=$importe-$this->getImporteTotalItems($items);
			Entidades::model()->ingresarCredito($idEntidad,-$resto);
		}
		private function getImporteTotalItems($items)
		{
			$tot=0;
			foreach($items as $item) $tot+=$item['saldo'];
			return $tot;
		}
		public function actionUpdate($id)
		{
			$model=$this->loadModel($id);

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['Liquidaciones']))
			{
				$model->attributes=$_POST['Liquidaciones'];
				if($model->save())
					$this->redirect(array('index','id'=>$model->id));
			}

			$this->render('update',array(
				'model'=>$model,
			));
		}

		public function actionQuitarLiquidacion($id)
		{
			try{
				LiquidacionesGastos::model()->cambiarEstado($id,"PENDIENTE");
				LiquidacionesParaCobrar::model()->quitarParaCobrar($id);
				$this->loadModel($id)->delete();
				$this->redirect(array('index'));
				}catch (Exeption $e){
					throw new CHttpException(02,'No puede eliminar la liquidacion ya que pueden existir comprobantes realizados bajo esta liquidación!');
				}
			
		}

		/**
		* Lists all models.
		*/
		public function actionIndex()
		{
			
			$model= new Liquidaciones;
			if(isset($_GET['Liquidaciones'])){
				$model->idEdificio=$_GET['Liquidaciones']['idEdificio'];
				Yii::app()->session['idEdificio'] = $_GET['Liquidaciones']['idEdificio'];

			}else $model->idEdificio=Yii::app()->session['idEdificio'] ;
			
			$this->render('index',array(
			'dataProvider'=>$model,
			));
		}

		/**
		* Returns the data model based on the primary key given in the GET variable.
		* If the data model is not found, an HTTP exception will be raised.
		* @param integer the ID of the model to be loaded
		*/
		public function loadModel($id)
		{
			$model=Liquidaciones::model()->findByPk($id);
			if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
			return $model;
		}

		/**
		* Performs the AJAX validation.
		* @param CModel the model to be validated
		*/
		protected function performAjaxValidation($model)
		{
			if(isset($_POST['ajax']) && $_POST['ajax']==='liquidaciones-form')
			{
			echo CActiveForm::validate($model);
			Yii::app()->end();
			}
		}
}
