<table class='table table-condensed'>
<tr><th>Fecha</th><th>Detalle</th><th>Importe</th></tr>
<?php foreach($ultimos as $comp){?>
<tr><td><?=Yii::app()->dateFormatter->format("dd/MM/yy",$comp->fecha)?></td><td><?=$comp->detalle?></td><td>$ <?=number_format($comp->importe,2)?></td></td>

<?php }?>
</table>
<small><i><?=count($ultimos)==0?'No se registraron pagos':''?></i></small>