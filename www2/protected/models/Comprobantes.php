<?php

/**
 * This is the model class for table "comprobantes".
 *
 * The followings are the available columns in table 'comprobantes':
 * @property integer $id
 * @property integer $idEntidad
 * @property double $importe
 * @property string $detalle
 * @property string $fecha
 * @property string $estado
 * @property string $nroComprobante
 * @property integer $idTipoComprobante
 *
 * The followings are the available model relations:
 * @property Entidades $idEntidad0
 * @property ComprobantesTipos $idTipoComprobante0
 * @property ComprobantesComprobantes[] $comprobantesComprobantes
 * @property ComprobantesComprobantes[] $comprobantesComprobantes1
 * @property Gastos[] $gastoses
 * @property LiquidacionesItemsComprobantes[] $liquidacionesItemsComprobantes
 */
include_once(dirname(__FILE__)."/../controllers/facturacionElectronica/FacturaElectronica.php");
class Comprobantes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comprobantes the static model class
	 */
	 public $buscar;
	 const CANCELADO='CANCELADO';
	const PENDIENTE='PENDIENTE';
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function restaurarQuitar()
	{
		$model=$this;
		$model->quitarItems();
		$model->quitarPagos();
		$this->quitarPagosPendientes();
		$model->delete();
	}

	public function quitarItems()
	{
		foreach($this->items as $item){
			$paraCobrar=ParaCobrar::model()->findByPk($item->idParaCobrar);
			if($paraCobrar!=null){
				//$paraCobrar->importeSaldo+=$item->importe;
				$paraCobrar->estado=ParaCobrar::PENDIENTE;
				$paraCobrar->save();
			}
			
			$item->delete();

		}
			
	}

	public function quitarPagos()
	{
		$creditos=0;
		foreach($this->pagos as $pago){
      $pago->devolverSaldo();
			$pago->delete();
			$creditos+=$pago->credito;
		}
		Entidades::model()->ingresarCredito($this->idEntidad,-$creditos);
			
		
	}
	public function getEstados()
	{
		return array(self::PENDIENTE=>'PENDIENTE',self::CANCELADO=>'CANCELADO');
	}
	public function ingresarComprobante2($idEntidad,$importe,$fecha,$items,$interesDescuento,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor)
	{
		$resElec=null;
		$id=null;
		if(Talonarios::model()->findByPk($idTalonario)->esElectronico){
			$resElec=$this->ingresarElectronico($importe,$idEntidad,$fecha,$idTalonario);
			if($resElec->FeCabResp->Resultado=='A'){
				$id=$this->_ingresaComprobante2($items,$idEntidad,$importe,$fecha,$idTipoComprobante==1?Settings::model()->getValorSistema('TEXTO_COMP_EXPENSAS'):"",$interesDescuento,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor);
				$this->_ingresaRtaElectronica($id,$resElec);
			}
		}else{
			$id=$this->_ingresaComprobante2($items,$idEntidad,$importe,$fecha,$idTipoComprobante==1?Settings::model()->getValorSistema('TEXTO_COMP_EXPENSAS'):"",$interesDescuento,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor);
		}
		
		
		return array('id'=>$id,'resElectronico'=>$resElec);
	}
	public function ingresarManual($items,$idEntidad,$importe,$fecha,$txtExp,$interes,$bonificacion,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor,$saldo)
	{
		$res=$this->_ingresaComprobante2($items,$idEntidad,$importe,$fecha,$txtExp,$interes,$bonificacion,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor,$saldo);
		return $res;
	}
		
		private function _ingresaRtaElectronica($idComprobante,$data)
	{
		$model=new ComprobantesRespuestaElectronica;
		$model->idComprobante=$idComprobante;
		$model->cae=$data->FeDetResp->FECAEDetResponse->CAE;
		$model->fechaVence=$data->FeDetResp->FECAEDetResponse->CAEFchVto;
		$model->estado=$data->FeDetResp->FECAEDetResponse->Resultado;
		$model->save();
	}//idTipoComprobante,$nroComprobante,$diferencia,$idPropiedad
	private function _ingresaComprobante($items,$idEntidad,$importe,$fecha,$txtExp,$interes,$bonificacion,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor,$idPropiedad=null)
	{
			$id=$this->ingresarComp($idEntidad,$importe,$fecha,$txtExp,$interes,$bonificacion,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor,$idPropiedad);
			//INCREMENTO TALONARIOO
			$tal=Talonarios::model()->findByPk($idTalonario);
	    	if($tal!=null)$tal->incrementaProximo();
	    	//INC TALONARIO
			$this->ingresarItems2($items,$id);
			return $id;
	}
	private function ingresarElectronico($importe,$idEntidad,$fecha,$idTalonario)
	{
		$entidad=Entidades::model()->findByPk($idEntidad);
		$talonario=Talonarios::model()->findByPk($idTalonario);
		$path=dirname(__FILE__).'/../../certificadosElectronicos/';
		$cuit=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');
		$talonario=Talonarios::model()->findByPk($idTalonario);

		$f=new FacturaElectronica($path.$talonario->certificadoElectronico->archivoCertificado,$path.$talonario->certificadoElectronico->archivoKey,$idTalonario);
		$tipo=$talonario->getTipoElectronico();
		$pventa=Settings::model()->getValorSistema('DATOS_EMPRESA_PUNTOVENTA');
		$nroSig=$f->proximoAutorizar ($pventa,$tipo,$cuit)+1;
		$tipoDoc=$entidad->getTipoElectronico();
		$iva21=0;
		$iva105=0;
		$concepto= 1;
		
		$facturaElectronica=$this->getFacturaElectronica($importe,$idEntidad,$fecha,$nroSig,$tipo,$tipoDoc,$concepto);
		
		return($f->ingresarFactura($cuit,$pventa,$tipo, $facturaElectronica,1));
	}
	 private function getFacturaElectronica($importe,$idEntidad,$fecha,$proximoNumero,$tipo,$tipoDoc=80,$concepto=1, $tributoImp=0,$tributoIva=0)
	{
	    $datosTributo=null;
	    $datosIva=null;
	    $datosIva2=null;
	    $entidad=Entidades::model()->findByPk($idEntidad);
	     $cuitCliente=str_replace(' ','',str_replace('-', '', $entidad->cuit))+0;
	    if($tipo==6||$tipo==7||$tipo==8)
	        $cuitCliente=0;
	    else $cuitCliente=str_replace(' ','',str_replace('-', '',$entidad->cuit))+0;
	    
	    
	        $datosTributo['Id']=99;
	        $datosTributo['Desc']='Impuesto';
	        $datosTributo['BaseImp']=round($tributoImp,2);
	        $datosTributo['Alic']=$tributoIva;
	        $datosTributo['Importe']=round($tributoImp*$tributoIva,2);
	    
	  
	    
	    $fecha=explode(' ', $fecha);
	    //si es FACTURA C (11) no va con IVA
	    $importeIva=$tipo==11? 0:round($importe*0.21,2);
	    $importeNeto=$tipo==11?round($importe,2):round($importe-($importe*0.21),2);
	    $res=array(
	                   'Concepto' => $concepto,
	                   'DocTipo' => $tipoDoc,//80 cuit
	                   'DocNro' => $cuitCliente,//23111111113
	                   'CbteDesde' => $proximoNumero,//*
	                   'CbteHasta' => $proximoNumero,//*
	                   
	//                   'CbteFch' => str_replace('-','',$fecha[0]),//*
	                    'CbteFch' => Date('Ymd'),
	                   'ImpTotal' => round($importe,2), //importe total
	                   'ImpTotConc' => 0, //0
	                   'ImpNeto' => $importeNeto, //importe neto
	                   'ImpOpEx' => 0, //importe neto
	                   'ImpTrib' => 0, //importe *
	                   'ImpIVA' =>$importeIva , //importe *
	                   'FchServDesde' => '', //importe neto *
	                   'FchServHasta' => '', //importe neto *
	                   'FchVtoPago' => '', //importe neto *
	                   'MonId' => 'PES', //PES *
	                   'MonCotiz' => 1, //1 *
	                   //'Tributos'=>array('Tributo' =>$this->getTributo($datosTributo)),
	                   'Iva'=>array(
	                       'AlicIva'=>$this->getIva(5,$importeNeto,$importeIva)
	                           ),
	                    
	                    );
	    //if($datosTributo!=null) $res['Tributos']=array('Tributo' =>$this->getTributo($datosTributo));
	    if($tipo==11)$res['Iva']=null;
	    return $res;
	}
private function getIvaDos($iva105,$iva21)
{
    $res=array();
    if($iva105!=null) $res[]=$iva105;
    if($iva21!=null) $res[]=$iva21;
    return $res;
}
private function getTributo($datos)
{
    if($datos==null) return array();
     $res=array(
                   'Id' => $datos['Id'],
                   'Desc' => $datos['Desc'],
                   'BaseImp' => $datos['BaseImp'],//80 cuit
                   'Alic' => $datos['Alic'],//80 cuit
                   'Importe' => $datos['Importe'],//23111111113
                    );
    return $res;
}
private function getIva($idIva,$base,$importe)
{
    $res= array(//5 el 21, 4 el 10.5
                   'Id' => $idIva,
                   'BaseImp' => $base,//ej 100
                   'Importe' => $importe,//ej 21
                    );
    return (object)$res;
}
	public function _getTextoComprobate($id,$conImpresion=false)
	{
		$model=Comprobantes::model()->findByPk($id);
		$params['letra']=isset($model->talonario)?$model->talonario->letraTalonario:"s/n";
		$logo=Settings::model()->getValorSistema("LOGOEMPRESA")==""?null:Settings::model()->getValorSistema("LOGOEMPRESA");
		$params["nombreEmpresa"]=Settings::model()->getValorSistema("DATOS_EMPRESA_RAZONSOCIAL");
		$params['logo']= $logo!=null? "<img src='images/".$logo."' />":null;
		$params['detallePago']=isset($model->item->paraCobrar)?$this->grillaDetalle($model):$this->grillaDetalleItems($model);
		$params['nroComprobante']=str_pad($model->nroComprobante,5,'0', STR_PAD_LEFT);
		$params['concepto']=$model->detalle;

		$params=$this->getDatosEntidad(isset($model->item->paraCobrar)?$model->item->paraCobrar->propiedad:null,null,$params,'emisor');
		$params=$this->getDatosEntidad(null,$model->entidad,$params,'receptor');
		
		//$V=new EnLetras();
		//$params['importeLetras']=$V->ValorEnLetras($model->importe+$model->interesDescuento-$model->importeFavor,'');
		$date = date_create($model->fecha);
		$params['fecha']= date_format($date, 'd/m/Y');
		$texto=Yii::app()->controller->renderPartial('plantillaComprobante',array('params'=>$params),true);
		Yii::app()->controller->layout="//layouts/layoutSolo";
		return Yii::app()->controller->renderPartial('impresion',array('texto'=>$texto,'conImpresion'=>$conImpresion),true);
	}
	public function getDatosEntidad($propiedad,$entidad,$params,$nombreParam)
	{
		if($propiedad!=null)
		
			if($propiedad->edificio!=null){
				$params['telefono_'.$nombreParam]=$propiedad->edificio->telefono;
				$params['razonSocial_'.$nombreParam]=$propiedad->edificio->razonSocialConsorcio;
				$params['cuit_'.$nombreParam]=$propiedad->edificio->cuit;
				$params['direccion_'.$nombreParam]=$propiedad->edificio->domicilio;
				$params['detalle_'.$nombreParam]='CONSORCIO DE EDIFICIOS';
				$params['condicionIva_'.$nombreParam]=$propiedad->edificio->condicionIva->nombreIva;
				$params['email_'.$nombreParam]=$propiedad->edificio->email;
				return $params;
			
			
		}
		if($entidad==null){
			$params['razonSocial_'.$nombreParam]=Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL');
			$params['cuit_'.$nombreParam]=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')=="s/cuit"?"":Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');
			$params['direccion_'.$nombreParam]=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION');
			$params['telefono_'.$nombreParam]=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
			$params['condicionIva_'.$nombreParam]=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA');
			$params['email_'.$nombreParam]=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
			$params['logo_'.$nombreParam]="<img src='images/".Settings::model()->getValorSistema("logoEmpresa")."'></img>";
		}else{
			$params['telefono_'.$nombreParam]=$entidad->telefono;
			$params['razonSocial_'.$nombreParam]=$entidad->razonSocial;
			$params['cuit_'.$nombreParam]=$entidad->cuit==""?"s/cuit":$entidad->cuit;
			$params['direccion_'.$nombreParam]=$entidad->domicilio==""?"s/ domicilio":$entidad->domicilio;
			$params['detalle_'.$nombreParam]=$entidad->detalle;
			$params['condicionIva_'.$nombreParam]=$entidad->condicionIva->nombreIva;
			$params['email_'.$nombreParam]=$entidad->email;
		}
		return $params;
	}

	private function grillaDetalleItems($model)
	{
		$cad='<table class="table table-condensed">';
		$cad.=' <colgroup>
  </colgroup>';
		$cad.='<tr><th style="width:50px">Cant.</th><th>Detalle</th><th style="width:50px">Int.</th><th style="width:90px">Unidad</th><th style="width:90px">Total</th></td>';
		$sum=0;
		$interesTotal=0;
		$tot=0;
		$subTotales="";
		foreach($model->items as $item){
			$tot+=$item->importe;
			$parc=$item->importe+$item->decuentoInteres;
			$sum+=$parc;
			$interesTotal+=$item->decuentoInteres;
			$cad.='<tr >';
				$cad.='<td>'.$item->cantidad.'</td>';
				$cad.='<td>'.$item->detalle.'</td>';
				$cad.='<td> $ '.number_format($item->decuentoInteres,2).'</td>';
				$cad.='<td> $ '.number_format($item->importe,2).'</td>';
				$cad.='<td> $ '.number_format($item->importe*$item->cantidad,2).'</td>';
				
			$cad.='</tr>';
		}
		if(isset($model->talonario))
		if($model->talonario->letraTalonario=='A'){
			$iva=number_format($model->importe*0.21,2);
			$sub=number_format($model->importe-$iva,2);
			$subTotales='<b>SUB-TOTAL</b> $ '.$sub;
			$subTotales.=' | <b>IVA TOTAL</b> $ '.$iva;
		}
		//if($model->importeFavor>0)
		//$cad.='<tr ><td></td><td><small>Importe a favor usado</small></td><td></td><td></td><td><small>- $ '.number_format($model->importeFavor,2).'</small></td></tr>';
		//if($model->importe>$tot)
		//$cad.='<tr ><td></td><td><small>Importe a favor</small></td><td></td><td></td><td></td><td></td><td><small> $ '.number_format($model->importe-$tot,2).'</small></td></tr>';
		
		if($interesTotal<$model->interesDescuento)
				$cad.='<tr ><td></td><td><small>Interés adicional</small></td><td></td><td></td><td></td><td></td><td></td><td></td><td><small> $ '.number_format($model->interesDescuento-$interesTotal,2).'</small></td></tr>';
				$cad.='<tr >';
				$cad.='<td></td>';
				$cad.='<td>'.$subTotales.'</td>';
				$cad.='<td> </td>';
				$cad.='<td><big><big>TOTAL</big></big></td>';
				$cad.='<td><big><big> $ '.number_format($model->importe+$model->interesDescuento-$model->importeFavor,2).'</big></big></td>';
			$cad.='</tr>';
		

		$cad.='</table>';
		if(isset($model->comprobanteElectronico))$cad.='<table class="table"> <tr><td><b>CAE</b> '.$model->comprobanteElectronico->cae.' | <b>VTO</b> '.$model->comprobanteElectronico->fechaVence.'</tr></table>';
		return $cad;
	}
	private function grillaDetalle($model)
	{
		$cad='<table width="100%"  border="1" cellpadding="0" class="tablaItems" cellspacing="0">';
		
		$cad.='<tr>
<th colspan="1" rowspan="2"
style="vertical-align: top;vertical-align: bottom;  text-align: center;width:30px ">Prop<br>
</th>
<th colspan="1" rowspan="2"
style="vertical-align: top;vertical-align: bottom;  ">Concepto</th>

<th colspan="3" class="columnaDepto" rowspan="1" id="colDepto"
style="vertical-align: top;vertical-align: bottom;  text-align: center;">Depto.<br>
</th>
<th colspan="3" class="columnaCochera" scope="col"  id="colCochera" rowspan="1" style="vertical-align: top; text-align: center;">Cochera<br></th>
<th colspan="3" class="columnaLocal"  id="colLocal" rowspan="1" style="vertical-align: top; text-align: center;">Local<br></th>
<th colspan="1" rowspan="2" style="vertical-align: top;vertical-align: bottom;width:30px ">$Resv.</th>
<th colspan="1" rowspan="2"style="vertical-align: top;vertical-align: bottom;  text-align: center;width:30px">Interes</th>
<th colspan="1" rowspan="2" style="vertical-align: top;vertical-align: bottom; ">Total<br>
</th>
</tr>
<tr>
<th  class="columnaDepto" style="vertical-align: top; text-align: center;">Ord.<br>
</th>
<th  class="columnaDepto" style="vertical-align: top; text-align: center;">Ext.<br>
</th>
<th  class="columnaDepto" style="vertical-align: top; text-align: center;">Esp.<br>
</th>
<th  class="columnaCochera" style="vertical-align: top; text-align: center;">Ord.<br>
</th>
<th class="columnaCochera" style="vertical-align: top; text-align: center;">Ext.<br>
</th>
<th class="columnaCochera" style="vertical-align: top; text-align: center;">Esp.<br>
</th>
<th class="columnaLocal" style="vertical-align: top; text-align: center;">Ord.<br>
</th>
<th class="columnaLocal" style="vertical-align: top; text-align: center;">Ext.<br>
</th>
<th class="columnaLocal" style="vertical-align: top; text-align: center;">Esp.<br>
</th>
</tr>
';
		$sum=0;
		$interesTotal=0;
		$tot=0;
		$totDepto=0;
		$totCochera=0;
		$totLocal=0;
		$subTotal=0;
		foreach($model->items as $item){
			$subTotal+=$item->importe;
			$total=$item->importe+$item->decuentoInteres;
			$tot+=$total;
			$totDepto+=$item->paraCobrar->getValor(1,1)+$item->paraCobrar->getValor(2,1)+$item->paraCobrar->getValor(4,1);
			$totCochera+=$item->paraCobrar->getValor(1,2)+$item->paraCobrar->getValor(2,2)+$item->paraCobrar->getValor(4,2);
			$totLocal+=$item->paraCobrar->getValor(1,3)+$item->paraCobrar->getValor(2,3)+$item->paraCobrar->getValor(4,3);
			$cad.='<tr>
						<td style="vertical-align: top;width:60px ; text-align: center;padding-left:5px;padding-right:5px"><small>'.$item->paraCobrar->propiedad->nombrePropiedad.'</small></td>
						<td style="vertical-align: top; padding-left:5px;padding-right:5px"><small>'.$item->detalle.'</small></td>

						<td class="columnaDepto" style="vertical-align: top; text-align: center;"><small> '.number_format($item->paraCobrar->getValor(1,1),2).'</small></td>
						<td class="columnaDepto" style="vertical-align: top; text-align: center;"><small> '.number_format($item->paraCobrar->getValor(2,1),2).'</small></td>
						<td class="columnaDepto" style="vertical-align: top; text-align: center;"><small> '.number_format($item->paraCobrar->getValor(4,1),2).'</small></td>
						<td class="columnaCochera" style="vertical-align: top; text-align: center;"><small> '.number_format($item->paraCobrar->getValor(1,2),2).'</small></td>
						<td class="columnaCochera" style="vertical-align: top; text-align: center;"><small> '.number_format($item->paraCobrar->getValor(2,2),2).'</small></td>
						<td class="columnaCochera" style="vertical-align: top; text-align: center;"><small> '.number_format($item->paraCobrar->getValor(4,2),2).'</small></td>
						<td class="columnaLocal" style="vertical-align: top; text-align: center;"><small> '.number_format($item->paraCobrar->getValor(1,3),2).'</small></td>
						<td class="columnaLocal" style="vertical-align: top; text-align: center;"><small> '.number_format($item->paraCobrar->getValor(2,3),2).'</small></td>
						<td class="columnaLocal" style="vertical-align: top; text-align: center;"><small> '.number_format($item->paraCobrar->getValor(4,3),2).'</small></td>
						<td style="vertical-align: top; text-align: center;"><small> '.number_format($item->paraCobrar->getValor(3,1),2).'</small></td>
						<td style="vertical-align: top; text-align: center;padding-left:5px;padding-right:5px"><small> '.number_format($item->decuentoInteres,2).'</small></td>
						<td style="vertical-align: top;width:60px ;padding-right:5px; text-align: right;"><small> '.number_format($total,2).'</small></td>
					</tr>';
			
		}
		
		//if($model->importeFavor>0)
		//$cad.='<tr ><td></td><td><small>Importe a favor usado</small></td><td></td><td></td><td></td><td></td><td></td><td></td><td><small>- $ '.number_format($model->importeFavor,2).'</small></td></tr>';
		
		$totalTotal=$tot;
		$cad.='</table>';
		$cad.="<div style='float:right'>";
		$cad.='<table  border="1" cellpadding="0" cellspacing="0">';
		$cad.="<tr><td  style='padding:3px'><span>SUB-TOTAL</td><td style='padding:5px'> $".number_format($subTotal,2)."</span></td></tr>";
		$cad.="<tr><td  style='padding:3px'><span>INTERÉS</td><td style='padding:5px'> $".number_format($model->interes,2)."</span></td></tr>";
		$cad.="<tr><td  style='padding:3px'><span>BONIFICACIÓN</td><td style='padding:5px'> $".number_format($model->bonificacion,2)."</span></td></tr>";
		$cad.="<tr><td  style='padding:3px'><span><b>TOTAL</td><td style='padding:5px'> $".number_format($totalTotal,2)."</span></b></td></tr>";
		$cad.="</table>";
		$cad.='</div>';

		$restaPago=$totalTotal-$model->getImportePagado();
		$lab=$restaPago<0?"IMPORTE A FAVOR":"IMPORTE A PAGAR";
		$cad.="<div style='float:left'>";
		$cad.='<table  border="1" cellpadding="0" cellspacing="0">';
		$cad.="<tr><td  style='padding:3px'><span>IMPORTE PAGADO</td><td style='padding:5px'> $".number_format($model->getImportePagado(),2)."</span></td></tr>";
		$cad.="<tr><td  style='padding:3px'><span>".$lab."</td><td style='padding:5px'> $".number_format($restaPago,2)."</span></td></tr>";
		
		$cad.="</table>";
		
		$cad.='</div>';
		if($totDepto==0)$cad.="<script>$('.columnaDepto').hide();</script>";
		if($totCochera==0)$cad.="<script>$('.columnaCochera').hide();</script>";
		if($totLocal==0)$cad.="<script>$('.columnaLocal').hide();</script>";
		return $cad;
	}
	private function agregarEspacios($e)
	{
		$aux='';
		for($i=$e;$i<=4;$i++)
			$aux.='<td>-</td>';
		return $aux;
	}
	
	private function agregarCreditos($imp,$tot)
	{
		$cad='';
		if($imp-$tot>0){
			$cad.='<tr class="success">';
				
				$cad.='<td colspan="2">En concepto de crédito a favor</td>';
				$cad.='<td> - </td>';
				$cad.='<td>$ '.number_format($imp-$tot,2).' </td>';
				$cad.='<td> - </td>';
			$cad.='</tr>';
		}
		if($imp-$tot<0){
			$cad.='<tr class="error">';
				
				$cad.='<td colspan="2">En concepto de USO de crédito a favor</td>';
				$cad.='<td> - </td>';
				$cad.='<td>$ '.number_format($imp-$tot,2).' </td>';
				$cad.='<td> - </td>';
			$cad.='</tr>';
		}
		return $cad;
	}
	private function subDetalleGrilla($itemComp)
	{
		$cad='';
		$sum=0;
		foreach(PropiedadesTipos::model()->paraImpresion() as $tipo)
			foreach(GastosTipos::model()->paraImpresion() as $itemGasto){
				$valor=$itemComp->paraCobrar->getValor($itemGasto->id,$tipo->id);
				$sum+=$valor;
				$cad.="<td><small>$ ".number_format($valor,2)."</small></td>";
			}
					
		
		$cad.="<td><small>$ ".number_format($itemComp->paraCobrar->getFondoReserva(),2)."</small></td>";
		return $cad.'';
	}
public function enviarComprobante($id,$email=null){
	//$dest es por si se quiere enviar a otro mail que no sea el de la entidad
	$text= ($this->_getTextoComprobate($id,false));
	$file=Mail::model()->crearPdf($text,"_comp");
	$model=Comprobantes::model()->findByPk($id);
	$destino=isset($email)?$email:$model->entidad->email;

		$params['fecha']=Date('d-m-Y');
		$params['titulo']='COMPROBANTE Nro '.$model->nroComprobante;
		$params['nombreEmpresa']=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION');
		$params['direccion']=Settings::model()->getValorSistema('DATOS_EMPRESA_FANTASIA');
		$params['telefono']=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO');
		$params['emailAdmin']=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN');
		$url="http://".Settings::model()->getValorSistema("DATOS_EMPRESA_URL")."/images/".Settings::model()->getValorSistema("LOGOEMPRESA");
				$logo="<img src='".$url."'></img>";
				$params['logo']=$logo;
		$params['cuerpo']= Yii::app()->controller->renderPartial('/comprobantes/comprobanteMail',array(),true);
		$mensaje=Settings::model()->getValorSistema('PLANTILLA_BASE',$params);
			
		$destinos=explode(';',$destino);
		//$data=file_get_contents($file);
		$attachs=array($file);
		//$attachs=array();
		foreach($destinos as $destino){
		
		$res=Mail::model()->enviarMail($destino,$mensaje,'COMPROBANTE Nro '.$model->nroComprobante,Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN'),$attachs);
	}
	return $res;
		
}
public function getNombre()
{
	return $this->entidad->razonSocial.'- nro '.$this->nroComprobante;
}
	public function ingresarComprobante($idEntidad,$importe,$fecha,$items,$interes,$bonificacion,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor,$importePago=0,$idPropiedad=null,$diferencia=null)
	{
		$id=null;
		$resElec=null;
		if(Talonarios::model()->findByPk($idTalonario)->esElectronico){
			$resElec=$this->ingresarElectronico($importe,$idEntidad,$fecha,$idTalonario);
			if($resElec->FeCabResp->Resultado=='A'){//,$nroComprobante,$importeFavor,$idPropiedad=null)
				$id=$this->_ingresaComprobante2($items,$idEntidad,$importe,$fecha,$idTipoComprobante==1?Settings::model()->getValorSistema('TEXTO_COMP_EXPENSAS'):"",$interes,$bonificacion,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor,$idPropiedad);
				$this->_ingresaRtaElectronica($id,$resElec);
			}
		}else
					$id=$this->_ingresaComprobante($items,$idEntidad,$importe,$fecha,$idTipoComprobante==1?Settings::model()->getValorSistema('TEXTO_COMP_EXPENSAS'):"",$interes,$bonificacion,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$diferencia,$idPropiedad);
    $importePago+=$interes-$bonificacion;
		if($id!=null)Pagos::model()->procesarPago($id,$importePago,$diferencia,$interes,$idPropiedad);
		return array('id'=>$id,'resElectronico'=>$resElec);
	}
	private function _ingresaComprobante2($items,$idEntidad,$importe,$fecha,$txtExp,$interes,$bonificacion,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor,$saldo=null,$idPropiedad=null)
	{//($items,$idEntidad,$importe,$fecha,$idTipoComprobante==1?Settings::model()->getValorSistema('TEXTO_COMP_EXPENSAS'):"",$interes,$bonificacion,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor,$idPropiedad);
			$id=$this->ingresarComp($idEntidad,$importe,$fecha,$txtExp,$interes,$bonificacion,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor,$idPropiedad);
		
			//INCREMENTO TALONARIO
			$tal=Talonarios::model()->findByPk($idTalonario);
	    if($tal!=null)$tal->incrementaProximo();
	    	//INC TALONARIO
		  $importePago=$saldo==null?$importe:$saldo;
			Pagos::model()->ingresaPago($id,$importePago);
			$this->ingresarItems($items,$id);
			return $id;
	}
	private function ingresarItems($items,$id)
	{
		foreach($items as $item)$this->ingresaItem2($item,$id);
	}
	private function ingresarItems2($items,$id)
	{
		foreach($items as $item)
			if($item["tipo"]=="paraCobrar")$this->ingresaItem($item,$id);
	}
	private function ingresaItem2($item,$id)
	{
		$model=new ComprobantesItems;
		$model->idComprobante=$id;
		$model->detalle=$item['detalle'];
		$model->cantidad=$item['cantidad'];
		$model->importe=$item['importe'];
		$model->decuentoInteres=$item['descuento'];
		$model->idParaCobrar=$item['id']; //es el ID PARA COBRAR
		$model->save();
		$model->paraCobrar->estado="CANCELADO";
		$model->paraCobrar->importeSaldo=0;
		$model->paraCobrar->save();
	}
	public function modificarItems($items)
	{

		foreach($items as $item){
			$model=Comprobantes::model()->findByPk($item['id']);
			$model->importe=0;
			$model->save();
		}
	}
	public function getDetalleCorto()
	{
		$cad="";
		foreach($this->items as $item)$cad.=$item->detalle." | ";
		return $cad;
	}
	public function modificarCreditos($creditos)
	{
		foreach($creditos as $credito){
			$comp=Comprobantes::model()->findByPk($credito['id']);
			$comp->estado=Comprobantes::CANCELADO;
			$comp->save();
			
			$model=new Pagos;
			$model->fecha=Date('Y-m-d');
 			$model->idComprobante=$credito['id'];
 			$model->importe=$comp->importe;
 			
 			$model->save();
		}
	}
	private function ingresaParaCobrar($item,$id)
	{
		$pc=ParaCobrar::model()->findByPk($item['id']);
		$model=new ComprobantesItems;
		$model->idComprobante=$id;
		$model->detalle=$pc->detalle;
		$model->cantidad=1;
		$model->importe=$item['saldo'];
		$model->decuentoInteres=$item['interes'];
		$model->idParaCobrar=$item['id'];
		$model->save();
		$model->paraCobrar->estado="CANCELADO";
		//$model->paraCobrar->importeSaldo=0;
		$model->paraCobrar->save();
		$model->ingresarParaCobrar();
	}
	private function ingresaItem($item,$id)
	{
		if($item["tipo"]=="paraCobrar")$this->ingresaParaCobrar($item,$id);
		else $this->ingresaComprobante($item);
		
	}
	private function ingresaComprobante($item)
	{
		$model=new ComprobantesPagosPendientes;
		$idPago=Pagos::model()->ingresaPago($item['id'],$item['saldo'],0); //ACA TENGO QUE AGREGAR EL PAGO
			$model->idPago=$idPago;
			$model->idComprobante=$item['id'];
			$model->save();
			$modelComp=Comprobantes::model()->findByPk($item['id']);
			$modelComp->saldar();
	}
	public function ultimos($idEntidad,$cantidad)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idEntidad',$idEntidad,false);
		$criteria->limit=$cantidad;
		$criteria->order='t.id desc';
		return self::model()->findAll($criteria);
	}
	public function getCreditos($idEntidad)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idEntidad',$idEntidad,false);
		$criteria->compare('idTipoComprobante',ComprobantesTipos::ID_NOTACREDITO,false);
		$criteria->compare('estado',Comprobantes::PENDIENTE,false);
		$criteria->order='t.id desc';
		return self::model()->findAll($criteria);
	}
	public function pendientesPago($idEntidad)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('idEntidad='.$idEntidad." AND estado='".Comprobantes::PENDIENTE."'");
		$criteria->order='t.id desc';
		return self::model()->findAll($criteria);
	}
	private function ingresarComp($idEntidad,$importe,$fecha,$detalle,$interes,$bonificacion,$estado,$idTalonario,$idTipoComprobante,$nroComprobante,$importeFavor,$idPropiedad)
	{
		$mod=new Comprobantes;
		$mod->idEntidad=$idEntidad;
		$mod->importe=$importe;
		$mod->detalle=$detalle;
		$mod->fecha=$fecha;
		$mod->idPropiedad=$idPropiedad;
		$mod->estado=$estado;
		$mod->idTalonario=$idTalonario;
		$mod->nroComprobante=$nroComprobante;
		$mod->interes=$interes;
		$mod->bonificacion=$bonificacion;
		$mod->idTipoComprobante=$idTipoComprobante;
		$mod->importeFavor=$importeFavor;
		$mod->save();
		return $mod->id;
		
	}
	public function ingresarCredito($idEntidad,$importeCredito)
	{
		if($importeCredito>0)
		$id=$this->ingresarComp($idEntidad,$importeCredito,'Nota de crédito por el pago de expensas',ComprobantesTipos::ID_NOTACREDITO,self::PENDIENTE);
		///Pagos::model()->ingresaPago($id);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comprobantes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idEntidad,idTalonario, idTipoComprobante', 'numerical', 'integerOnly'=>true),
			array('importe,idTalonario,importeFavor', 'numerical'),

			array('estado, nroComprobante', 'length', 'max'=>255),
			array('detalle,interes,bonificacion, fecha,fechaVencimiento,importeFavor', 'safe'),
			array('idEntidad,importe,estado, fecha', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idTalonario, buscar,id,fechaVencimiento, idEntidad, importe,importeFavor, detalle, fecha, estado, nroComprobante, idTipoComprobante', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function getImportePagado()
	{
		$tot=0;
		foreach($this->pagos as $pago)
			$tot+=$pago->importe;
		return $tot;
	}
	public function cancelar()
	{
		$this->estado="CANCELADO";
		$this->save();
	}
	public function pendiente()
	{
		$this->estado="PENDIENTE";
		$this->save();
	}
	public function getImporteTotal()
	{
		return $this->importe+$this->interes-$this->bonificacion;
	}
	protected function afterSave()
	{
	    
	    parent::afterSave();
	}
	public function getImporteSaldo()
	{
		return $this->importe+$this->interes-$this->bonificacion;
	}
	public function saldar()
	{
		$pagar=$this->importeTotal-$this->importePagado;
		Pagos::model()->ingresaPago($this->id,$pagar,0);
		$pagar=$this->importeTotal-$this->importePagado;
		if($pagar==0){
			$this->estado=Comprobantes::CANCELADO;
			$this->save();
		}else{
			$this->estado=Comprobantes::PENDIENTE;
			$this->save();
		}

	}
	public function quitarPagosPendientes()
	{
		foreach($this->pagosPendientes as $item)$item->desSaldar();
	}
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'entidad' => array(self::BELONGS_TO, 'Entidades', 'idEntidad'),
			//'tipoEntidad' => array(self::BELONGS_TO, 'EntidadesTipos',array('idTipoEntidad'=>'id'),'through'=>'entidad'),
			 'talonario' => array(self::BELONGS_TO, 'Talonarios', 'idTalonario'),
			'tipo' => array(self::BELONGS_TO, 'ComprobantesTipos', 'idTipoComprobante'),
			'comprobantesComprobantes' => array(self::HAS_MANY, 'ComprobantesComprobantes', 'idComprobante'),
			'comprobantesComprobantes1' => array(self::HAS_MANY, 'ComprobantesComprobantes', 'idComprobanteHijo'),
			'gastoses' => array(self::HAS_MANY, 'Gastos', 'idComprobante'),
			'pagosPendientes' => array(self::HAS_MANY, 'ComprobantesPagosPendientes', 'idComprobante'),
			'items' => array(self::HAS_MANY, 'ComprobantesItems', 'idComprobante'),
			'item' => array(self::HAS_ONE, 'ComprobantesItems', 'idComprobante'),
			'comprobanteElectronico' => array(self::HAS_ONE, 'ComprobantesRespuestaElectronica', 'idComprobante'),
			'pagos' => array(self::HAS_MANY, 'Pagos', 'idComprobante'),

			'liquidacionesItemsComprobantes' => array(self::HAS_MANY, 'LiquidacionesItemsComprobantes', 'idComprobante'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idEntidad' => 'Entidad',
			'importe' => 'Importe',
			'detalle' => 'Detalle',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
			'idTalonario' => 'Talonario',
			'nroComprobante' => 'Nro Comprobante',
			'idTipoComprobante' => 'Tipo Comprobante',
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
		//$criteria->with=array('entidad');
		$criteria->join="left join entidades on entidades.id=t.idEntidad 
		left join entidades_tipos on entidades_tipos.id=entidades.idTipoEntidad";
		if(isset($_GET['idTipoOperacion']))
			if($_GET['idTipoOperacion']!='')$criteria->addCondition('entidades_tipos.idTipoOperacion='.$_GET['idTipoOperacion']);
		$criteria->compare('entidades.razonSocial',$this->buscar,true,'AND');
		$criteria->compare('nroComprobante',$this->buscar,true,'OR');
		$criteria->order='t.id desc';
		$cantidadPorPagina=Settings::model()->getValorSistema('FORMATO_CANTPAGINA');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array(
        'pageSize'=>$cantidadPorPagina,
    ),
		));
	}
}