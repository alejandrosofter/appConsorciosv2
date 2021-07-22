<?php foreach($data as $item){?>
<span id='item<?=$item->id;?>' class='itemPropiedad' style='cursor:pointer' onclick='cambiaPropiedadEntidad(<?=$item->id?>,<?=$item->idPropiedad?>)'><?=$item->propiedad->nombrePropiedad;?> <b><?=$item->propiedad->edificio->nombreEdificio;?></b></span><br>
<?php }?>
<script>
function cambiaPropiedadEntidad(id,idPropiedad)
{
	$('.itemPropiedad').css("background-color",'white');
	$('#item'+id).css("background-color",'green');
	$("#ParaCobrar_idPropiedad").select2("val", idPropiedad);
	console.log()
}
</script>