<h3>Items</h3>
<script>
var importes=Array();
setImporteFinal();
function quitarItem(id)
{
	var elem="#fila_"+id;
	importes.splice(id,1);
	setImporteFinal();
	$(elem).remove();
}
function setValorGasto(id,valor)
{
	var index=indexItemGasto(id);
	if(index==-1){ //NO EXISTE
		var item={idGasto:id,importe:valor};
		importes.push(item);
	}else{
		importes[index].importe=valor;
	}
	
}
function indexItemGasto(id)
{
	for(i=0;i<importes.length;i++)
		if(importes[i].idGasto==id)return i;
	return -1;
}
function setImporteFinal()
{
	var tot=0;
	for (var i=0;i<importes.length;i++)tot+=importes[i].importe;
	
	$("#Liquidaciones_importe").val(tot.toFixed(2));
}
</script>
<table class='table table-condensed'>
<tr id='cols'><th>Fecha</th><th>Detalle</th><th>Tipo Gasto</th><th>Importe</th></tr>
<?php
$total=0;
$i=0;
foreach($items as $item){
$total+=(float)$item->comprobante->importe+0;
	
// $porc=$item->porcentajeDepto->porcentaje.'% | '.$item->porcentajeCochera->porcentaje.'%';
	$labDetallePor="";
	if(isset($item->porcentajeDepto))$labDetallePor.="% depto:".$item->porcentajeDepto->porcentaje;
	if(isset($item->porcentajeCochera))$labDetallePor.="% coche:".$item->porcentajeCochera->porcentaje;
	if(isset($item->porcentajeLocal))$labDetallePor.="% local:".$item->porcentajeLocal->porcentaje;
if($item->idTipoGasto==4)$labDetallePor.=$item->propiedadesGastoLabel;
	?>
<tr id='fila_<?=$i?>'>
<td><?=Yii::app()->dateFormatter->format("MM/yy",$item->comprobante->fecha)?></td>
<td><?=$item->comprobante->detalle;?></td>
<td title="<?=$labDetallePor?>"><?=$item->tipo->nombreTipoGasto;?></td>

<th><small>$ <?=number_format($item->comprobante->importe,2);?></small></th>


</tr>
<script>setValorGasto(<?=$item->id?>,<?=$item->comprobante->importe?>)</script>
<?php 
$i++;
}?>
<tr><th></th><th></th><th>TOTAL</th><th>$ <?=number_format($total,2)?></th></tr>
</table>
<script type="text/javascript">setImporteFinal();</script>