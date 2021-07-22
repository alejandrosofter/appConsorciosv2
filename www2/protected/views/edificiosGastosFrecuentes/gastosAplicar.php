<table class='table table-condensed'>
<tr><th style="width:30px">%depto</th><th  style="width:30px">%cochera</th><th  style="width:30px">%local</th>><th>Detalle</th><th style="width:200px">Importe</th></tr>
<?php
$total=0;
$i=0;
foreach($items as $item){
$total+=(float)$item->importe+0;
	?>
<td><input type='text' class='span1' value='<?=$item->getPorcentajeTipoPropiedad(1);?>' name='gastos[<?=$i?>][porcentajeDepto]'></input></td>
<td><input type='text' class='span1' value='<?=$item->getPorcentajeTipoPropiedad(2);?>' name='gastos[<?=$i?>][porcentajeCochera]'></input></td>
<td><input type='text' class='span1' value='<?=$item->getPorcentajeTipoPropiedad(3);?>' name='gastos[<?=$i?>][porcentajeLocal]'></input></td>

<td><input type='text' style="width:95%" value='<?=$item->detalle;?>' name='gastos[<?=$i?>][detalle]'></input></td>
<td> $ <input type='text' class='span2' value='<?=$item->importe;?>' name='gastos[<?=$i?>][importe]'></input></td></tr>
<input type='hidden' name='gastos[<?=$i?>][idGasto]' value='<?=$item->id?>'</input>
<?php 
$i++;
}?>
</table>