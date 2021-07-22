<small>
<table class='table table-condensed'>

<?php
$criteria=new CDbCriteria;
$criteria->order='t.id desc';
$criteria->limit=5;
$data= Comprobantes::model()->findAll($criteria);
foreach($data as $item){
?>
<tr>
<td><?=Yii::app()->dateFormatter->format("dd/MM/yy",$item->fecha)?></td>
<td><?=$item->entidad->razonSocial?></td>
<td style='width:70px'>$ <?=number_format($item->importe,2)?></td>
</tr>

<?php } ?>
</table>
<i>Ultimos <?=count($data)?> comprobantes</i>
</small>