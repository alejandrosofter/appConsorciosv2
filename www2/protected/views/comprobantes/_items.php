<script>
var items=Array();
var ultimoCargado=0;
init();

function init()
{

}
function agregarItem()
{
	var id=ultimoCargado;
	ultimoCargado++;
	var cad="<tr id='fila_"+id+"'><td><input onchange='cambia("+id+",\"cantidad\")'type='text' id='cantidad_"+id+"' class='span1' value='1'/></td><td><input placeholder='Descripcion del item...' onchange='cambia("+id+",\"detalle\")' type='text' id='detalle_"+id+"' class='span2'/></td><td><input rel='tooltipo' title='Ingrese valores negativos para un DESCUENTO (-) y positivos para INTERES (+)' onchange='cambia("+id+",\"descuento\")' type='text' value='0' id='descuento_"+id+"' class='span1'/></td><td><input value='0' rel='tooltip' title='Presione ENTER para agregar otro item!' onchange='cambia("+id+",\"importe\");' type='text' id='importe_"+id+"' class='ultimoCampo span1'/></td><td><img title='Quitar Item' src='images/iconos/glyphicons/glyphicons_197_remove.png' style='cursor:pointer;' onclick='quitarItem("+id+")'/></td>	</tr>";
	$('#tablaItems tr:last').after(cad);

	items.push({cantidad:$('#cantidad_'+id).val(),  detalle:$('#detalle_'+id).val(), descuento:$('#descuento_'+id).val(), importe:$('#importe_'+id).val(), id:id });
	$('#cantidad_'+id).focus();
	$('#importe_'+id).tooltip();
	$('#descuento_'+id).tooltip();
	calculaImportes();
}
function calculaImportes()
{
	var totalImporte=0;
	var totalDescuento=0;
	var total=0;
	for(var i=0;i<items.length;i++){
		var imp=items[i].importe*1;
		totalImporte+=imp;
		totalDescuento+=items[i].descuento*1;
		total+=((items[i].cantidad*1)*imp)+items[i].descuento*1;
	}
	$('#Comprobantes_importe').val(total);
	$('#Comprobantes_interesDescuento').val(totalDescuento);
}

$('.ultimoCampo').live('keypress', function(e) {
    if (e.keyCode === 13) {
        e.preventDefault();
        agregarItem();
        $('#cantidad_'+ultimoCargado).focus();
    }
});
function quitarItem(id)
{
	items.splice(buscarId(id),1);
	$('#fila_'+id).remove();
	calculaImportes();
}
function cargarOtro()
{
	agregarItem()
}
function cambia(id,campo)
{
	var pos=buscarId(id);
	items[pos][campo]=$('#'+campo+'_'+id).val();
	calculaImportes();
}
function buscarId(id)
{
	for(var i=0;i<items.length;i++)
		if(items[i].id==id)return i;
  return null;
}
</script>
<h3><img src='images/iconos/glyphicons/glyphicons_319_sort.png'/> Items <img title='Agregar Item' src='images/iconos/stan/001_03.png' style='cursor:pointer;padding:10px;float:right' onclick='agregarItem()'/></h3>
<table id='tablaItems' class='table condensed'>
<tr> <th>Cant.</th>	<th>Detalle</th>	<th>Desc/ints</th>	<th>Importe</th>	<th></th>	</tr>
<?php
if($model->isNewRecord){?>




<?php } else{?>



<?php }?>
</table>