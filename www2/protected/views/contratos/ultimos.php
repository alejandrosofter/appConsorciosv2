<small>
<table class='table table-condensed'>

<?php
$criteria=new CDbCriteria;
$criteria->order='t.id desc';
$criteria->limit=5;
$data= Contratos::model()->findAll($criteria);
foreach($data as $item){
?>
<tr>
<td><?=$item->locador->razonSocial?></td>
<td><?=$item->locatario->razonSocial?></td>
<td><?=$item->inmueble->nombrePropiedad?></td>
</tr>

<?php } ?>
</table>
<i>Ultimos <?=count($data)?> contratos</i>
</small>