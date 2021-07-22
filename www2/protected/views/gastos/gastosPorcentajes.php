<h5>Porcentajes</h5>
<table>
<tr>
<?php 
$val=100;
for($i=0;$i<count($porcentajes);$i++) {?>
<td>
<input class='span1' type='hidden' name='porcentajes[<?=$i?>][idTipo]' value='<?=$porcentajes[$i]->id?>'></input>

<img title='<?=$porcentajes[$i]->nombreTipoPropiedad?>' src='images/iconos/glyphicons/<?=$porcentajes[$i]->nombreTipoPropiedad?>.png'/>
<input onchange='cambiaPorcentajeGasto()' value="<?=$valores[$i]?>" style="width:30px;font-size:10px" type='text' name='porcentajes[<?=$i?>][valor]' id='porcentaje_<?=$porcentajes[$i]->id?>' value='<?=Edificios::getPorcentaje($idEdificio,$porcentajes[$i]->id)?>'></input> <small>%</small></td>
<?php $val=0; }?>
</tr>
</table>
<script>
function cambiaPorcentajeGasto()
{
// 	var suma=Number($('#porcentaje_1').val())+Number($('#porcentaje_2').val())+Number($('#porcentaje_3').val());
// 	if(suma!=100) alert('El total de los 3 porcentajes no llega a 100 o se sobrepasa '+suma);
}
</script>