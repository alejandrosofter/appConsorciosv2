<small>
<table class='table table-condensed'>

<?php
$criteria=new CDbCriteria;
$criteria->order='t.id desc';
$criteria->limit=5;
$data= PropiedadesConsultas::model()->findAll($criteria);
foreach($data as $item){
?>
<tr>
<td><?=Yii::app()->dateFormatter->format("dd/MM/yy",$item->fecha)?></td>
<td><?=$item->solicitante?></td>
<td><?=$item->tipoConsulta?></td>
</tr>

<?php } ?>
</table>
<i>Ultimas <?=count($data)?> consultas</i>
</small>