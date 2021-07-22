<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContrato')); ?>:</b>
	<?php echo CHtml::encode($data->idContrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desdeCuota')); ?>:</b>
	<?php echo CHtml::encode($data->desdeCuota); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hastaCuota')); ?>:</b>
	<?php echo CHtml::encode($data->hastaCuota); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importe')); ?>:</b>
	<?php echo CHtml::encode($data->importe); ?>
	<br />


</div>