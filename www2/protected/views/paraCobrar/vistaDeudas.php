<table class='table table-condensed'>
<tr id='cols'><th>Vto.</th><th>Mora...</th><th>int.</th><th>Entidad</th><th>Propiedad</th><th>Detalle</th><th>Interes</th><th style="width:110px">Saldo</th></tr>
<script>
	datos=Array();
</script>
<?php
$total=0;
$i=0;
$idEntidad=0;
foreach($res as $item){
$total+=(float)$item->importeSaldo;
$vencido=$item->fechaVencimiento<Date("Y-m-d");
//$conPorcentaje=strpos($item->punitorio,'%'); //define si es con porcentaje

$importe=str_replace('%','',$item->punitorio);
$porcInteres=$importe==""?0:$importe;
  
$dias=$item->getDiasVence()<0?-$item->getDiasVence():0;
$importeInteres=(($porcInteres/100)*$item->importeSaldo)*$dias;

//$interes=($dias<0?$interes:0)*$dias;
$idEntidad=$item->idEntidad;
//$interes=$dias;
$color=$vencido?"text-error":"text-success";
?>

<script>datos.push({id:<?=$item->id?>,saldo:<?=$item->importeSaldo?>,interes:<?=$importeInteres?>,detalle:"<?=$item->detalle?>",entidad:"<?=$item->entidad->razonSocial?>",propiedad:"<?=$item->propiedad->nombrePropiedad?>"})</script>
<tr  title='Fecha de la Deuda <?=Yii::app()->dateFormatter->format("dd/MM/yyyy",$item->fecha)?>' id='fila_<?=$i?>'>
<td><small><small class='<?=$color?>'><?=Yii::app()->dateFormatter->format("dd/MM/yyyy",$item->fechaVencimiento);?></small></small></td>
<td><small><?=$dias." d.";?></small></td>
<td><small><?=$item->punitorio."";?></small></td>
<td><small><?=$item->entidad->razonSocial;?></small></td>

<td><?=$item->propiedad->nombrePropiedad;?></td>
<td ><small><?=$item->detalle;?></small></td>
<td style='width:80px'><?=number_format($importeInteres,2);?></td>
<td style='width:70px'>$ <?=number_format($item->importeSaldo,2);?></td>
<td style='width:30px'>
	<img onclick='clickFila(<?=$i?>,<?=$item->id?>)' style='cursor:pointer' src='images/iconos/glyphicons/glyphicons_151_new_window.png'/>
</td>
</tr>

<?php
$i++;
}?>

</table>
<small><i>El punitorio está seteado con el valor por defecto (desde datos de sistema) en el momento en que se liquidan las expensas</i></small>
<div id='comproabtesPendientes'></div>
<script>

function buscarComprobantesImpagos(idEntidadPaga)
{
	console.log("idEntidad:"+idEntidadPaga);
	$.get( "index.php?r=comprobantes/buscarPendientes",{idEntidad:idEntidadPaga}, function( data ) {
		
		$('#comproabtesPendientes').html(data);
		cambiaImporteTotal();
	});
}
function clickFila(id,idParaCobrar)
{
	var elem="#fila_"+id;
	$(elem).css( "background-color",'#ccc');
	importeCredito=0;
	agregar(idParaCobrar,undefined,datos[id].interes);

}
function agregaQuitaArray(elem,id,idParaCobrar)
{
	if($(elem).css( "background-color")=='transparent' || $(elem).css( "background-color")=="rgba(0, 0, 0, 0)")
		quitar(idParaCobrar);
		else agregar(id)
}

function agregar(idParaCobrar,importe,interes)
{
	if(estaDentro(idParaCobrar,"paraCobrar")){
		swal({   title: "Opss..",  text:  "Ya has ingresado ese item!",  html: true,  type: "error"});
		return;
	}
	$('#labCredito').html('');
	
	$.getJSON( "index.php?r=paraCobrar/getParaCobrar",{id:idParaCobrar}, function( data ) {
		var imp=(importe!=undefined)?importe:data.data.importeSaldo;
		importe=(importe*1).toFixed(2);
		if(ingresandoMisma(data.propiedad.id)){
				seleccion.push({id:idParaCobrar,tipo:"paraCobrar",saldo:imp*1,importe:imp*1,interes:interes*1,detalle:data.data.detalle,entidad:data.entidad.razonSocial,idPropiedad:data.propiedad.id,propiedad:data.propiedad.nombrePropiedad});
				mostrarInfo();
			}else swal({   title: "Opss..",  text:  "No puedes liquidar en conjunto con otra propiedad!",  html: true,  type: "error"});
	});
	
		
	
}
function agregarComprobante(idComp)
{
	if(estaDentro(idComp,"comp")){
		swal({   title: "Opss..",  text:  "Ya has ingresado ese item!",  html: true,  type: "error"});
		return;
	}
	$('#labCredito').html('');
	console.log("consulta")
	$.getJSON( "index.php?r=comprobantes/getComprobante",{id:idComp}, function( data ) {
		//var saldo=(data.saldo*1).toFixed(2);
		if(ingresandoMisma(data.propiedad.id)){
			seleccion.push({id:idComp,tipo:"comp",saldo:data.saldo,importe:data.importe,interes:0,detalle:data.detalle,entidad:data.idEntidad,propiedad:"s/n"});
      mostrarInfo();
		}else swal({   title: "Opss..",  text:  "No puedes liquidar en conjunto con otra propiedad!",  html: true,  type: "error"});
		
	});
	
		
	
}
function estaDentro(id,tipo)
{
	for(var i=0;i<seleccion.length;i++)
		if(seleccion[i].id==id && seleccion[i].tipo==tipo)return true;
	return false;
}
function ingresandoMisma(idPropiedad)
{
	if(seleccion.length==0)return true;
	if(seleccion.length>0){
		console.log(seleccion[0].idPropiedad+" == "+idPropiedad+" ??")
		if(seleccion[0].idPropiedad==idPropiedad)return true;
	}
	
	
		
	return false;
}
function quitar(idParaCobrar,tipo)
{
	seleccion.splice(buscarId(idParaCobrar,tipo),1);
	$('#labCredito').html('');
}
function mostrarInfo(retocaImporte)
{
	var saldoFinal=0;
	var interesFinal=0;
	var totalFinal=0;
	for(var i=0;i<seleccion.length;i++){
		saldoFinal+=(seleccion[i].saldo)*1;
		interesFinal+=(seleccion[i].interes)*1;
	}

	totalFinal+=(saldoFinal)+interesFinal;
	if(retocaImporte==undefined){
		$('#importe').val(saldoFinal.toFixed(2));
    $('#interes').val(interesFinal.toFixed(2));
		$('#interesDescuentos').val(interesFinal.toFixed(2));
	}
  	$('#labInteres').html('Interés $ '+interesFinal.toFixed(2));
  	$('#labSubTotal').html('SUB-TOTAL $ '+saldoFinal.toFixed(2));
  	$('#labTotal').html('TOTAL $ '+totalFinal.toFixed(2));
  	if(importeCredito>0)$('#labCredito').html('Crédito $ '+importeCredito);else $('#labCredito').html('');
  	mostrarItems();
}
function getImporteCreditoFavor()
{
	if(datosCreditos.length>0)return importeCredito;
	return 0;
}
function buscarId(idParaCobrar,tipo)
{
	for(var i=0;i<seleccion.length;i++)
		if(seleccion[i].id==idParaCobrar&&seleccion[i].tipo==tipo)return i;
  return null;
}
function getElemento(idParaCobrar)
{
	var dat=null;
	$.getJSON( "index.php?r=paraCobrar/getParaCobrar",{id:idParaCobrar}, function( data ) {

		dat= data;
	return dat;
	});
	console.log(dat);
	return dat;
}
function switchColor(elem,color)
{
	if($(elem).css( "background-color")=='transparent' || $(elem).css( "background-color")=="rgba(0, 0, 0, 0)")
		$(elem).css( "background-color",color);
		else $(elem).css( "background-color",'transparent');
}
</script>