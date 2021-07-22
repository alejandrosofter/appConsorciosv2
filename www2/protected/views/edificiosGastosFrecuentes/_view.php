<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEdificio')); ?>:</b>
	<?php echo CHtml::encode($data->idEdificio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoGasto')); ?>:</b>
	<?php echo CHtml::encode($data->idTipoGasto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEntidad')); ?>:</b>
	<?php echo CHtml::encode($data->idEntidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoComprobante')); ?>:</b>
	<?php echo CHtml::encode($data->idTipoComprobante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detalle')); ?>:</b>
	<?php echo CHtml::encode($data->detalle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importe')); ?>:</b>
	<?php echo CHtml::encode($data->importe); ?>
	<br />


</div>