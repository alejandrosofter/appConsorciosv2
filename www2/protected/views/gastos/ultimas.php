<small>
<table class='table table-condensed'>

<?php
$criteria=new CDbCriteria;
$criteria->order='t.id desc';
$criteria->limit=5;
$data= Gastos::model()->findAll($criteria);
foreach($data as $item){
?>
<tr>
<td><?=Yii::app()->dateFormatter->format("dd/MM/yy",$item->comprobante->fecha)?></td>
<td><?=$item->edificio->nombreEdificio?></td>
<td>$ <?=number_format($item->comprobante->importe,2)?></td>
</tr>

<?php } ?>
</table>
<i>Ultimos <?=count($data)?> gastos</i>
</small>