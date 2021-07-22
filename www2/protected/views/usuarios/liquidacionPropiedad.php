<table class='table table-condensed'>
<tr><th>Fecha</th><th>Detalle</th><th></th></tr>
<?php 
$liquidaciones=Liquidaciones::model()->porPropiedad($idEdificio,8);
foreach($liquidaciones as $liquidacion){?>
<tr><td><?=Yii::app()->dateFormatter->format("dd/MM/yy",$liquidacion->fecha)?></td><td><?=$liquidacion->detalle?></td>
	<td> <a data-fancybox-type='iframe' class='imprime' href='index.php?r=liquidaciones/imprimir&id=<?=$liquidacion->id?>'>
		<img src="images/iconos/glyphicons/salida2.png" alt="Imprimir Gastos"></a> 
		<a data-fancybox-type='iframe' class='imprime' href='index.php?r=liquidaciones/imprimirGastos&id=<?=$liquidacion->id?>'>
		<img src="images/iconos/glyphicons/salida.png" alt="Imprimir Expensas"></a> 
	</td></tr>

<?php }?>
</table>
<small><i><?=count($liquidaciones)==0?'No se registraron liquidaciones':''?></i></small>