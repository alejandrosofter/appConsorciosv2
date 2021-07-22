<small>
<table class='table table-condensed'>

<?php
$criteria=new CDbCriteria;
$criteria->order='t.id desc';
$criteria->limit=5;
$data= ParaCobrar::model()->findAll($criteria);
foreach($data as $item){
?>
<tr>
<td><?=Yii::app()->dateFormatter->format("MM/yy",$item->fecha)?></td>
<td><?=$item->entidad->razonSocial?></td>
<td>$ <?=number_format($item->importe,2)?></td>
</tr>

<?php } ?>
</table>
<i>Ultimas <?=count($data)?> deudas</i>
</small>