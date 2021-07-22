<table class='table table-condensed'>
<tr><th>Fecha</th><th>Detalle</th><th>Importe</th><th>Saldo</th></tr>
<?php 
$saldo=0;
$total=0;
foreach($pendientes as $paraCobrar){
$saldo+=$paraCobrar->importeSaldo;
$total+=$paraCobrar->importe;?>
<tr><td><?=Yii::app()->dateFormatter->format("dd/MM/yy",$paraCobrar->fecha)?></td><td><?=$paraCobrar->detalle?></td><td>$ <?=number_format($paraCobrar->importe,2)?></td><td>$ <?=number_format($paraCobrar->importeSaldo,2)?></td></td>

<?php }?>
<tr><th></th><th></th><th>$ <?=number_format($total,2)?></th><th>$ <?=number_format($saldo,2)?></th></tr>
</table>
<small><i><?=count($pendientes)==0?'No se registraron pendientes':''?></i></small>