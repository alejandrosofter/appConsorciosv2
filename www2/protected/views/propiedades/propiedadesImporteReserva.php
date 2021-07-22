<script type="text/javascript">
var itemsImporteReserva=new Array();
function cambiaValor(id)
{
	setValor(id,$('#item_'+id).val());
}
function setValor(id,valor)
{
	var index=indexItem(id);
	console.log(itemsImporteReserva);
	console.log(index);
	if(index==-1){ //NO EXISTE
		var item={idPropiedad:id,importe:valor};
		itemsImporteReserva.push(item);
	}else{
		itemsImporteReserva[index].importe=valor;
	}
	
}
function indexItem(id)
{
	for(i=0;i<itemsImporteReserva.length;i++)
		if(itemsImporteReserva[i].idPropiedad==id)return i;
	return -1;
}
</script>
<table class="table table-condensed">
<tr><th>Propiedad</th><th>Tipo Prop.</th><th>Quien Paga...</th><th>Importe</th></tr>
<?php foreach($items as $item){
$tieneCochera=$item->tieneCochera?"Cochera":"";
$clase=$item->tipoPropiedad->nombreTipoPropiedad.$tieneCochera;
	?>
<tr>
	<td><?=$item->nombrePropiedad?></td>
	<td><?=$item->tipoPropiedad->nombreTipoPropiedad?> <?=$item->tieneCochera?"/Cochera":""?></td>
	<td><?=isset($item->entidadPaga)?$item->entidadPaga->razonSocial:"s/n"?></td>
	<td><input idPropiedad="<?=$item->id?>" class="<?=$clase;?>" onchange="cambiaValor(<?=$item->id?>)" style="width:60px" id='item_<?=$item->id?>' type='text' value='<?=$item->importeAuxReserva?>'></input> </td>
</tr>
<script>setValor(<?=$item->id?>,0)</script>
<?php }?>

</table>
