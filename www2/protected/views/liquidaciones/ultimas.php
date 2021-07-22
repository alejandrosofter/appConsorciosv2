<small>
<table class='table table-condensed'>

<?php
$limite=5;
$criteria=new CDbCriteria;
$criteria->order='t.id desc';
$criteria->limit=$limite;
$data= Liquidaciones::model()->findAll($criteria);
foreach($data as $item){
?>
<tr>
<td><?=Yii::app()->dateFormatter->format("MM/yy",$item->fecha)?></td>
<td><?=$item->edificio->nombreEdificio?></td>
<td>$ <?=number_format($item->importe,2)?></td>
</tr>

<?php } ?>
</table>
<i>Ultimas <?=count($data)?> liquidaciones</i>
</small>