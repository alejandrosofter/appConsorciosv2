<h3>Créditos</h3>
<script>var datosCreditos=new Array();
var seleccionCreditos=new Array();</script>
<table class='table table-condensed'>
<tr id='colsCreditos'><th>Fecha</th><th>Importe</th></tr>
<?php
$total=0;
$i=0;
foreach($data as $item){?>
<script>datosCreditos.push({id:<?=$item->id?>,importe:<?=$item->importe?>})</script>
<tr onclick='clickFilaCredito(<?=$i?>,<?=$item->id?>)' id='filaCredito_<?=$i?>'>
<td><small><?=$item->fecha;?></small></td>
<td style='width:70px'>$ <?=number_format($item->importe,2);?></td>
</tr>

<?php
$i++;
}?>
</table>
<script>
function clickFilaCredito(id,idComprobante)
{
	var elem="#filaCredito_"+id;
	switchColorCredito(elem,'#00DD3B');
	agregaQuitaArrayCredito(elem,id,idComprobante);
	setImporteCreditos()

}
function buscarIdCredito(idParaCobrar)
{

	for(var i=0;i<seleccionCreditos.length;i++)
		if(seleccionCreditos[i].id==idParaCobrar)return i;
  return null;
}
function switchColorCredito(elem,color)
{
	if($(elem).css( "background-color")=='transparent' || $(elem).css( "background-color")=="rgba(0, 0, 0, 0)")
		$(elem).css( "background-color",color);
		else $(elem).css( "background-color",'transparent');
}
function agregaQuitaArrayCredito(elem,id,idParaCobrar)
{
	if($(elem).css( "background-color")=='transparent' || $(elem).css( "background-color")=="rgba(0, 0, 0, 0)")
		quitarCredito(idParaCobrar);
		else agregarCredito(id)
}

function agregarCredito(i)
{
	seleccionCreditos.push({id:datosCreditos[i].id,importe:datosCreditos[i].importe});
}
function getImporteCreditos()
{
	var suma=0;
	for(var i=0;i<seleccionCreditos.length;i++)
		suma+=seleccionCreditos[i].importe;

	return suma;
}
function setImporteCreditos()
{
	importeCredito=getImporteCreditos().toFixed(2);
	mostrarInfo();
}
function quitarCredito(idParaCobrar)
{
	seleccionCreditos.splice(buscarIdCredito(idParaCobrar),1);
}
</script>