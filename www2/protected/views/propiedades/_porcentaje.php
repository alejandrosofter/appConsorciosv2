<h5>% Coeficiente</h5>
<table>

<?php 
$val=100;
for($i=0;$i<count($porcentajes);$i++) {?>
<tr>
	<td>
		<input class='span1' type='hidden' name='porcentajes[<?=$i?>][idTipo]' value='<?=$porcentajes[$i]->id?>'></input>
		<img title='<?=$porcentajes[$i]->nombreTipoPropiedad?>' src='images/iconos/glyphicons/<?=$porcentajes[$i]->nombreTipoPropiedad?>.png'/>
		
	</td>

	<td>
		<input class='span1' type='text' name='porcentajes[<?=$i?>][valor]' id='porcentaje_<?=$porcentajes[$i]->id?>' value='<?=$valores[$i]?>'></input>
	</td>
</tr>
<?php $val=0; }?>

</table>
<i>Valores con punto ej. 2.53</i>