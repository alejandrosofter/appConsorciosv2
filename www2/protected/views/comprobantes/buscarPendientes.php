<?php if(count($datos)>0){?>
<h4><strong>COMPROBANTES PENDIENTES</strong> DE PAGO</h4>
<table class='table table-condensed'>
<tr><th>Nro</th><th>Fecha</th><th>Detalle</th><th>Importe</th><th>$ Pendiente</th></tr>
<?php foreach($datos as $item){?>
<tr onclick='cambiaFila(<?=$item->id?>,<?=$item->importe-$item->importePagado?>)' id='fila_<?=$item->id?>'>
<td><?=$item->nroComprobante?></td>
<td><?=Yii::app()->dateFormatter->format("dd/MM/yy",$item->fecha)?></td>
<td><?=$item->detalleCorto;?></td>
<td><?=number_format($item->importe,2)?></td>
<td><?=number_format($item->importe-$item->importePagado,2)?></td>
</tr>

<?php }?>
<?php }?>
</table>
<script>
var itemsPendientesPago=Array();
function cambiaFila(id,importe)
{
	agregarQuitarComp(id,importe);

}
function agregarQuitarComp(id2,importe2)
{
	for(var i=0;i<itemsPendientesPago.length;i++){
		if(itemsPendientesPago[i].id==id2){
			itemsPendientesPago.splice(i,1);
			$('#fila_'+id2).attr('style','background-color:white');
			cambiaImporteTotal();
			//quitar(id2,"comp");
			console.log(seleccion);
			return;
		}
		
	}
	agregarComprobante(id2);
	var item={id:id2,importe:importe2};
	itemsPendientesPago.push(item);
	$('#fila_'+id2).attr('style','background-color:yellow');
	cambiaImporteTotal();
}
</script>